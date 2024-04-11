<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    static public function getSingle($product_id)
    {
        return self::find($product_id);
    }
    static public function checkSlug($slug)
    {
        return self::where('slug', '=', $slug)->count();
    }
}
