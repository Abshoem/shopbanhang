<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Các trường có thể được điền vào cơ sở dữ liệu
    protected $fillable = ['name', 'image'];

    // Nếu bạn muốn sử dụng timestamp tự động (created_at, updated_at)
    public $timestamps = true;
}