<?php 
namespace Chatty\Http\Controllers;

use Auth;
use Chatty\Models\User;
use Illuminate\Http\Request;
class FriendController extends Controller
{
	
	public function getIndex()
	{
		$friends = Auth::user()->friends();
		$request = Auth::user()->friendRequest();
		
		return view('friend.index')->with(
			[
				'friends'=>$friends,
				'request'=>$request
			]
		);
	}

	public function getAdd($username){
		/*
			Lấy thông tin người dùng trong bảng user thông qua $username
		*/
		$user = User::where(['username'=>$username])->first();

		/*
			Nếu người dùng không tồn tại thì trả về lỗi notfond
		*/
		if(!$user){
			return redirect()->route('home')
			->with('info','Không tìm thấy tài khoản này');
		}
		/*
			Nếu người dùng chính là tài khoản đang đăng nhập thì không  làm gì ả trả về trang chủ 
		*/

		if(Auth::user()->id === $user->id){
			return redirect()->route('home');
		}
		/*
			Nếu người dùng đang chờ kết bạn thì trả về thông báo 
		*/
		if (Auth::user()->hasFriendRequestPedding($user) || Auth::user()->hasFriendRequestPedding(Auth::user())) {
			
			return redirect()->route('profile.index',['username'=>$user->username])
			->with('info','Người này đã gửi yêu cầu kết bạn');
		}

		/*
			Nếu người dùng đlà baj rồi thì thông báo 
		*/

		if (Auth::user()->isFriendWith($user)) {
			return redirect()->route('profile.index',['username'=>$user->username])
			->with('info','Bạn và người này đã kết bạn');
		}

		/*
			Thực hiện gửi yêu cầu kết bạn
		*/

		Auth::user()->addFriend($user);

			return redirect()->route('profile.index',['username'=>$user->username])
			->with('info','Friend request sent');
		
	}

	public function getAccept($username){

		$user = User::where(['username'=>$username])->first();

		if(!$user){
			return redirect()->route('home')
			->with('info','Không có thông tin người dùng');
		}

		if (!Auth::user()->hasFriendRequestReceived($user)) {
			return redirect()->route('home');
		}

		Auth::user()->acceptFriend($user);
		return redirect()->route('profile.index',['username'=>$user->username])
			->with('info','Đã chấp nhận kết bạn với '.$user->username);
	}

	public function postDelete($username){

		$user = User::where(['username'=>$username])->first();

		if(!Auth::user()->isFriendWith($user)){
			return redirect()->back();
		}

		Auth::user()->deleteFriend($user);
		return redirect()->back()->with('info','Đã xóa kết nối');
	}
}
?>