<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'todo_title', 'todo_content', 'todo_attachment', 'todo_deadline', 'fld_isImportant'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
