<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    protected $fillable = [
        'owner_id', 'applied_on', 'contact_name', 'contact_email'
    ];
}
