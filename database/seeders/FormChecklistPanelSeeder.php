<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FormChecklistPanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $panels = [
            ['nama_panel' => 'Panel Utama Gedung A', 'tanggal' => '2025-02-01', 'lokasi' => 'Gedung A Lantai 1', 'teknisi' => 'Budi Santoso'],
            ['nama_panel' => 'Panel Distribusi Lab', 'tanggal' => '2025-02-03', 'lokasi' => 'Laboratorium Teknik', 'teknisi' => 'Rudi Hartono'],
            ['nama_panel' => 'Panel Cadangan Server', 'tanggal' => '2025-02-05', 'lokasi' => 'Ruang Server 2', 'teknisi' => 'Agus Setiawan'],
            ['nama_panel' => 'Panel Kontrol AC', 'tanggal' => '2025-02-07', 'lokasi' => 'Gedung B Lantai 2', 'teknisi' => 'Eka Pratama'],
            ['nama_panel' => 'Panel Listrik Kantin', 'tanggal' => '2025-02-09', 'lokasi' => 'Kantin Kampus', 'teknisi' => 'Dika Saputra'],
            ['nama_panel' => 'Panel Utama Gedung B', 'tanggal' => '2025-02-11', 'lokasi' => 'Gedung B Lantai 1', 'teknisi' => 'Fajar Maulana'],
            ['nama_panel' => 'Panel Outdoor', 'tanggal' => '2025-02-13', 'lokasi' => 'Taman Kampus', 'teknisi' => 'Hendra Wijaya'],
            ['nama_panel' => 'Panel Workshop', 'tanggal' => '2025-02-15', 'lokasi' => 'Bengkel Teknik', 'teknisi' => 'Yoga Firmansyah'],
            ['nama_panel' => 'Panel Parkiran Basement', 'tanggal' => '2025-02-17', 'lokasi' => 'Basement Parkir', 'teknisi' => 'Aldi Ramadhan'],
            ['nama_panel' => 'Panel Aula Gedung C', 'tanggal' => '2025-02-19', 'lokasi' => 'Gedung C Lantai 3', 'teknisi' => 'Rizki Pratama'],
            ['nama_panel' => 'Panel Listrik Dapur', 'tanggal' => '2025-02-21', 'lokasi' => 'Dapur Kantin', 'teknisi' => 'Arif Kurniawan'],
            ['nama_panel' => 'Panel Laboratorium Komputer', 'tanggal' => '2025-02-23', 'lokasi' => 'Lab Komputer Gedung A', 'teknisi' => 'Bayu Saputra'],
            ['nama_panel' => 'Panel Mesin Lift', 'tanggal' => '2025-02-25', 'lokasi' => 'Gedung Utama Lantai 1', 'teknisi' => 'Fikri Ramadhan'],
            ['nama_panel' => 'Panel Kolam Renang', 'tanggal' => '2025-02-27', 'lokasi' => 'Sport Center', 'teknisi' => 'Rahmat Hidayat'],
            ['nama_panel' => 'Panel Gudang', 'tanggal' => '2025-02-27', 'lokasi' => 'Gudang Pusat', 'teknisi' => 'Joko Widodo'],
        ];

        foreach ($panels as $panel) {
            DB::table('form_checklist_panels')->insert([
                'nama_panel' => $panel['nama_panel'],
                'tanggal' => $panel['tanggal'],
                'lokasi' => $panel['lokasi'],
                'teknisi' => $panel['teknisi'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
