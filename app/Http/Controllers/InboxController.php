<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\inbox;
use App\inbox_attachment;
use App\File;
class InboxController extends Controller
{
    public function sendMail(Request $request){
        
        $from_user_id = Auth::user()->id;
        $email = $request->input('to_user_id');
        $user = User::select('id')->where('email',$email)->get();
        $to_user_id = $user[0]->id;
        $subject = $request->input('subject');
        // $message = $request->input('mess');

        $inbox = new inbox();
        $inbox->from_user_id = $from_user_id;
        $inbox->to_user_id = $to_user_id;
        $inbox->subject = $subject;
        $inbox->message = $request['idCreative'];
        $inbox->save();
		
		$id = $inbox->inbox_id;
		
		$request->validate([
          'file' => 'required',
        ]);
		
		 if ($request->hasfile('file')) {
            $files = $request->file('file');

            foreach($files as $file) {
                $name = $file->getClientOriginalName();				
                $path = $file->storeAs('/sendMails', $name, 'public');
				$file->move(public_path($path), $name);
				$attachment = new inbox_attachment();
				$attachment->title = $name;
				$attachment->inbox_id = $id;
				$attachment->path = $path;
				$attachment->save();
            }
         }

        return redirect('/sent');
    }
    public function getInboxMails(){

        $to_user_id = Auth::user()->id;

        $inbox = inbox::select('inboxes.*','inboxes.seen','users.username','users.lastname','users.path')
        ->where('to_user_id',$to_user_id)
        ->join('users','id','=','from_user_id')
        ->where('deletedTo',0)
        ->orderBy('created_at','desc')
        ->paginate(10);
        return $inbox;
    }

    public function getSentMails(){

        $from_user_id = Auth::user()->id;

        $inbox = inbox::select('inboxes.*','users.username','users.lastname','users.path')
        ->join('users','id','=','to_user_id')
        ->where('from_user_id',$from_user_id)
        ->where('deletedFrom',0)
        ->orderBy('created_at','DESC')
        ->paginate(10);
        
        return $inbox;
    }

    public function getDeletedMails(){

        $user_id = Auth::user()->id;

        $inbox=inbox::select('inboxes.*','users.username','users.lastname','users.path')
        ->join('users','id','=','from_user_id')
        ->where('to_user_id',$user_id)->where('deletedTo',1)
        ->orWhere('from_user_id',$user_id)->where('deletedFrom',1)
        ->orderBy('updated_at','DESC')
        ->paginate(10);
        
        return $inbox;
    } 
	public function getStarred(){

        $user_id = Auth::user()->id;

        $inbox=inbox::select('inboxes.*','users.username','users.lastname','users.path')
        ->join('users','id','=','to_user_id')
        ->where('from_user_id',$user_id)
		->where('starred',1)
        ->orderBy('updated_at','DESC')
        ->paginate(10);
        
        return $inbox;
    }
	public function getImportant(){

        $id = Auth::user()->id;

        $inbox=inbox::select('inboxes.*','users.username','users.lastname','users.path')
        ->join('users','id','=','to_user_id')
        ->where('from_user_id',$id)
		->where('important',1)
        ->orderBy('updated_at','DESC')
        ->paginate(10);
        
        return $inbox;
    }

    public function getInboxMailDetails($inbox_id){

        $inbox_details = inbox::select('inboxes.*','users.username','users.lastname','users.path','users.email')
        ->where('inbox_id',$inbox_id)
        ->join('users','id','=','from_user_id')
        ->get();
		
        return $inbox_details;
    }   
	public function getInboxMailAttachment($inbox_id){

		$inbox_attachment = inbox_attachment::select('inbox_attachments.title','inbox_attachments.path')
        ->where('inbox_id',$inbox_id)
        ->get();
        return $inbox_attachment;
    }

