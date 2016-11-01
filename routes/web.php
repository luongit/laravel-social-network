<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
	* Home url
*/
Route::get('/', [
	'uses' =>'\Chatty\Http\Controllers\HomeController@index',
	'as'=>'home',

]);

/*
	* Authemtication
	* form Signup
*/
	
Route::get('/signup', [
	'uses' =>'\Chatty\Http\Controllers\AuthController@getSignup',
	'as'=>'auth.signup',
	'middleware'=>['guest'],
]);
	
Route::post('/signup', [
	'uses' =>'\Chatty\Http\Controllers\AuthController@postSignup',
	'middleware'=>['guest'],
]);
/*
	* Authentication
	* Form signin
*/
Route::get('/signin', [
	'uses' =>'\Chatty\Http\Controllers\AuthController@getSignin',
	'as'=>'auth.signin',
	'middleware'=>['guest'],
]);

/*
	* Form đăng nhập hệ thống
*/

Route::post('/signin', [
	'uses' =>'\Chatty\Http\Controllers\AuthController@postSignin',
	'middleware'=>['guest'],
]);
/*
	* thực hiện thoát khỏi hệ thống
*/

Route::get('/signout', [
	'uses' =>'\Chatty\Http\Controllers\AuthController@getSignout',
	'as'=>'auth.signout',
]);

/*
	* Kết quả tìm kiếm friends
*/

Route::get('/search',[
	'uses' =>'\Chatty\Http\Controllers\SearchController@getResults',
	'as'=>'search.results',
]);

/*
	* Trang timeline của cá nhân khi đăng nhập
*/

Route::get('/user/{username}',[
	'uses' =>'\Chatty\Http\Controllers\ProfileController@getProfile',
	'as'=>'profile.index',
	'middleware'=> ['auth'],
]);

/*
	* hiển thị thông tin cá nhân đê chỉnh sửa
*/

Route::get('/profile/edit',[
	'uses' =>'\Chatty\Http\Controllers\ProfileController@getEdit',
	'as'=>'profile.edit',
	'middleware'=> ['auth'],
]);
/*
	* Thực hiện chỉnh sửa thông tin cá nhân
*/

Route::post('/profile/edit',[
	'uses' =>'\Chatty\Http\Controllers\ProfileController@postEdit',
	'middleware'=> ['auth'],
]);

/*
	* Thông tin các thành viên đã add và chấp nhận kết bạn
*/

Route::get('/friend',[
	'uses' =>'\Chatty\Http\Controllers\FriendController@getindex',
	'as'=>'friend.index',
	'middleware'=> ['auth'],
]);
/*
	Gửi một yêu cầu kết bạn
*/
Route::get('/friend/add/{username}',[
	'uses' =>'\Chatty\Http\Controllers\FriendController@getAdd',
	'as'=>'friend.add',
	'middleware'=> ['auth'],
]);

/*
	Chấp nhận yêu cầu kết bạn
*/
Route::get('/friend/accept/{username}',[
	'uses' =>'\Chatty\Http\Controllers\FriendController@getAccept',
	'as'=>'friend.accept',
	'middleware'=> ['auth'],
]);

/*
	* xóa kết bạn
*/

Route::post('/friend/delete/{username}',[
	'uses' =>'\Chatty\Http\Controllers\FriendController@postDelete',
	'as'=>'friend.delete',
	'middleware'=> ['auth'],
]);

/*
	* Thêm comment status cho thành viên
*/
Route::post('/status',[
	'uses' =>'\Chatty\Http\Controllers\StatusController@postStatus',
	'as'=>'status.post',
	'middleware'=> ['auth'],
]);

/*
	* Form trả lời các comment
*/
Route::post('/status/{stautsid}/reply',[
	'uses' =>'\Chatty\Http\Controllers\StatusController@postReply',
	'as'=>'status.reply',
	'middleware'=> ['auth'],
]);

/*
	* Thực hiện hành động like
*/

Route::get('/status/{stautsid}/like',[
	'uses' =>'\Chatty\Http\Controllers\StatusController@getLike',
	'as'=>'status.like',
	'middleware'=> ['auth'],
]);

