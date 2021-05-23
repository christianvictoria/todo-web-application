<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_title', 'todo_content', 'todo_attachment', 'user_id','fld_isImportant'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
