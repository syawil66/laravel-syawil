<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku'; // sesuai migrasi

    protected $fillable = [
        'judul',
        'gambar',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];

    public function isAvailable()
    {
        return $this->stok > 0;
    }

    public function decreaseStock()
    {
        if ($this->isAvailable()) {
            $this->stok--;
            $this->save();
            return true;
        }
        return false;
    }

    public function increaseStock()
    {
        $this->stok++;
        $this->save();
    }
}
