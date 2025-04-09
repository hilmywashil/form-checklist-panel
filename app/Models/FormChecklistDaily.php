<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormChecklistDaily extends Model
{
    use HasFactory;
    protected $fillable = ['form_checklist_panel_id', 'teknisi', 'tanggal'];

    public function panel()
    {
        return $this->belongsTo(FormChecklistPanel::class, 'form_checklist_panel_id');
    }

    public function items()
    {
        return $this->hasMany(FormChecklistDailyItem::class, 'form_checklist_daily_id');
    }
}
