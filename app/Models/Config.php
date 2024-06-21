<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $table = 'configs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kode',
        'keterangan'
    ];

    public function chipLogs()
    {
        return $this->hasMany(ChipLog::class, 'chip_kode', 'kode');
    }
}
