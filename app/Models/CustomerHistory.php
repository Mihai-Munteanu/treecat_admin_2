<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerHistory extends Model
{
    protected $guarded = ['id'];
    public $table = 'customers_histories';

    public function activeListing(): HasOne
    {
        return $this->hasOne(ActiveListing::class);
    }
}
