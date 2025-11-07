<?php

namespace App\Models;

use App\Events\ContractDeleted;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $fillable = ["starting_date", "expiration_date", "template_name", "price_id", "service_id", "word_link", "user_id", "signing_date", "note", "client_id", "pdf_link", "is_active", "is_visible_to_all"];
    protected $appends = ["starting_date_display", "expiration_date_display", "signing_date_display", "client_name", "service_description", "price_value", "username"];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getStartingDateDisplayAttribute()
    {
        return $this->starting_date ? $this->starting_date->format('d.m.Y') : '_';
    }

    public function getExpirationDateDisplayAttribute()
    {
        return $this->expiration_date ? $this->expiration_date->format('d.m.Y') : '_';
    }

    public function getSigningDateDisplayAttribute()
    {
        return $this->signing_date ? $this->signing_date->format('d.m.Y') : '_';
    }

    public function getUpdatedAtDisplayAttribute()
    {
        return $this->updated_at->format('d.m.Y');
    }

    public function getCreatedAtDisplayAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }


    public function getClientNameAttribute()
    {
        return $this->client->name ?? '_';
    }

    public function getServiceDescriptionAttribute()
    {
        return $this->service->description ?? '_';
    }

    public function getPriceValueAttribute()
    {
        return "{$this->price->price} {$this->price->currency} + PDV, riječima: {$this->price->price_words}";
    }

    public function getUsernameAttribute()
    {
        return $this->user->username ?? '_';
    }



    protected $casts = [
        "starting_date" => "date",
        "expiration_date" => "date",
        "signing_date" => "date"
    ];

    protected static function booted()
    {
        static::deleted(function ($contract) {
            event(new ContractDeleted($contract));
        });
    }
}
