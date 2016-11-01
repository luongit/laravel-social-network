<?php 
namespace Chatty\Http\Controllers;

use Auth;
use Chatty\models\Status;
class HomeController extends Controller
{
	
	public function index()
	{
		if (Auth::check()) {
			$statuses = Status::where(function($query){
				return $query->notReply()->where('user_id',Auth::user()->id)
				->orWhereIn('user_id',Auth::user()->friends()->pluck('id'));
			})->orderBy('created_at','desc')->paginate(10);
			return view('timeline.index')->with(
				[
					'statuses'=>$statuses,
				]
			);
		}
		return view('home');
	}


}
?>