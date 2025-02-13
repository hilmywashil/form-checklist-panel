<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_pemeriksaan',
        'check',
        'keterangan',
        'panel_id'
    ];

    public function panel(): BelongsTo
    {
        return $this->belongsTo(FormChecklistPanel::class, 'panel_id');
    }
}
