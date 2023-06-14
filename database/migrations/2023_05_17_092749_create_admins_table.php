<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('npp')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama');
            $table->timestamps();
        });

        $admin = new Admin;
        $admin->nama = 'admin';
        $admin->npp = '00000001';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin'); // Ganti 'password' dengan password yang diinginkan
        $admin->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
