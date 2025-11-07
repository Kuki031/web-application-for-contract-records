<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ["user_id", "resource_id", "table", "action", "ip_address"];
    protected $appends = ["updated_at_display", 'username'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasOne(LogDetails::class);
    }

    public function getUpdatedAtDisplayAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('d.m.Y H:i:s') : '_';
    }

    public function getCreatedAtDisplayAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('d.m.Y H:i:s') : '_';
    }

    public function getUsernameAttribute()
    {
        return $this->user->username ?? '_';
    }

    public function getOldValuesAttribute()
    {
        return $this->details?->old_values ?? [];
    }

    public function getNewValuesAttribute()
    {
        return $this->details?->new_values ?? [];
    }
}
