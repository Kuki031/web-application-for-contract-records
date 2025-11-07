<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDetails extends Model
{

    protected $fillable = ["old_values", "new_values", "log_id", "user_id"];
    protected $appends = ["username"];

    public function log()
    {
        return $this->belongsTo(Log::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsernameAttribute()
    {
        return $this->user->username ?? '_';
    }

    protected $casts = [
        "old_values" => "array",
        "new_values" => "array"
    ];
}
