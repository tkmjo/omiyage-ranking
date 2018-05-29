<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Omiyage extends Model
{
    protected $fillable = ['omiyage_name', 'shop_name', 'price', 'quantity', 'prefecture', 'description', 'url', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
