<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'comment'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
