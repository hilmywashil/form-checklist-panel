<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormChecklistPanel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_panel',
        'lokasi',
        'nama_pekerjaan',
        'nomor_spk',
        'tanggal_spk'
    ];

    public function formitems(): HasMany
    {
        return $this->hasMany(FormChecklistItem::class, 'panel_id');
    }

    public function checklists()
    {
        return $this->hasMany(FormChecklistDaily::class, 'form_checklist_panel_id');
    }

    public function lokasiRel()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi');
    }
}