    public function getSentMailDetails($inbox_id){

        $inbox_details = inbox::select('inboxes.*','users.username','users.lastname','users.path','users.email')
        ->where('inbox_id',$inbox_id)
        ->join('users','id','=','to_user_id')
        ->get();

        return $inbox_details;

    }
    public function getDeletedMailDetails($inbox_id){

       $inbox_details = inbox::select('inboxes.*','users.username','users.lastname','users.path','users.email')
        ->where('inbox_id',$inbox_id)
        ->join('users','id','=','to_user_id')
        ->get();

        return $inbox_details;

    }


    public function deleteInboxMail($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->where('to_user_id',$user_id)->update([
            "deletedTo" => true,
        ]);
        return redirect('/app-email');
    }
	public function starredInboxMail($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->where('to_user_id',$user_id)->update([
            "starred" => true,
        ]);
        return redirect('/app-email');
    }
	public function importantInboxMail($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->where('to_user_id',$user_id)->update([
            "important" => true,
        ]);
        return redirect('/app-email');
    }

    public function deleteInboxMails(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->where('to_user_id',$to_user_id)->update([
                "deletedTo" => true,
            ]);
        }
        return redirect('/inbox');
    } 
	public function starredInboxMails(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->where('to_user_id',$to_user_id)->update([
                "starred" => true,
            ]);
        }
        return redirect('/app-email');
    }
	public function importantInboxMails(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->where('to_user_id',$to_user_id)->update([
                "important" => true,
            ]);
        }
        return redirect('/app-email');
    }  
	public function starredSentMails(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->where('to_user_id',$to_user_id)->update([
                "starred" => true,
            ]);
        }
        return redirect('/app-email');
    }
	public function importantSentMails(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->where('to_user_id',$to_user_id)->update([
                "important" => true,
            ]);
        }
        return redirect('/app-email');
    }

    public function deleteSentMail($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->where('from_user_id',$user_id)->update([
            "deletedFrom" => true,
        ]);
        return redirect('/sent');
    }
 public function starredSentMail($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->where('from_user_id',$user_id)->update([
            "starred" => true,
        ]);
        return redirect('/sent');
    }
	public function importantSentMail($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->where('from_user_id',$user_id)->update([
            "important" => true,
        ]);
        return redirect('/sent');
    }

    public function deleteSentMails(Request $request){

        $inbox= new inbox;
        $from_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->where('from_user_id',$from_user_id)->update([
                "deletedFrom" => true,
            ]);
        }
        return redirect('/sent');
    }


    public function deleteInboxMailPermanently($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->delete();
        return redirect('/app-email');
    }

    public function deleteInboxMailsPermanently(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->delete();
        }
        return redirect('/app-email');
    }   
	public function starredInboxMailPermanently($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->update(["starred" => false,]);
        return redirect('/app-email');
    }
	public function importantInboxMailPermanently($inbox_id){

        $inbox= new inbox;
        $user_id = Auth::user()->id;
        $inbox->where("inbox_id",$inbox_id)->update(["important" => false,]);
        return redirect('/app-email');
    }

    public function starredInboxMailsPermanently(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->update(["starred" => false,]);
        }
        return redirect('/app-email');
    }
 public function importantInboxMailsPermanently(Request $request){

        $inbox= new inbox;
        $to_user_id = Auth::user()->id;
        $inbox_id = $request -> input('inbox_ids');
        for($i = 0;$i<count($inbox_id);$i++){
            $inbox->where("inbox_id",$inbox_id[$i])->update(["important" => false,]);
        }
        return redirect('/app-email');
    }

    public function numberOfUnSeenMails(){

        $user_id = Auth::user()->id;
        $inbox = inbox::where('to_user_id',$user_id)->where('seen',false)->where('deletedTo',0)->count();

        return $inbox;
    }
	public function numberOfAttachments($inbox_id){

        $inbox = inbox_attachment::where('inbox_id',$inbox_id)->count();

        return $inbox;
    }






    
}
