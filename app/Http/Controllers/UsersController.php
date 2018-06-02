<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Omiyage;

class UsersController extends Controller
{
    public function favoriting($id)
    {
        $user = User::find($id);
        $omiyages = $user->favoriting()->paginate(10);
        
        $data = [
            'user' => $user,
            'omiyages' => $omiyages,
        ];
        
        $data += $this->count_favorites($user);
        
        return view('users.favoriting', $data);
    }
}
