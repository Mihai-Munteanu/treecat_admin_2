<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveListing extends Model
{
    protected $guarded = ['id'];
    public $table = 'active_listings';

    public function customerHistory()
    {
        return $this->belongsTo(CustomerHistory::class);
    }
}
