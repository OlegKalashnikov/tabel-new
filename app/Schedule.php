<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Schedule extends Model
{
    protected $guarded = [];
    //public $timestamps = FALSE;

    /**
     * @param $department_id
     * @return mixed
     */
    public static function department_name($department_id){
        return Department::where('id', $department_id)->value('department');
    }

    /**
     * @param $month_id
     * @return string
     */
    public static function month($month_id){
        switch($month_id){
            case '1': return 'Январь';
            case '2': return 'Февраль';
            case '3': return 'Март';
            case '4': return 'Апрель';
            case '5': return 'Май';
            case '6': return 'Июнь';
            case '7': return 'Июль';
            case '8': return 'Август';
            case '9': return 'Сентябрь';
            case '10': return 'Октябрь';
            case '11': return 'Ноябрь';
            case '12': return 'Декабрь';
        }
    }

    /**
     * @param $my_employee_id
     * @return mixed
     */
    public static function schedule_my_employee($my_employee_id){
        $user_id = Auth::user()->id;
        $tmp_id = MyEmployee::where('user_id', $user_id)->where('id',$my_employee_id)->value('employee_id');
        return Employee::where('id', $tmp_id)->value('employee');
    }

    /**
     * @param $my_employee_id
     * @return mixed
     */
    public static function schedule_my_employee_position($my_employee_id){
        $user_id = Auth::user()->id;
        $tmp_id = MyEmployee::where('user_id', $user_id)->where('id',$my_employee_id)->value('position_id');
        return Position::where('id', $tmp_id)->value('position');
    }



}
