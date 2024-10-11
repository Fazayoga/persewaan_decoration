<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'paket_id',
        'event_location',
        'event_start_date',
        'event_end_date',
        'event_start_time',
        'event_end_time',
        'total',
        'status',
    ];    

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
