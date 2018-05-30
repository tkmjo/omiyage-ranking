<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function omiyages()
    {
        return $this->hasMany(Omiyage::class);
    }
    
    public function favoriting() {
        return $this->belongsToMany(Omiyage::class, 'user_omiyage', 'user_id', 'omiyage_id')->withTimeStamps();
    }
    
    public function favorite($omiyageId) {
        $exist = $this->is_favoriting($omiyageId);
        if ($exist) {
            return false;
        } else {
            $this->favoriting()->attach($omiyageId);
            return true;
        }
    }
    
    public function unfavorite($omiyageId) {
        $exist = $this->is_favoriting($omiyageId);
        if ($exist) {
            $this->favoriting()->detach($omiyageId);
            return true;
        } else {
            return false;
        }
    }
    
    public function is_favoriting($omiyageId) {
        return $this->favoriting()->where('omiyage_id', $omiyageId)->exists();
    }
}
