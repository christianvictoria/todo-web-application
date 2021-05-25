<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareTasks extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','task_id','created_at','updated_at'];

    // public function share()
    // {
    //     return $this->belongsTo(ShareTasks::class);
    // }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
