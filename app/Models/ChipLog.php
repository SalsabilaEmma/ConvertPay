<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChipLog extends Model
{
    use HasFactory;
    protected $table = 'chip_logs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kode',
        'chip_kode',
        'saldo_awal',
        'total',
        'saldo_real',
        'selisih',
        'keterangan',
    ];

    public function chip()
    {
        return $this->belongsTo(Chip::class, 'chip_kode', 'kode');
    }
}
