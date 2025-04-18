<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormChecklistDailyItem extends Model
{
    use HasFactory;
    protected $fillable = ['form_checklist_daily_id', 'form_checklist_item_id', 'kondisi', 'keterangan'];

    public function daily()
    {
        return $this->belongsTo(FormChecklistDaily::class, 'form_checklist_daily_id');
    }

    public function item()
    {
        return $this->belongsTo(FormChecklistItem::class, 'form_checklist_item_id');
    }

    public function panel()
    {
        return $this->belongsTo(FormChecklistPanel::class, 'form_checklist_panel_id');
    }
}
