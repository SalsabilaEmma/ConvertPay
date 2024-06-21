<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorFaktur extends Model
{
    use HasFactory;
    // protected $table = 'nomor_fakturs';
    protected $primaryKey = 'KODE';
    public $timestamps = false;
    public $keyType = 'string';
    public $fillable = [
        'kode',
        'id'
    ];
}
