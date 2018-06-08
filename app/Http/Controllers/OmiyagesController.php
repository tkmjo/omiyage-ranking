<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\User;
use App\Http\Omiyage;
use Intervention\Image\ImageManagerStatic as Image;

class OmiyagesController extends Controller
{
    public function index()
    {
        // $omiyages = \App\Omiyage::all()->paginate(15);
        $omiyages = \DB::table('omiyages')->orderby('created_at', 'desc')->paginate(15);
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
        
        $filename = null;
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
            
            /* intervention imageを使用 */
            // お土産一覧画面・お気に入り画面・ランキング画面に使用するサイズ
            $file = $request->file;
            $w = 358;
            $h = 350;
            $resize_dir = 'welcome-resized/';
            $this->fitting($w, $h, $resize_dir, $file, $filename, $request);
            
            // お土産詳細画面で使用するサイズ
            $w = 750;
            $h = 600;
            $resize_dir = 'show-resized/';
            $this->fitting($w, $h, $resize_dir, $file, $filename, $request);
            
            // ランキング画面で使用するサイズ
            $w = 315;
            $h = 250;
            $resize_dir = 'ranking-resized/';
            $this->fitting($w, $h, $resize_dir, $file, $filename, $request);
            
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
    
    // 画像のcropとresizeを行う(fit) 
    public function fitting($w, $h, $resize_dir, $file, $filename, $request) {
        list($original_w, $original_h, $type) = getimagesize($file);
        $original_image = Image::make($request->file);
        $resize_path = public_path('/storage/image/' . $resize_dir . basename($filename));
        
        if ($original_w <= $w && $original_h <= $h) {
            $original_image->save($resize_path);
        } else if ($original_w >= $w && $original_h >= $h) {
            /*
            $original_image->crop(floor(($original_h*($w / $h))), $original_h, floor(($original_w-($original_h*($w / $h))) / 2), 0)->resize($w, $h)->save($resize_path);
            */
            $original_image->fit($w, $h)->save($resize_path);
        }
    }
}
