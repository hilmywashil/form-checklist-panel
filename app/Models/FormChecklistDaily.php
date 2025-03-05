<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormChecklistDaily extends Model
{
    use HasFactory;

    protected $fillable = ['item_pemeriksaan', 'status', 'date', 'panel_id'];

    public function panel()
    {
        return $this->belongsTo(FormChecklistPanel::class, 'panel_id');
    }
}
