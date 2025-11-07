<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hosting extends Model
{

    protected $fillable = ['client_id', 'package_name', 'package_description', 'price', 'expiration_date'];
    protected $appends = ['expiration_date_formatted', 'client_name'];
    protected $casts = [
        'expiration_date' => 'date'
    ];


    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function getExpirationDateFormattedAttribute()
    {
        return $this->expiration_date ? $this->expiration_date->format('d.m.Y') : '_';
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getClientNameAttribute()
    {
        return $this->client->name ?? '';
    }

    public function scopeWithClientJoin($query)
    {
        return $query->join('clients', 'hostings.client_id', '=', 'clients.id');
    }
}
