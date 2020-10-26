<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\File;
use App\Image;
use DB;
use App\Offres;
use App\Users;
use App\User;
use App\Logonetworks ;
class FileController extends Controller
{
    public function index()
    {
	$logonetworks = DB::table('logonetworks')
			   ->select('logonetworks.*')
			   ->get();
	$networks = DB::table('networks')
			   ->select('networks.*')
			   ->get();
			   // 'logonetworks',
      return view('pages.offres.files',compact('networks'));
    }

    public function store(Request $request)
    {		
		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
		
		 $id= $request->network_id;
			$image = new Logonetworks;			
			$file = $request->file('image');
          
                $name = time().'.'.$request->image->extension(); 
				
                $path = $file->storeAs('images/networks', $name, 'public');
				// $file= Storage::disk('images/networks')->put($name, file_get_contents($file));
				$file->move(public_path($path), $name);
				$image->name = $name;
				$image->path = $path;
				$image->network_id = $id;
				$image->save();
            
                  
        return back()->with('success', 'Files uploaded successfully');
    }

    
	
}
