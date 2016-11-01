<?php 
namespace Chatty\Http\Controllers;

use Auth;
use Chatty\Models\User;
use Illuminate\Http\Request;
class ProfileController extends Controller
{
	
	public function getProfile($username)
	{
		$user = User::where(['username'=>$username])->first();
		$statuses = $user->statuses()->notReply()->orderBy('created_at','desc')->paginate(10);
		if(!$user){
			abort('404');
		}
		return view('profile.index')
		->with([
			'item'=>$user,
			'statuses'=>$statuses,
			'authUserIsFriend' => Auth::user()->isFriendWith($user)
		]);
	}

	public function getEdit(){
		return view('profile.edit');
	}

	public function postEdit(Request $request){
		$this->validate($request,[
			'first_name' => 'max:50',
			'last_name' => 'max:50',
			'location' => 'max:150'
		]);

		Auth::user()->update([
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'location' => $request->input('location')
		]);

		return redirect()->route('profile.edit')->with('info','Your profile updated');
	}
}
?>