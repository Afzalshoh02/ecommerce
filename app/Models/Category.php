<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\select;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getRecord()
    {
        return self::select('categories.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 0)
            ->orderBy('categories.id', 'desc')
            ->get();
    }
}
