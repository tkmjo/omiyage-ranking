<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\User;
use App\Http\Omiyage;
use Intervention\Image\ImageManagerStatic as Image;

use Storage;

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
        if ($omiyage->description == null) {
            $omiyage->description = '記入されておりません。';
        }
        
        $omiyage->description = preg_replace("/\n|\r\n|\r/", "<br />", $omiyage->description);

        $data = [
            'omiyage' => $omiyage,  
        ];
        
        return view('omiyages.show', $data);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $this->validate($request, [
            'omiyage_name' => 'required|max:191', 
            'shop_name' => 'required|max:191', 
            'price' => 'numeric|nullable', 
            'quantity' => 'numeric|nullable',
            'prefecture' => 'required|max:191',
            'url' => 'max:191',
            'file' => [
                'required',
                'file',
                'max:5120',
            ]
        ]);
        
        
        $filename = null;
        if ($request->file('file')->isValid([])) {
            // $filename = $request->file->store('public/image');
            // $omiyage = new \App\Omiyage;
            // $omiyage->find($request->id);
            
            // $filename = $request->file->getClientOriginalName();
            $ext = $request->file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            
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
            
            
            // お土産一覧画面・お気に入り画面・ランキング画面に使用するサイズ
            $file = $request->file;
            $w = 360;
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
    // intervention imageを使用
    /*
    public function fitting($w, $h, $resize_dir, $file, $filename, $request) {
        list($original_w, $original_h, $type) = getimagesize($file);
        $original_image = Image::make($request->file);
        $resize_path = public_path('/storage/image/' . $resize_dir . basename($filename));
        
        if ($original_w <= $w && $original_h <= $h) {
            $original_image->save($resize_path);
        } else if ($original_w >= $w && $original_h >= $h) {
            
            // $original_image->crop(floor(($original_h*($w / $h))), $original_h, floor(($original_w-($original_h*($w / $h))) / 2), 0)->resize($w, $h)->save($resize_path);
            
            $original_image->fit($w, $h)->save($resize_path);
        }
    }
    */
    
    // s3を使用
    public function fitting($w, $h, $resize_dir, $file, $filename, $request) {
        list($original_w, $original_h, $type) = getimagesize($file);
        $original_image = Image::make($request->file);
        $resize_path = public_path('/storage/image/' . $resize_dir . basename($filename));
        
        if ($original_w <= $w && $original_h <= $h) {
            $original_image->save($resize_path);
            $contents = Storage::get('public/image/' . $resize_dir . $filename);
            Storage::disk('s3')->put($resize_path, $contents, 'public');
            
        } else if ($original_w >= $w && $original_h >= $h) {
            
            // $original_image->crop(floor(($original_h*($w / $h))), $original_h, floor(($original_w-($original_h*($w / $h))) / 2), 0)->resize($w, $h)->save($resize_path);
            
            $original_image->fit($w, $h)->save($resize_path);
            $contents = Storage::get('public/image/' . $resize_dir . $filename);
            Storage::disk('s3')->put($resize_path, $contents, 'public');
        }
    }
}
