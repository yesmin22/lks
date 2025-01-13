<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    protected $table = 'category';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'description',
    ];
}
