<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $table = 'product_colors';
    static public function DeleteRecord($product_id)
    {
        return self::where('product_id', $product_id)->delete();
    }
}
