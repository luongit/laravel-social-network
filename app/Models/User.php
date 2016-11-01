<?php
namespace Chatty\Models;
// use Illuminate\Notifications\Notifiable;
use Chatty\Models\Status;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'user';

    protected $fillable = [
        'username', 
        'email', 
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function getName(){
        if($this->first_name && $this->last_name){
            return $this->first_name.' '.$this->last_name;
        }
        if($this->first_name ){
            return $this->first_name;
        }

        return null;
    }

    public function likes(){
        return $this->hasMany('Chatty\models\Like','user_id');
    }

    public function getNameOrUsername(){
        return $this->getName() ? : $this->username;
    } 
    public function getFirstNameOrUsername(){
        return $this->first_name ? : $this->username;
    }

    public function getAvatarUrl($size=40){
         echo '<img src="https://www.gravatar.com/avatar/'.md5($this->email).'?s='.$size.'&d=mm" alt="'.$this->getNameOrUsername().'" />';
    }
    public function statuses(){
        return $this->hasMany('Chatty\Models\Status','user_id');
    }
    public function friendOfMine(){
        return $this->belongsToMany('Chatty\models\User','friend','user_id','friend_id');
    }
    public function friendOf(){
        return $this->belongsToMany('Chatty\models\User','friend','friend_id','user_id');
    } 
    public function friends(){
        return $this->friendOfMine()->wherePivot('accepted',true)->get()->merge($this->friendOf()->wherePivot('accepted',true)->get());
    }
    public function friendRequest(){
        return $this->friendOfMine()->wherePivot('accepted',false)->get();
    }

    public function friendRequestPedding(){
        return $this->friendOf()->wherePivot('accepted',false)->get();
    } 
    public function hasFriendRequestPedding(User $user){
        return (bool) $this->friendRequestPedding()->where('id',$user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequest()->where('id',$user->id)->count();
    }

    public function addFriend(User $user){
        $this->friendOf()->attach($user->id);
    } 
    public function deleteFriend(User $user){
        $this->friendOf()->detach($user->id);
        $this->friendOfMine()->detach($user->id);
    } 
    
    public function acceptFriend(User $user){
        $this->friendRequest()->where('id',$user->id)->first()->pivot->update(['accepted'=>true]);
    } 

    public function isFriendWith(User $user){
        return (bool) $this->friends()->where('id',$user->id)->count();
    }

    public function hasLikedStatus(Status $status){
        return (bool) $status->likes->where('user_id',$this->id)->count();
    }
}
