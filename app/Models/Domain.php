<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = ['name', 'type', 'registrar', 'user', 'has_access', 'is_redirected', 'is_redirected_where', 'expires_at', 'client_id'];
    protected $appends = ['client_name', 'expires_at_display', 'has_access_display', 'is_redirected_display'];

    protected $casts = [
        "expires_at" => "date",
        "has_access" => "boolean",
        "is_redirected" => "boolean"
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function getClientNameAttribute()
    {
        return $this->client->name ?? '';
    }

    public function getExpiresAtDisplayAttribute()
    {
        return $this->expires_at ? $this->expires_at->format("d.m.Y") : '';
    }

    public function getHasAccessDisplayAttribute()
    {
        return $this->has_access ? "Da" : "Ne";
    }

    public function getIsRedirectedDisplayAttribute()
    {
        return $this->is_redirected ? "Da" : "Ne";
    }
    public function scopeWithClientJoin($query)
    {
        return $query->join('clients', 'domains.client_id', '=', 'clients.id');
    }
}
