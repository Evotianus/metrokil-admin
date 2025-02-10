<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = 
    [
        'name',
        'category',
        'description',
        'image_url',
    ];
}