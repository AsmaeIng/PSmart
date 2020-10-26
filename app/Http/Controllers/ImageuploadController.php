<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Users;
use App\User;  
class ImageuploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function image_upload()
    {
        return view('pages.image');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_post_image(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
	
        $imageName = time().'.'.$request->image->extension();  
		
        $request->image->move(public_path('images/user'), $imageName);
		
        return back()->with('success','You have successfully upload image.');
	}
}