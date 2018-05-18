<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'password', 'status', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param User $user
     * @return string
     */
    public static function initials(User $user){
        $tmp = explode(' ', $user->name);
        if(count($tmp) == 3){
            return $tmp[0]. " " .iconv_substr($tmp[1],0,1,'UTF-8').iconv_substr($tmp[2],0,1,'UTF-8');
        }elseif(count($tmp) == 2){
            return $tmp[0]. " " .iconv_substr($tmp[1],0,1,'UTF-8');
        }elseif(count($tmp) == 1){
            return $tmp[0];
        }
    }

    public function role(){
        return $this->hasOne('App\Role', 'id', 'role_id');
    }
}
