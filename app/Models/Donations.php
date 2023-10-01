<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'item_condition',
        'item_category',
        'sub_category',
        'user_id',
        'likes_count',
        'status',
        'views_count',
        'item_category_id',
        'sub_category_id',
        'image',
    ];

    // Define any relationships or additional methods here
    // ...
}