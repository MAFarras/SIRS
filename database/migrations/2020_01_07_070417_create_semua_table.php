<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('jabatan', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('jabatan');
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama');
            $table->unsignedinteger('id_jabatan');
            $table->foreign('id_jabatan')
                ->references('id')
                ->on('jabatan');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('jenis_dokter', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama');
            $table->string('keterangan');    
            $table->timestamps();
        });

        Schema::create('dokter', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama');
            $table->unsignedinteger('id_jenis');
            $table->foreign('id_jenis')
                ->references('id')
                ->on('jenis_dokter');
            $table->string('no_telp');
            $table->string('no_praktek');     
            $table->timestamps();
        });

        Schema::create('jadwal', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedinteger('id_dokter');
            $table->foreign('id_dokter')
                ->references('id')
                ->on('dokter');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->time ('waktu_mulai');
            $table->time ('waktu_akhir');   
            $table->timestamps();
        });

        Schema::create('histori_jadwal', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedinteger('id_user');
            $table->foreign('id_user')
                ->references('id')
                ->on('users');
            $table->unsignedinteger('id_dokter');    
            $table->foreign('id_dokter')
                ->references('id')
                ->on('dokter');    
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->time ('waktu_mulai');
            $table->time ('waktu_akhir');     
            $table->dateTime('tanggal_waktu_buat');   
            $table->timestamps();
        });

          Schema::create('jenis_ruangan', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama');   
            $table->timestamps();
        });

        Schema::create('ruangan', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama'); 
            $table->unsignedinteger('id_jenis');
            $table->foreign('id_jenis')
                ->references('id')
                ->on('jenis_ruangan');
            $table->string('status');   
            $table->timestamps();
        });

        Schema::create('histori_ruangan', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedinteger('id_ruangan');
            $table->foreign('id_ruangan')
                ->references('id')
                ->on('ruangan');
            $table->unsignedinteger('id_user');
            $table->foreign('id_user')
                ->references('id')
                ->on('users');
            $table->string('status');
            $table->dateTime('waktu');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('users');
        Schema::dropIfExists('jenis_dokter');
        Schema::dropIfExists('dokter');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('histori_jadwal');
        Schema::dropIfExists('jenis_ruangan');
        Schema::dropIfExists('ruangan');
        Schema::dropIfExists('histori_ruangan');
    }
}
