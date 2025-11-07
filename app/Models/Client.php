<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ["name", "address", "oib", "representer", "connection_tag", "type_of_partner", "phone", "email", "seller", "activities", "city", "country"];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function hostings()
    {
        return $this->hasMany(Hosting::class);
    }
}
