<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lokasi',
    ];

    public function formchecklistpanels()
    {
        return $this->hasMany(FormChecklistPanel::class, 'lokasi');
    }
}
