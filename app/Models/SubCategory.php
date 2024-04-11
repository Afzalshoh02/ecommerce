<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('sub_categories.*', 'users.name as created_by_name', 'categories.name as category_name')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->orderBy('sub_categories.id', 'desc')->get();
//            ->paginate(20);
    }
}
