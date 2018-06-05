<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Omiyage extends Model
{
    protected $fillable = ['omiyage_name', 'shop_name', 'price', 'quantity', 'prefecture', 'description', 'url', 'user_id', 'filename'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorited() {
        return $this->belongsToMany(User::class, 'user_omiyage', 'omiyage_id', 'user_id')->withTimeStamps();
    }
}
