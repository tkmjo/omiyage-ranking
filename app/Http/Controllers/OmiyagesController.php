<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\User;
use app\Http\Omiyage;

class OmiyagesController extends Controller
{
    public function index()
    {
        $omiyages = \App\Omiyage::all();
        $data = [
            'omiyages' => $omiyages,  
        ];
        return view('welcome', $data);
    }
    
    public function create() 
    {
        if (\Auth::check()) {
            return view('omiyages.create');
        }
        return view('welcome');
    }
    
    public function show($id)
    {
        $omiyage = \App\Omiyage::find($id);
        
        $data = [
            'omiyage' => $omiyage,  
        ];
        
        return view('omiyages.show', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'omiyage_name' => 'required|max:191', 
            'shop_name' => 'required|max:191', 
            'price' => 'numeric', 
            'quantity' => 'numeric',
            'prefecture' => 'required|max:191',
            'description' => 'max:191',
            'url' => 'max:191',
        ]);
        
        $request->user()->omiyages()->create([
            'omiyage_name' => $request->omiyage_name, 
            'shop_name' => $request->shop_name, 
            'price' => $request->price, 
            'quantity' => $request->quantity,
            'prefecture' => $request->prefecture,
            'description' => $request->description,
            'url' => $request->url,
        ]);
        
        return redirect('/');
    }
    
    public function destroy($id) 
    {
        $omiyage = \App\Omiyage::find($id);
        
        if (\Auth::user()->id == $omiyage->user_id) {
            $omiyage->delete();
        }
        
        return redirect()->back();
    }
}
