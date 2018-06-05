<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\User;
use App\Http\Omiyage;

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
            'file' => [
                'required',
                'file',
            ]
        ]);
        
        if ($request->file('file')->isValid([])) {
            $filename = $request->file->store('public/image');
            $omiyage = new \App\Omiyage;
            $omiyage->find($request->id);
            
            $request->user()->omiyages()->create([
            'omiyage_name' => $request->omiyage_name, 
            'shop_name' => $request->shop_name, 
            'price' => $request->price, 
            'quantity' => $request->quantity,
            'prefecture' => $request->prefecture,
            'description' => $request->description,
            'url' => $request->url,
            'filename' => basename($filename),
        ]); 
        
        /*
            $filename = $request->file->store('public/image');
            $omiyage = new \App\Omiyage;
            $omiyage->find($request->id);
            
            $omiyage->omiyage_name = $request->omiyage_name;
            $omiyage->shop_name = $request->shop_name;
            $omiyage->price = $request->price;
            $omiyage->quantity = $request->quantity;
            $omiyage->prefecture = $request->prefecture;
            $omiyage->description = $request->description;
            $omiyage->url = $request->url;
            $omiyage->filename = basename($filename);
            $omiyage->save();
            */
        } else {
            return redirect()->back()->withInput()->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
        }
        
        
        
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
