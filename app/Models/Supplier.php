<?php

namespace App\Models;

use Database\Factories\SupplierFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'idsup';

    protected $guarded = [];

    protected $table = 'supplier';

    protected static function newFactory()
    {
        return SupplierFactory::new();
    }
}
