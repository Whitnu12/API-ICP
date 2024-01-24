<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = new User([
            'name' => 'Nama Anda', // Ganti dengan nama yang sesuai
            'email' => 'admin@gmail.com', // Ganti dengan email yang sesuai
            'password' => bcrypt('mantap123'), // Ganti dengan password yang sesuai
        ]);
        $user->save();

        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nip_admin')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
