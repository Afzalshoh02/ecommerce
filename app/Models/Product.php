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
    static public function gerRecord()
    {
        return self::select('products.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'products.created_by')
            ->where('products.is_deleted', '=', 0)
            ->orderBy('products.id', 'desc')
            ->paginate(8);
    }

    public function getColor()
    {
        return $this->hasmany(ProductColor::class, 'product_id');
    }

    public function getSize()
    {
        return $this->hasmany(ProductSize::class, 'product_id');
    }

    public function getImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by', 'asc');
    }
}
