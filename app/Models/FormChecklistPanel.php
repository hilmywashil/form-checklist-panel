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
        'tanggal',
        'lokasi',
        'teknisi'
    ];

    public function formitems(): HasMany
    {
        return $this->hasMany(FormChecklistItem::class, 'panel_id');
    }

    public function checklists()
    {
        return $this->hasMany(FormChecklistDaily::class, 'panel_id');
    }
}
