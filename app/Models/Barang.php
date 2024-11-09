<?php

namespace App\Models;

use Database\Factories\BarangFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{

    use SoftDeletes;

    protected $table = 'barang';

    protected $primaryKey = 'nobarcode';

    protected $fillable = [
        'nobarcode',
        'nama',
        'harga',
        'stok',
    ];
}
