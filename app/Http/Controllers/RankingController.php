<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function rank($prefecture)
    {
        $omiyages = \DB::table('user_omiyage')->join('omiyages', 'user_omiyage.omiyage_id', '=', 'omiyages.id')->select('omiyages.*', \DB::raw('COUNT(*) as count'))->where('omiyages.prefecture', $prefecture)->groupBy('omiyages.id', 'omiyages.user_id', 'omiyages.omiyage_name', 'omiyages.shop_name', 'omiyages.price', 'omiyages.quantity', 'omiyages.prefecture', 'omiyages.description', 'omiyages.url', 'omiyages.filename', 'omiyages.created_at', 'omiyages.updated_at')->orderBy('count', 'DESC')->take(10)->get();
        
        return view('ranking.rank', [
            'omiyages' => $omiyages, 
        ]);
    }
}

/*
$omiyages = \DB::table('user_omiyage')->join('omiyages', 'user_omiyage.omiyage_id', '=', 'omiyages.id')->select('omiyages.*', \DB::raw('COUNT(*) as count'))->where('omiyages.prefecture', $prefecture)->groupBy('omiyages.id', 'omiyages.user_id', 'omiyages.omiyage_name', 'omiyages.shop_name', 'omiyages.price', 'omiyages.quantity', 'omiyages.prefecture', 'omiyages.description', 'omiyages.url', 'omiyages.created_at', 'omiyages.updated_at')->orderBy('count', 'DESC')->take(10)->get();
