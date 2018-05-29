<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyEmployee extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(){
        return $this->hasOne('App\Employee', 'id', 'employee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department(){
        return $this->hasOne('App\Department', 'id', 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function position(){
        return $this->hasOne('App\Position', 'id', 'position_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public static function timeForBettingAtEight($time, $rate){
        $functionTime = explode(':', $time);
        if($rate == 1){//норма 8 часов
            $temp[0] = $functionTime[0] * 60 * 60; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1]));
        }elseif($rate == 0.75){
            $temp[0] = $functionTime[0] * 60 * 60 - 7200; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1]));
        }elseif($rate == 0.5){
            $temp[0] = $functionTime[0] * 60 * 60 - 14400; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1]));
        }elseif($rate == 0.25){
            $temp[0] = $functionTime[0] * 60 * 60 - 21600; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1]));
        }
    }

    public static function timeHolidays($time, $rate){
        $functionTime = explode(':', $time);
        if($rate == 1){//норма 8 часов
            $temp[0] = $functionTime[0] * 60 * 60; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1] - 3600));
        }elseif($rate == 0.75){
            $temp[0] = $functionTime[0] * 60 * 60; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1] - 900));
        }elseif($rate == 0.5){
            $temp[0] = $functionTime[0] * 60 * 60; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1] - 1800));
        }elseif($rate == 0.25){
            $temp[0] = $functionTime[0] * 60 * 60; //часы
            $temp[1] = $functionTime[1] * 60; //минуты
            return date("H:i", mktime(0,0,$temp[0]+$temp[1] - 2700));
        }
    }

    public static function standard(MyEmployee $myEmployee, $month){
        $tmp = Standard::where('category_id', $myEmployee->category_id)->where('rate', $myEmployee->rate)->where('name', 'like', 'Продол%')->value('may');
        //dd($tmp);
        return $tmp;
    }

}
