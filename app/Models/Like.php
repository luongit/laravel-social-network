<?php 
namespace Chatty\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Like extends Model
{
	
	protected $table ='like';

	public function likeable(){
		return $this->morphTo();
	}
	
	public function user(){
		return $this->bolongsTo('Chatty\Models\User','user_id');
	}

}

?>