<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded=[];
    public $timestamps = false;

    function Category()
    {
        return $this->belongsTo(Category::class);
    }

    function Orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
