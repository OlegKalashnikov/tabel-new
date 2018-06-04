<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DutyRoster extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function my_employee(){
        return $this->hasOne('App\MyEmployee', 'id', 'my_employee_id');
    }

    public static function showtype($type){
        switch($type){
            case '1': return 'Ночные';
            case '2': return 'Выходные';
            case '3': return 'Праздничные';
            case '4': return 'Охраники';
        }
    }
}
