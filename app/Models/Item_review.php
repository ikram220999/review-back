<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item_review extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];

    protected $table = "item_reviews";
}
