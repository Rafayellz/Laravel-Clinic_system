    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('full_name')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('address')->after('weight')->nullable();
            $table->string('emergency_cont')->after('address')->nullable();
            $table->string('email')->after('emergency_cont')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'emergency_cont', 'email']);
        });
    }
};
