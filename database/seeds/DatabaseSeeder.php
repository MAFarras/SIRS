<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //jabatan
         DB::table('jabatan')->insert([
            'jabatan' => 'SuperAdmin',
            'keterangan' => 'Bisa mengakses semua',
        ]);

         DB::table('jabatan')->insert([
            'jabatan' => 'Admin',
            'keterangan' => 'Bisa mengakses semua akan tetapi tidak bisa mengubah nama atau menghapus sesama admin',
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'HRD',
            'keterangan' => 'Hanya bisa mengakses bagian yang berhubungan dengan dokter dan mengatur jadwal',
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Admin Ruangan',
            'keterangan' => 'Bisa mengatur ruangan',
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Pengawas',
            'keterangan' => 'Hanya bisa mengubah status kamar dan melihat status kamar',
        ]);

        //jenis ruangan
        DB::table('jenis_ruangan')->insert([
            'nama' => 'Kelas ekonomi',
        ]);

        DB::table('jenis_ruangan')->insert([
            'nama' => 'Kelas Bisnis',
        ]);

        DB::table('jenis_ruangan')->insert([
            'nama' => 'Kelas VIP',
        ]);

        //jenis dokter
        DB::table('jenis_dokter')->insert([
            'nama' => 'Dokter Umum',
            'keterangan' => 'Menagani penyakit umum',
        ]);

        DB::table('jenis_dokter')->insert([
            'nama' => 'Dokter Spesialis',
            'keterangan' => 'Menagani penyakit lebih khusus',
        ]);

        DB::table('jenis_dokter')->insert([
            'nama' => 'Dokter Kandungan',
            'keterangan' => 'Menagani perawatan ibu hamil',
        ]);
        DB::table('jenis_dokter')->insert([
            'nama' => 'Dokter Mata',
            'keterangan' => 'Menagani berbagai penyakit mata',
        ]);
    }
}
