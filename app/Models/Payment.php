<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ["client_id", "month_year", "status", "contract_id", "sent_date", "note", "user_id"];
    protected $appends = ["username"];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
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
        "sent_date" => "date",
        "month_year" => "date:Y-m"
    ];
}
