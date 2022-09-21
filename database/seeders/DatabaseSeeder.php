<?php

namespace Database\Seeders;

use App\Models\AkreditasiKategori;
use App\Models\DosenMaster;
use App\Models\MonevKategori;
use App\Models\MonevMaster;
use App\Models\MutuDokumen;
use App\Models\MutuKategori;
use App\Models\MutuPeriode;
use App\Models\MutuSistem;
use App\Models\SpmiStandarMaster;
use App\Models\TahunMaster;
use App\Models\TendikMaster;
use App\Models\UnitKategori;
use App\Models\UnitMaster;
use App\Models\UnitPengelola;
use App\Models\User;
use App\Models\VersiMaster;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // User::factory(30)->create();
        DosenMaster::create([
            'nama' => 'Muh. Ikhsan Amar',
            'nomor' => '0906019301',
            'gender' => 'L',
            'user_kategori' => '1',
            'unit_master_id' => '1',
            'email' => 'ikhsan@mail.id',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'user_id' => '1',
            'nama' => 'Muh. Ikhsan Amar',
            'nomor' => '0906019301',
            'user_kategori' => '1',
            'unit_master_id' => '1',
            'role' => '1',
            'email' => 'ikhsan@mail.id',
            'password' => Hash::make('12345678'),
            'is_aktif' => '1'
        ]);
        // User --------------------------------------------------- Tahun
        TahunMaster::create([
            'tahun' => '2010'
        ]);
        TahunMaster::create([
            'tahun' => '2011'
        ]);
        TahunMaster::create([
            'tahun' => '2012'
        ]);
        TahunMaster::create([
            'tahun' => '2013'
        ]);
        TahunMaster::create([
            'tahun' => '2014'
        ]);
        TahunMaster::create([
            'tahun' => '2015'
        ]);
        TahunMaster::create([
            'tahun' => '2016'
        ]);
        TahunMaster::create([
            'tahun' => '2017'
        ]);
        TahunMaster::create([
            'tahun' => '2018'
        ]);
        TahunMaster::create([
            'tahun' => '2019'
        ]);
        TahunMaster::create([
            'tahun' => '2020'
        ]);
        TahunMaster::create([
            'tahun' => '2021'
        ]);
        TahunMaster::create([
            'tahun' => '2022'
        ]);
        TahunMaster::create([
            'tahun' => '2023'
        ]);
        // Tahun --------------------------------------------------- SPMI
        MutuSistem::create([
            'nm_sistem_mutu' => 'Kebijakan SPMI',
            'no_sistem_mutu' => '01-SPMI',
            'ket' => 'Dokumen untuk Kategori Kebijakan SPMI'
        ]);
        MutuSistem::create([
            'nm_sistem_mutu' => 'Standar SPMI',
            'no_sistem_mutu' => '02-SPMI',
            'ket' => 'Dokumen untuk Kategori Standar SPMI'
        ]);
        MutuSistem::create([
            'nm_sistem_mutu' => 'Manual SPMI',
            'no_sistem_mutu' => '03-SPMI',
            'ket' => 'Dokumen untuk Kategori Manual SPMI'
        ]);
        MutuSistem::create([
            'nm_sistem_mutu' => 'Prosedur SPMI',
            'no_sistem_mutu' => '04-SPMI',
            'ket' => 'Dokumen untuk Kategori Prosedur SPMI'
        ]);
        MutuSistem::create([
            'nm_sistem_mutu' => 'Furmulir SPMI',
            'no_sistem_mutu' => '05-SPMI',
            'ket' => 'Dokumen untuk Kategori Formulir SPMI'
        ]);
        // Mutu Sistem --------------------------------------------------- Mutu Kategori
        MutuKategori::create([
            'nm_kategori_mutu' => 'Kebijakan SPMI',
            'no_kategori_mutu' => '01-01-SPMI',
            'mutu_sistem_id' => '1',
            'ket' => 'Dokumen untuk Kategori Kebijakan SPMI'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Standar Pendidikan',
            'no_kategori_mutu' => '02-01-SPMI',
            'mutu_sistem_id' => '2',
            'ket' => 'Dokumen untuk Kategori Standar Pendidikan'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Standar Penelitian',
            'no_kategori_mutu' => '02-02-SPMI',
            'mutu_sistem_id' => '2',
            'ket' => 'Dokumen untuk Kategori Standar Penelitian'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Standar Pengabdian Masyarakat',
            'no_kategori_mutu' => '02-03-SPMI',
            'mutu_sistem_id' => '2',
            'ket' => 'Dokumen untuk Kategori Standar Pengabdian Masyarakat'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Standar Tambahan Bidang Akademik',
            'no_kategori_mutu' => '02-04-SPMI',
            'mutu_sistem_id' => '2',
            'ket' => 'Dokumen untuk Kategori Standar Tambahan Bidang Akademik'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Standar Tambahan Bidang Non Akademik',
            'no_kategori_mutu' => '02-05-SPMI',
            'mutu_sistem_id' => '2',
            'ket' => 'Dokumen untuk Kategori Standar Tambahan Bidang Non Akademik'
        ]);
        // Standar SPMI --------------------------------------------------- Manual SPMI
        MutuKategori::create([
            'nm_kategori_mutu' => 'Manual Pendidikan',
            'no_kategori_mutu' => '03-01-SPMI',
            'mutu_sistem_id' => '3',
            'ket' => 'Dokumen untuk Kategori Manual Pendidikan'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Manual Penelitian',
            'no_kategori_mutu' => '03-02-SPMI',
            'mutu_sistem_id' => '3',
            'ket' => 'Dokumen untuk Kategori Manual Penelitian'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Manual Pengabdian Masyarakat',
            'no_kategori_mutu' => '03-03-SPMI',
            'mutu_sistem_id' => '3',
            'ket' => 'Dokumen untuk Kategori Manual Pengabdian Masyarakat'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Manual Tambahan Bidang Akademik',
            'no_kategori_mutu' => '03-04-SPMI',
            'mutu_sistem_id' => '3',
            'ket' => 'Dokumen untuk Kategori Manual Tambahan Bidang Akademik'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Manual Tambahan Bidang Non Akademik',
            'no_kategori_mutu' => '03-05-SPMI',
            'mutu_sistem_id' => '3',
            'ket' => 'Dokumen untuk Kategori Manual Tambahan Bidang Non Akademik'
        ]);
        // Manual SPMI --------------------------------------------------- Prosedur SPMI
        MutuKategori::create([
            'nm_kategori_mutu' => 'Prosedur Pendidikan',
            'no_kategori_mutu' => '04-01-SPMI',
            'mutu_sistem_id' => '4',
            'ket' => 'Dokumen untuk Kategori Prosedur Pendidikan'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Prosedur Penelitian',
            'no_kategori_mutu' => '04-02-SPMI',
            'mutu_sistem_id' => '4',
            'ket' => 'Dokumen untuk Kategori Prosedur Penelitian'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Prosedur Pengabdian Masyarakat',
            'no_kategori_mutu' => '04-03-SPMI',
            'mutu_sistem_id' => '4',
            'ket' => 'Dokumen untuk Kategori Prosedur Pengabdian Masyarakat'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Prosedur Tambahan Bidang Akademik',
            'no_kategori_mutu' => '04-04-SPMI',
            'mutu_sistem_id' => '4',
            'ket' => 'Dokumen untuk Kategori Prosedur Tambahan Bidang Akademik'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Prosedur Tambahan Bidang Non Akademik',
            'no_kategori_mutu' => '04-05-SPMI',
            'mutu_sistem_id' => '4',
            'ket' => 'Dokumen untuk Kategori Prosedur Tambahan Bidang Non Akademik'
        ]);
        // Prosedur SPMI --------------------------------------------------- Formulir SPMI
        MutuKategori::create([
            'nm_kategori_mutu' => 'Formulir Pendidikan',
            'no_kategori_mutu' => '05-01-SPMI',
            'mutu_sistem_id' => '5',
            'ket' => 'Dokumen untuk Kategori Formulir Pendidikan'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Formulir Penelitian',
            'no_kategori_mutu' => '05-02-SPMI',
            'mutu_sistem_id' => '5',
            'ket' => 'Dokumen untuk Kategori Formulir Penelitian'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Formulir Pengabdian Masyarakat',
            'no_kategori_mutu' => '05-03-SPMI',
            'mutu_sistem_id' => '5',
            'ket' => 'Dokumen untuk Kategori Formulir Pengabdian Masyarakat'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Formulir Tambahan Bidang Akademik',
            'no_kategori_mutu' => '05-04-SPMI',
            'mutu_sistem_id' => '5',
            'ket' => 'Dokumen untuk Kategori Formulir Tambahan Bidang Akademik'
        ]);
        MutuKategori::create([
            'nm_kategori_mutu' => 'Formulir Tambahan Bidang Non Akademik',
            'no_kategori_mutu' => '05-05-SPMI',
            'mutu_sistem_id' => '5',
            'ket' => 'Dokumen untuk Kategori Formulir Tambahan Bidang Non Akademik'
        ]);
        // Kategori Mutu --------------------------------------------------- Dokumen Mutu
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Legal dan Kepemilikan Aset',
            'no_dokumen_mutu' => '01-Legal',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Legal dan Kepemilikan Aset'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK dan Statuta Institusi',
            'no_dokumen_mutu' => '02-Statuta',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori SK dan Statuta Institusi'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Dokumen VMTS',
            'no_dokumen_mutu' => '03-VMTS',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori VMTS'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Rencana Induk Pengembangan',
            'no_dokumen_mutu' => '04-RIP',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Rencana Induk Pengembangan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Rencana Strategis',
            'no_dokumen_mutu' => '05-RENSTRA',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Rencana Strategis'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Akademik',
            'no_dokumen_mutu' => '06-Akademik',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Akademik'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Penelitian',
            'no_dokumen_mutu' => '07-Penelitian',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Penelitian'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Pengabdian Masyarakat',
            'no_dokumen_mutu' => '08-PKM',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Pengabdian Masyarakat'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Kemahasiswaan',
            'no_dokumen_mutu' => '09-Kemahasiswaan',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Kemahasiswaan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman PMB',
            'no_dokumen_mutu' => '10-PMB',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman PMB'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Tata Pamong',
            'no_dokumen_mutu' => '11-Tata Pamong',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Tata Pamong'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Tata Kelola',
            'no_dokumen_mutu' => '12-Tata Kelola',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Tata Kelola'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Kepegawaian',
            'no_dokumen_mutu' => '13-Kepegawaian',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Kepegawaian'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Keuangan',
            'no_dokumen_mutu' => '14-Keuangan',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Keuangan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Sarana dan Prasarana',
            'no_dokumen_mutu' => '15-Sarpras',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Sarana dan Prasarana'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Kerjasama',
            'no_dokumen_mutu' => '16-Kerjasama',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Kerjasama'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Teknologi dan Sistem Informasi',
            'no_dokumen_mutu' => '17-SISFO',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Teknologi dan Sistem Informasi'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Penjaminan Mutu',
            'no_dokumen_mutu' => '18-Mutu',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Penjaminan Mutu'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Audit Mutu Internal',
            'no_dokumen_mutu' => '19-AMI',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Audit Mutu Internal'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Kebijakan dan Pedoman Monev',
            'no_dokumen_mutu' => '20-Monev',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Kebijakan dan Pedoman Monev'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Dokumen Instrumen Monev',
            'no_dokumen_mutu' => '21-Mutu',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Dokumen Instrumen Monev'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Dokumen Instrumen Ketercapaian Kinerja',
            'no_dokumen_mutu' => '22-Mutu',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Dokumen Instrumen Ketercapaian Kinerja'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Dokumen SK Struktur Organisasi',
            'no_dokumen_mutu' => '23-SK',
            'jenis_dokumen_mutu' => 'Dokumen Induk',
            'ket' => 'Dokumen untuk Kategori Dokumen SK Struktur Organisasi'
        ]);
        // Dokumen Mutu/Induk --------------------------------------------------- Dokumen Mutu/Kinerja
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Rencana Operasional',
            'no_dokumen_mutu' => '01-RENOP',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Rencana Operasional'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Program Kerja',
            'no_dokumen_mutu' => '02-PROKER',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Program Kerja'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Rincian Angaran Pendapatan dan Belanja',
            'no_dokumen_mutu' => '03-RAPB',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Rincian Angaran Pendapatan dan Belanja'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Rencana Kerja Tahunan',
            'no_dokumen_mutu' => '04-RKT',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Rencana Kerja Tahunan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Rencana Kerja Semester',
            'no_dokumen_mutu' => '05-RKS',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Rencana Kerja Semester'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Realisasi Kerja Tahunan',
            'no_dokumen_mutu' => '06-LRKT',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Realisasi Kerja Tahunan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Realisasi Kerja Semester',
            'no_dokumen_mutu' => '07-LRKS',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Realisasi Kerja Semester'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja VMTS',
            'no_dokumen_mutu' => '08-Kinerja VMTS',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja VMTS'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja RIP',
            'no_dokumen_mutu' => '09-Kinerja RIP',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja RIP'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja RENSTRA',
            'no_dokumen_mutu' => '10-Kinerja RENSTRA',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja RENSTRA'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja RENOP',
            'no_dokumen_mutu' => '11-Kinerja RENOP',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja RENOP'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Analisis SWOT',
            'no_dokumen_mutu' => '12-Kinerja SWOT',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Analisis SWOT'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Akademik',
            'no_dokumen_mutu' => '13-Akademik',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Akademik'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Kemahasiswaan',
            'no_dokumen_mutu' => '14-Kemahasiswaan',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Kemahasiswaan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Penelitian',
            'no_dokumen_mutu' => '15-Penelitian',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Penelitian'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Pengabdian Masyaarakat',
            'no_dokumen_mutu' => '16-PKM',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Pengabdian Masyarakat'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Kerjasama',
            'no_dokumen_mutu' => '17-Kerjasama',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Kerjasama'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja SPMI',
            'no_dokumen_mutu' => '18-Kinerja SPMI',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja SPMI'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Audit Mutu Internal',
            'no_dokumen_mutu' => '19-AMI',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Audit Mutu Internal'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Rapat Tinjauan Manajemen',
            'no_dokumen_mutu' => '20-RTM',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Rapat Tinjauan Manajemen'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Tindak Lanjut',
            'no_dokumen_mutu' => '21-AMI',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Tindak Lanjut'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Audit Mutu Non Akademik',
            'no_dokumen_mutu' => '22-SPI',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Audit Mutu Non Akademik'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja PMB',
            'no_dokumen_mutu' => '23-PMB',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja PMB'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Institusi',
            'no_dokumen_mutu' => '24-Institusi',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Institusi'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Pejabat Struktural',
            'no_dokumen_mutu' => '25-Struktural',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Pejabat Struktural'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Dosen',
            'no_dokumen_mutu' => '26-Dosen',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Dosen'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Tendik',
            'no_dokumen_mutu' => '27-Tendik',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Tendik'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Teknologi dan Sistem Informasi',
            'no_dokumen_mutu' => '28-Kinerja SISFO',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Teknologi dan Sistem Informasi'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Sarana dan Prasarana',
            'no_dokumen_mutu' => '29-Kinerja SARPRAS',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Sarana dan Prasarana'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Keuangan',
            'no_dokumen_mutu' => '30-Kinerja SARPRAS',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Keuangan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'Laporan Kinerja Monev',
            'no_dokumen_mutu' => '31-Kinerja Monev',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori Laporan Kinerja Monev'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Bidang Akademik',
            'no_dokumen_mutu' => '32-SK Akademik',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Bidang Akademik'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Bidang Kemahasiswaan',
            'no_dokumen_mutu' => '33-SK Kemahasiswaan',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Bidang Kemahasiswaan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Bidang Kerjasama',
            'no_dokumen_mutu' => '34-SK Kerjasama',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Bidang Kerjasama'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Bidang Kepegawaian',
            'no_dokumen_mutu' => '35-SK Kepegawaian',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Bidang Kepegawaian'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Bidang Keuangan',
            'no_dokumen_mutu' => '36-SK Keuangan',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Bidang Keuangan'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Bidang SARPRAS',
            'no_dokumen_mutu' => '37-SK SARPRAS',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Bidang SARPRAS'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Yudisium dan Penyelesaian Studi',
            'no_dokumen_mutu' => '38-SK Yudisium',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Yudisium dan Penyelesaian Studi'
        ]);
        MutuDokumen::create([
            'nm_dokumen_mutu' => 'SK Bidang Lainnya',
            'no_dokumen_mutu' => '39-SK Lainnya',
            'jenis_dokumen_mutu' => 'Dokumen Kinerja',
            'ket' => 'Dokumen untuk Kategori SK Bidang Lainnya'
        ]);
        // Dokumen Mutu --------------------------------------------------- Monev Kategori
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria VMTS',
            'no_jenis_monev' => '01-Kriteria VMTS',
            'ket' => 'Dokumen untuk Kategori VMTS'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria SPMI, Tata Pamong & Tata Kelola',
            'no_jenis_monev' => '02-Kriteria TP-TK',
            'ket' => 'Dokumen untuk Kategori SPMI, Tata Pamong & Tata Kelola'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Monev Kerjasama',
            'no_jenis_monev' => '03-Kerjasama',
            'ket' => 'Dokumen untuk Kategori Kerjasama'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria Kemahasiswaan',
            'no_jenis_monev' => '04-Kemahasiswaan',
            'ket' => 'Dokumen untuk Kategori Kemahasiswaan'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria SDM',
            'no_jenis_monev' => '05-SDM',
            'ket' => 'Dokumen untuk Kategori SDM'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria Keuangan dan Sarpras',
            'no_jenis_monev' => '06-Keu-Sarpras',
            'ket' => 'Dokumen untuk Kategori Keuangan dan Sarpras'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria Pendidikan',
            'no_jenis_monev' => '07-Pendidikan',
            'ket' => 'Dokumen untuk Kategori Pendidikan'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria Penelitian',
            'no_jenis_monev' => '08-Penelitian',
            'ket' => 'Dokumen untuk Kategori Penelitian'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria Pengabdian Masyarakat',
            'no_jenis_monev' => '09-PKM',
            'ket' => 'Dokumen untuk Kategori Pengabdian Masyarakat'
        ]);
        MonevKategori::create([
            'nm_jenis_monev' => 'Kriteria Luaran dan Capaian Tri Darma',
            'no_jenis_monev' => '10-Luaran',
            'ket' => 'Dokumen untuk Kategori Luaran dan Capaian Tri Darma'
        ]);
        // Monev Kategori --------------------------------------------------- Monev Master
        MonevMaster::create([
            'nm_monev' => 'Monev Pemahaman VMTS',
            'no_monev' => '01-Pemahaman VMTS',
            'monev_kategori_id' => '1',
            'ket' => 'Monev untuk Kategori Pemahaman VMTS'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev RENSTRA',
            'no_monev' => '02-Monev RENSTRA',
            'monev_kategori_id' => '1',
            'ket' => 'Monev untuk Kategori RENSTRA'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Terhadap Manajemen',
            'no_monev' => '03-Monev Manajemen',
            'monev_kategori_id' => '2',
            'ket' => 'Monev untuk Kategori Kepuasan Terhadap Manajemen'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev SPMI',
            'no_monev' => '04-Monev SPMI',
            'monev_kategori_id' => '2',
            'ket' => 'Monev untuk Kategori SPMI'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Umpan Balik Kerjasama',
            'no_monev' => '05-Monev Kerjasama',
            'monev_kategori_id' => '3',
            'ket' => 'Monev untuk Kategori Umpan Balik Kerjasama'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Mahasiswa Terhadap Dosen',
            'no_monev' => '06-Monev Mahasiswa',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Kepuasan Mahasiswa Terhadap Dosen'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Mahasiswa Terhadap Tendik',
            'no_monev' => '07-Monev Mahasiswa',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Kepuasan Mahasiswa Terhadap Tendik'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Mahasiswa Terhadap Pimpinan',
            'no_monev' => '08-Monev Mahasiswa',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Kepuasan Mahasiswa Terhadap Pimpinan'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Mahasiswa Terhadap Sarpras',
            'no_monev' => '09-Monev Mahasiswa',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Kepuasan Mahasiswa Terhadap Sarpras'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Evaluasi Dosen Oleh Mahasiswa',
            'no_monev' => '10-Monev EDOM',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Evaluasi Dosen Oleh Mahasiswa'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Mahasiswa Terhadap Dosen PA',
            'no_monev' => '11-Monev PA',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Kepuasan Mahasiswa Terhadap Layanan Dosen PA'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Mahasiswa Terhadap PMB',
            'no_monev' => '12-Monev PMB',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Kepuasan Mahasiswa Terhadap Layanan PMB'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Mahasiswa Terhadap Layanan',
            'no_monev' => '13-Monev Layanan',
            'monev_kategori_id' => '4',
            'ket' => 'Monev untuk Kategori Kepuasan Mahasiswa Terhadap Layanan Layanan'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Dosen',
            'no_monev' => '14-Kepuasan Dosen',
            'monev_kategori_id' => '5',
            'ket' => 'Monev untuk Kategori Kepuasan Dosen'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Tendik',
            'no_monev' => '15-Kepuasan Tendik',
            'monev_kategori_id' => '5',
            'ket' => 'Monev untuk Kategori Kepuasan Tendik'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev BKD/LKD',
            'no_monev' => '16-Monev BKD/LKD',
            'monev_kategori_id' => '5',
            'ket' => 'Monev untuk Kategori BKD/LKD'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev DP3/KPI',
            'no_monev' => '17-Monev DP3/KPI',
            'monev_kategori_id' => '5',
            'ket' => 'Monev untuk Kategori DP3/KPI'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Keuangan',
            'no_monev' => '18-Monev Keuangan',
            'monev_kategori_id' => '6',
            'ket' => 'Monev untuk Kategori Keuangan'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev SARPRAS',
            'no_monev' => '19-Monev SARPRAS',
            'monev_kategori_id' => '6',
            'ket' => 'Monev untuk Kategori SARPRAS'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Pendidikan/Pembelajaran',
            'no_monev' => '20-Monev Pendidikan',
            'monev_kategori_id' => '7',
            'ket' => 'Monev untuk Kategori Pendidikan/Pembelajaran'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kurikulum',
            'no_monev' => '21-Monev Kurukulum',
            'monev_kategori_id' => '7',
            'ket' => 'Monev untuk Kategori Kurikulum'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Suasana Akademik',
            'no_monev' => '22-Monev Suasana',
            'monev_kategori_id' => '7',
            'ket' => 'Monev untuk Kategori Suasana Akademik'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Penelitian',
            'no_monev' => '23-Monev Penelitian',
            'monev_kategori_id' => '8',
            'ket' => 'Monev untuk Kategori Kepuasan Penelitian'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Pembimbingan Tugas Akhir',
            'no_monev' => '24-Monev TA',
            'monev_kategori_id' => '8',
            'ket' => 'Monev untuk Kategori Kepuasan Pembimbingan Tugas Akhir'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Pengabdian Masyarakat',
            'no_monev' => '25-Monev PKM',
            'monev_kategori_id' => '9',
            'ket' => 'Monev untuk Kategori Kepuasan Pengabdian Masyarakat'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan KKN/PKL',
            'no_monev' => '26-Monev KKN',
            'monev_kategori_id' => '9',
            'ket' => 'Monev untuk Kategori Kepuasan KKN/PKL'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Alumni',
            'no_monev' => '27-Monev Alumni',
            'monev_kategori_id' => '10',
            'ket' => 'Monev untuk Kategori Kepuasan Alumni'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Kepuasan Pengguna Lulusan',
            'no_monev' => '28-Monev Stakeholde',
            'monev_kategori_id' => '10',
            'ket' => 'Monev untuk Kategori Kepuasan Pengguna Lulusan'
        ]);
        MonevMaster::create([
            'nm_monev' => 'Monev Masa Tunggu Lulusan',
            'no_monev' => '29-Masa Tunggu',
            'monev_kategori_id' => '10',
            'ket' => 'Monev untuk Kategori Masa Tunggu Lulusan'
        ]);
        // Monev Master --------------------------------------------------- Unit Kategori
        UnitKategori::create([
            'nm_unit_kategori' => 'Institusi',
            'no_unit_kategori' => '01-INS'
        ]);
        UnitKategori::create([
            'nm_unit_kategori' => 'Fakultas',
            'no_unit_kategori' => '02-FK'
        ]);
        UnitKategori::create([
            'nm_unit_kategori' => 'Program Studi',
            'no_unit_kategori' => '03-PS'
        ]);
        UnitKategori::create([
            'nm_unit_kategori' => 'Lembaga',
            'no_unit_kategori' => '04-LM'
        ]);
        UnitKategori::create([
            'nm_unit_kategori' => 'Badan',
            'no_unit_kategori' => '05-BD'
        ]);
        UnitKategori::create([
            'nm_unit_kategori' => 'Biro',
            'no_unit_kategori' => '06-BR'
        ]);
        UnitKategori::create([
            'nm_unit_kategori' => 'Unit',
            'no_unit_kategori' => '07-Unit'
        ]);
        UnitKategori::create([
            'nm_unit_kategori' => 'Satuan Kerja',
            'no_unit_kategori' => '08-SatKer'
        ]);
        // Unit Kategori --------------------------------------------------- Unit Pengelola
        UnitPengelola::create([
            'nm_unit_pengelola' => 'Yayasan Pendidikan Islam Mega Rezky Makassar',
            'no_unit_pengelola' => '01-YYS'
        ]);
        UnitPengelola::create([
            'nm_unit_pengelola' => 'Universitas Megarezky',
            'no_unit_pengelola' => '02-Univ'
        ]);
        UnitPengelola::create([
            'nm_unit_pengelola' => 'Lembaga Penjaminan Mutu',
            'no_unit_pengelola' => '03-LPM'
        ]);
        // Unit Pengelola --------------------------------------------------- Unit Master
        UnitMaster::create([
            'nm_unit' => 'Universitas Megarezky',
            'no_unit' => '091056',
            'no_penetapan_unit' => '750/KPT/I/2018',
            'tgl_penetapan_unit' => '2018-09-06',
            'unit_kategori_id' => '1',
            'unit_pengelola_id' => '1',
            'ket' => 'Universitas Megarezky Ditetapkan oleh Menteri Pendidikan dan Kebudayaan Melaui SK Nomor: 750/KPT/I/2018'
        ]);
        UnitMaster::create([
            'nm_unit' => 'Prodi S1 Farmasi',
            'no_unit' => '163020-48201',
            'no_penetapan_unit' => '2733/D/T/K-IX/2009',
            'tgl_penetapan_unit' => '2009-01-01',
            'unit_kategori_id' => '3',
            'unit_pengelola_id' => '2',
            'ket' => 'Prodi S1 Farmasi Ditetapkan oleh Menteri Pendidikan dan Kebudayaan Melaui SK Nomor: 2733/D/T/K-IX/2009'
        ]);
        UnitMaster::create([
            'nm_unit' => 'Prodi D3 Farmasi',
            'no_unit' => '163020-48401',
            'no_penetapan_unit' => '758/KPT/I/2018',
            'tgl_penetapan_unit' => '2018-01-01',
            'unit_kategori_id' => '3',
            'unit_pengelola_id' => '2',
            'ket' => 'Prodi D3 Farmasi Ditetapkan oleh Menteri Pendidikan dan Kebudayaan Melaui SK Nomor: 758/KPT/I/2018'
        ]);
        // Unit Master --------------------------------------------------- Versi Master
        VersiMaster::create([
            'nm_versi' => 'Versi Master',
            'no_versi' => 'v1',
            'no_pengesahan_versi' => '.../...../...../....',
            'ket' => 'Versi Master Ditetapkan pada Tanggal ........ oleh Rektor Universitas .........'
        ]);
        MutuPeriode::create([
            'siklus' => '2016-2017',
            'tgl_awal' => '2016-09-01',
            'tgl_akhir' => '2017-08-30',
            'akreditasi' => '1',
            'spmi' => '1'
        ]);
        MutuPeriode::create([
            'siklus' => '2017-2018',
            'tgl_awal' => '2017-09-01',
            'tgl_akhir' => '2018-08-30',
            'akreditasi' => '1',
            'spmi' => '1'
        ]);
        MutuPeriode::create([
            'siklus' => '2018-2019',
            'tgl_awal' => '2018-09-01',
            'tgl_akhir' => '2019-08-30',
            'akreditasi' => '1',
            'spmi' => '1'
        ]);
        MutuPeriode::create([
            'siklus' => '2019-2020',
            'tgl_awal' => '2019-09-01',
            'tgl_akhir' => '2020-08-31',
            'akreditasi' => '1',
            'spmi' => '1'
        ]);
        MutuPeriode::create([
            'siklus' => '2020-2021',
            'tgl_awal' => '2020-09-01',
            'tgl_akhir' => '2021-08-31',
            'akreditasi' => '1',
            'spmi' => '1'
        ]);
        MutuPeriode::create([
            'siklus' => '2021-2022',
            'tgl_awal' => '2021-09-01',
            'tgl_akhir' => '2022-08-31',
            'akreditasi' => '1',
            'spmi' => '1'
        ]);
        MutuPeriode::create([
            'siklus' => '2022-2023',
            'tgl_awal' => '2022-09-01',
            'tgl_akhir' => '2023-08-31',
            'akreditasi' => '1',
            'spmi' => '1'
        ]);
        // Versi Master --------------------------------------------------- Standar Master / Pendidikan
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Kompetensi Lulusan',
            'no_standar_spmi' => 'LPM.xxxx/SP1',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP2',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP3',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP4',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Dosen dan Tenaga Kependidikan',
            'no_standar_spmi' => 'LPM.xxxx/SP5',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP6',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP7',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pembiayaan Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP8',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        // Standar --------------------------------------------------- Standar Master / Penelitian
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Hasil Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST1',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST2',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST3',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST4',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Peneliti',
            'no_standar_spmi' => 'LPM.xxxx/ST5',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST6',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST7',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pendanaan dan Pembiayaan Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST8',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        // Standar --------------------------------------------------- Standar Master / Pengabdian
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Hasil PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA1',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA2',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA3',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA4',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pelaksana PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA5',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA6',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA7',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pendanaan dan Pembiayaan PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA8',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '1',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        //==============================================================
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Kompetensi Lulusan',
            'no_standar_spmi' => 'LPM.xxxx/SP1',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP2',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP3',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP4',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Dosen dan Tenaga Kependidikan',
            'no_standar_spmi' => 'LPM.xxxx/SP5',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP6',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP7',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pembiayaan Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP8',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        // Standar --------------------------------------------------- Standar Master / Penelitian
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Hasil Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST1',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST2',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST3',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST4',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Peneliti',
            'no_standar_spmi' => 'LPM.xxxx/ST5',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST6',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST7',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pendanaan dan Pembiayaan Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST8',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        // Standar --------------------------------------------------- Standar Master / Pengabdian
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Hasil PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA1',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA2',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA3',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA4',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pelaksana PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA5',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA6',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA7',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pendanaan dan Pembiayaan PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA8',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '2',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        //==============================================================
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Kompetensi Lulusan',
            'no_standar_spmi' => 'LPM.xxxx/SP1',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP2',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP3',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP4',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Dosen dan Tenaga Kependidikan',
            'no_standar_spmi' => 'LPM.xxxx/SP5',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP6',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP7',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pembiayaan Pembelajaran',
            'no_standar_spmi' => 'LPM.xxxx/SP8',
            'mutu_kategori_id' => '2',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        // Standar --------------------------------------------------- Standar Master / Penelitian
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Hasil Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST1',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST2',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST3',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST4',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Peneliti',
            'no_standar_spmi' => 'LPM.xxxx/ST5',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST6',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST7',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pendanaan dan Pembiayaan Penelitian',
            'no_standar_spmi' => 'LPM.xxxx/ST8',
            'mutu_kategori_id' => '3',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        // Standar --------------------------------------------------- Standar Master / Pengabdian
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Hasil PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA1',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Isi PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA2',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Proses PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA3',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Penilaian PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA4',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pelaksana PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA5',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Sarana dan Prasarana PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA6',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pengelolaan PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA7',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        SpmiStandarMaster::create([
            'nm_standar_spmi' => 'Standar Pendanaan dan Pembiayaan PKM',
            'no_standar_spmi' => 'LPM.xxxx/SA8',
            'mutu_kategori_id' => '4',
            'unit_master_id' => '3',
            'versi_master_id' => '1',
            'status_spmi' => '1'
        ]);
        // Standar Master / Pengabdian --------------------------------------------------- Akreditasi
        AkreditasiKategori::create([
            'nm_kategori' => 'IAPT BAN-PT',
            'no_kategori' => '01 BAN-PT',
            'ket' => 'Instrumen Akreditasi Institusi BAN-PT'
        ]);
        AkreditasiKategori::create([
            'nm_kategori' => 'IAPS Profesi LAM-PT KES',
            'no_kategori' => '03 LAM-PT KES',
            'ket' => 'Instrumen Akreditasi Program Studi Profesi LAM-PT KES'
        ]);
        AkreditasiKategori::create([
            'nm_kategori' => 'IAPS Sarjana LAM-PT KES',
            'no_kategori' => '04 LAM-PT KES',
            'ket' => 'Instrumen Akreditasi Program Studi Sarjana LAM-PT KES'
        ]);
        AkreditasiKategori::create([
            'nm_kategori' => 'IAPS Diploma LAM-PT KES',
            'no_kategori' => '05 LAM-PT KES',
            'ket' => 'Instrumen Akreditasi Program Studi Diploma LAM-PT KES'
        ]);
    }
}
