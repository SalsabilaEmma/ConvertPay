<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLogs extends Model
{
    use HasFactory;
    protected $table = 'transaction_logs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'provider_kode',
        'no_telepon',
        'tgl_transaksi',
        'nominal_pulsa',
        'nilai_konversi',
        'status',
        'deskripsi',
        'balance_before',
        'balance_after',
        'metode_pembayaran',
        'no_rekening',
        'atas_nama'
    ];

    // protected $casts = [
    //     'tgl_transaksi' => 'datetime',
    //     'nominal_pulsa' => 'decimal:2',
    //     'nilai_konversi' => 'decimal:2',
    //     'balance_before' => 'decimal:2',
    //     'balance_after' => 'decimal:2'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Providers::class, 'provider_kode', 'kode');
    }
}
