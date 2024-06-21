<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;
    protected $table = 'providers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kode',
        'nama',
        'rate',
        'min_transaksi',
        'max_transaksi',
        'biaya_admin',
        'saldo_mengendap',
        'image',
    ];

    public function transactionLogs()
    {
        return $this->hasMany(TransactionLogs::class, 'provider_kode', 'kode');
    }
}
