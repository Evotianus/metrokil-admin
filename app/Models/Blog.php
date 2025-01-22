<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category',
        'image_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
