<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // ユーザーが登録しているお気に入りの個数を表示
    public function count_favorites($user) {
        $count_favorites = $user->favoriting()->count();
        return [
            'count_favorites' => $count_favorites,
        ];
    }
    
    // お土産ごとにお気に入り登録しているユーザー数を表示
    public function count_users($omiyage) {
        $count_users = $omiyage->favorited()->count();
        return [
            'count_users' => $count_users,  
        ];
    }
}
