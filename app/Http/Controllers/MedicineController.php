<?php

namespace App\Http\Controllers;

use App\App\Models\Prescription;
use App\Models\Medicine;
use App\Models\Prescription as ModelsPrescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MedicineController extends Controller
{
    //Display medicine inventory
    public function index(Request $request)
    {
        $query = Medicine::query();

        //Search Functionality
        if ($request->has('search') && $request->search != ''){
            $search = $request->search;
            $query->where(function($q) use ($search){
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $medicines = $query->orderBy('created_at', 'desc')->get();

        return view('staff_inventory_medicine', compact('medicines'));

    }

    //Store new medicine
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', 
            'category' => 'required|string|max:255', 
            'stock' => 'required|integer|min:0', 
            'expiry_date' => 'required|date|after:today', 
            'description' => 'nullable|string', 
        ]);

        Medicine::create($validated);

        return redirect()->route('staff_inventory_medicine')
        ->with('success', 'Medicine added Succesfully!');
    }

    // Edit Medicine
    public function edit(Medicine $medicine)
    {  
        return view('staff_edit_medicine', compact('medicine'));
    }

    // Update medicine
    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'expiry_date' => 'required|date',
            'description' => 'nullable|string'
    ]);

        $medicine->update($validated);

        return redirect()->route('staff_inventory_medicine')
        ->with('success', 'Medicine updated successfully!');
}



    //Update Medicine Stock
    public function updateStock(Request $request)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'stock_change' => 'required|integer',
            'reason' => 'nullable|string'
        ]);
        
        $medicine = Medicine::findOrfail($validated['medicine_id']);
        $newStock = $medicine->stock + $validated['stock_change'];

        if($newStock < 0) {
            return redirect()->route('staff_inventory_medicine')
            ->with('error', 'Stock cannot be negative!');
        }

        $medicine->update(['stock' => $newStock]);

        return redirect()->route('staff_inventory_medicine')
            ->with('success', 'Stock updated Successfully!');
    }

    //Delete Medicine
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('staff_inventory_medicine')
            ->with('success', 'Medicine deleted Successfully!');
    }

    
    // Show give medicine form
    public function showGiveMedicineForm()
    {
        $medicines = Medicine::where('stock', '>', 0)
                        ->orderBy('name')
                        ->get();
    
        $recentRecords = ModelsPrescription::with(['medicine', 'givenBy'])
                                   ->latest()
                                   ->take(10)
                                   ->get();
    
        return view('staff_give_medicine', compact('medicines', 'recentRecords'));
    }

    // Store medicine record
    public function giveMedicine(Request $request)
    {
        $validated = $request->validate([
        'patient_id' => 'required|string|max:255',
        'patient_name' => 'required|string|max:255',
        'appointment_id' => 'nullable|string|max:255',
        'medicine_id' => 'required|exists:medicines,id',
        'quantity' => 'required|integer|min:1',
        'notes' => 'nullable|string'
    ]);

    
    // Verify if patient exists in users table
    $patient = User::where('id', $validated['patient_id'])
                   ->orWhere('id_number', $validated['patient_id'])
                   ->first();

    if (!$patient) {
        return redirect()->back()
            ->with('error', 'Patient not found! Please verify the Patient ID.')
            ->withInput();
    }

    // Optional: Verify patient name matches
    if (strtolower($patient->name) !== strtolower($validated['patient_name'])) {
        return redirect()->back()
            ->with('error', 'Patient name does not match the ID. Found: ' . $patient->name)
            ->withInput();
    }

     // Get the medicine
    $medicine = Medicine::findOrFail($validated['medicine_id']);

    // Check if enough stock
    if ($medicine->stock < $validated['quantity']) {
        return redirect()->back()
            ->with('error', 'Insufficient stock! Available: ' . $medicine->stock . ' units')
            ->withInput();
    }

    // Create prescription
    ModelsPrescription::create([
        'patient_id' => $validated['patient_id'],
        'patient_name' => $validated['patient_name'],
        'appointment_id' => $validated['appointment_id'],
        'medicine_id' => $validated['medicine_id'],
        'quantity' => $validated['quantity'],
        'notes' => $validated['notes'],
        'given_by' => Auth::id()
    ]);

    // Reduce medicine stock
    $medicine->decrement('stock', $validated['quantity']);

    return redirect()->route('staff_give_medicine')
        ->with('success', 'Medicine dispensed successfully!');
    }

    
    // Get medicine details 
    public function getMedicineDetails($id)
    {
        $medicine = Medicine::findOrFail($id);
    
        return response()->json([
            'id' => $medicine->id,
            'name' => $medicine->name,
            'stock' => $medicine->stock,
            'category' => $medicine->category,
            'expiry_date' => $medicine->expiry_date->format('Y-m-d'),
            'status' => $medicine->status_text
    ]);

}
}