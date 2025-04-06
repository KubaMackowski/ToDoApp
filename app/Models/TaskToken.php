<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskToken extends Model
{
    protected $fillable = ['task_id', 'token', 'expires_at'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function isExpired()
    {
        return $this->expires_at < now();
    }
}
