<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    // Define the table name if it's not the default plural form
    protected $table = 'pakets';

    // Define the fillable attributes
    protected $fillable = [
        'gambar',
        'nama_paket',
        'harga',
        'deskripsi',
    ];

    // Define the relationship between Paket and User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
