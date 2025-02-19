<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FormChecklistItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['panel_id' => 1, 'item_pemeriksaan' => 'Kabel utama terpasang dengan baik', 'check' => 'normal', 'keterangan' => 'Tidak ada gangguan'],
            ['panel_id' => 1, 'item_pemeriksaan' => 'MCB berfungsi dengan normal', 'check' => 'normal', 'keterangan' => 'Sudah dicek oleh teknisi'],
            ['panel_id' => 2, 'item_pemeriksaan' => 'Tegangan output sesuai standar', 'check' => 'normal', 'keterangan' => 'Output 220V stabil'],
            ['panel_id' => 2, 'item_pemeriksaan' => 'Koneksi grounding aman', 'check' => 'perbaikan', 'keterangan' => 'Grounding perlu diperbaiki'],
            ['panel_id' => 3, 'item_pemeriksaan' => 'Kondisi isolasi kabel baik', 'check' => 'normal', 'keterangan' => 'Tidak ada indikasi kebocoran'],
            ['panel_id' => 3, 'item_pemeriksaan' => 'Panel bebas dari debu dan kotoran', 'check' => 'perbaikan', 'keterangan' => 'Debu perlu dibersihkan'],
            ['panel_id' => 4, 'item_pemeriksaan' => 'Koneksi antar kabel kuat', 'check' => 'normal', 'keterangan' => 'Semua sambungan aman'],
            ['panel_id' => 4, 'item_pemeriksaan' => 'Saklar utama bekerja dengan baik', 'check' => 'normal', 'keterangan' => 'Sudah diuji coba'],
            ['panel_id' => 5, 'item_pemeriksaan' => 'Temperatur panel dalam batas normal', 'check' => 'perbaikan', 'keterangan' => 'Terlalu panas, perlu pendinginan'],
            ['panel_id' => 5, 'item_pemeriksaan' => 'Pengaman listrik berfungsi', 'check' => 'normal', 'keterangan' => 'Tidak ada pemutusan mendadak'],
            ['panel_id' => 6, 'item_pemeriksaan' => 'Relay dan fuse dalam kondisi baik', 'check' => 'perbaikan', 'keterangan' => 'Fuse perlu diganti'],
            ['panel_id' => 7, 'item_pemeriksaan' => 'Koneksi WiFi UPS terhubung', 'check' => 'normal', 'keterangan' => 'Terhubung dengan server'],
            ['panel_id' => 8, 'item_pemeriksaan' => 'Daya pada panel mencukupi', 'check' => 'normal', 'keterangan' => 'Beban panel sesuai daya'],
            ['panel_id' => 9, 'item_pemeriksaan' => 'Lampu indikator menyala', 'check' => 'perbaikan', 'keterangan' => 'Lampu indikator mati'],
            ['panel_id' => 10, 'item_pemeriksaan' => 'Pengukuran arus sesuai spesifikasi', 'check' => 'normal', 'keterangan' => 'Tidak ada anomali'],
        ];

        foreach ($items as $item) {
            DB::table('form_checklist_items')->insert([
                'panel_id' => $item['panel_id'],
                'item_pemeriksaan' => $item['item_pemeriksaan'],
                'check' => $item['check'],
                'keterangan' => $item['keterangan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
