<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'is_completed',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Other model methods and properties
}
