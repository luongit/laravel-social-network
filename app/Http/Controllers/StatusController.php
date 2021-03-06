<?php 
namespace Chatty\Http\Controllers;

use Auth;
use Chatty\Models\Status;
use Chatty\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
	
	public function postStatus(Request $request)
	{
		$this->validate($request,[
			'status' => 'required|max:1000'
		]);

		Auth::user()->statuses()->create([
			'body'=>$request->input('status')
		]);

		return redirect()->route('home')->with('info','Status posted');
	}

	public function postReply(Request $request,$statusId){

		$this->validate($request,[
			"reply-{$statusId}" => 'required|max:1000'
		],[
			'required'=> 'Nội dung comment không được để trống'
		]);

		$status = Status::notReply()->find($statusId);

		if(!$status){
			return redirect()->route('home');
		}

 		if(!Auth::user()->isFriendWith($status->user) && Auth::user()->id !== $status->user->id){
 			return redirect()->route('home');
 		}

 		$reply = $status::create([
 			'body' => $request->input("reply-{$statusId}"),
 			'user_id' =>Auth::user()->id
 		])->user()->associate(Auth::user());

 		$status->replies()->save($reply);

 		return redirect()->back();
 	}


 	public function getLike($statusid){
 		$status = Status::find($statusid);
 		if(!$status){
 			return redirect()->route('home');
 		}

 		if(!Auth::user()->isFriendWith($status->user)){
 			// return redirect()->route('home');
 			return redirect()->back();
 		}
 		if(Auth::user()->hasLikedStatus($status)){
 			// return redirect()->back();
 			// dd('aaaa');
 			return redirect()->back();
 		}

 		$like = $status->likes()->create([]);
 		Auth::user()->likes()->save($like);
 		return redirect()->back();
 		
 	}
}
?>