<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Listing
 *
 * @mixin \Eloquent
 */
class Listing extends Model
{
    protected $table = "listings";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class, 'owner_id');
    }

    protected $fillable = [
        'owner_id','title','location','rating','status','link','company_name'
    ];
}
