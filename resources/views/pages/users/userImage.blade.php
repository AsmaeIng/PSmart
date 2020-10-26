public function storeImageUser(Request $request)
    {		
		$request->validate([
          'files' => 'required',
        ]);
		$offres = DB::table('offres')
			   ->select('offres.*')
			   ->get();
		 $id= $request->user_id;
		 foreach($offres as $image) {
		 if ($image->offre_id == $id)
		 {
			 $img = Image::where('user_id', '=', $image->user_id )->first();
			 $img->fill($request->all());
			
			if ($request->hasfile('files')) {
				$files = $request->file('files');
			
             foreach($files as $file) {
                 $name = $file->getClientOriginalName();				
                 $path = $file->storeAs('images/user', $name, 'public');				
				 $file= Storage::disk('uploads')->put($name, file_get_contents($file));				
				 $img->name = $name;
				 $notWorkingDays = 
				 $img->save();
            }
         }
       
         
		}
		else
			{
		 if ($request->hasfile('files')) {
            $files = $request->file('files');
			
            foreach($files as $file) {
                $name = $file->getClientOriginalName();				
                $path = $file->storeAs('images/user', $name, 'public');
				$file= Storage::disk('uploads')->put($name, file_get_contents($file));
				// $file->move(public_path($path), $name);
                Image::create([
                    'name' => $name,
					'offre_id' => $id,
                    'path' => $path
                  ]);
            }
         }
         
		 }
		 }

        return back()->with('success', 'Files uploaded successfully');
    }
}