<?php 
namespace Chatty\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Chatty\Models\User;	

class AuthController extends Controller{

	/*
		create signup user infomation
		getSignup to display form input info
		postSignup to insert data to database
	*/
	public function getSignup(){
		return view('auth.signup');
	}

	public function postSignup(Request $request){
		$this->validate($request,[
			'email' => 'required|unique:user|email|max:255',
			'username' => 'required|unique:user|alpha_dash|max:25',
			'password' => 'required|min:6'	
		]);

		User::create([
			'username'=> $request->input('username'),
			'email'=> $request->input('email'),
			'password'=> bcrypt($request->input('password')),
			'created_at'=> bcrypt($request->input('password')),
			'created_at'=> time(),
			'updated_at'=> time()
		]);

		return redirect()->route('home')->with('info','Your account has been created an you can now sigin ! ');
	}

	/*
		create signin user infomation
	*/
	public function getSignin(){
		return view('auth.signin');
	}

	public function postSignin(Request $request){

		$this->validate($request,[
			'username' => 'required',
			'password' => 'required'	
		]);

		if(!Auth::attempt($request->only(['username','password']),$request->has('remember'))){
			return redirect()->back()->with('info','Could not sign you in with those details');
		}
		return redirect()->route('home')->with('info','Your account has been created an you can now sigin ! ');
	}

	public function getSignout(){
		Auth::logout();
		return redirect()->route('home');
	}

}

?>