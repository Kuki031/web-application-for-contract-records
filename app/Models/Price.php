<?php

namespace App\Models;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ["price", "price_words", "currency"];
    protected $cast = ["currency" => Currency::class];

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
}
