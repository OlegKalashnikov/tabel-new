<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Timetable extends Model
{
    protected $guarded = [];

    /**
     * @param $my_employee_id
     * @param $department_id
     * @param $month
     * @return int
     */
    public static function quantity($my_employee_id, $department_id, $month){
        $user_id = Auth::user()->id;
        $date = Carbon::create(null,$month,01);
        $tmp = 0;
        $tmp_data = Timetable::where('user_id', $user_id)
                            ->where('department_id', $department_id)
                            ->where('my_employee_id', $my_employee_id)
                            ->where('date', '<=', $date->lastOfMonth()->format('Y-m-d'))
                            ->where('date', '>=', $date->firstOfMonth()->format('Y-m-d'))
                            ->get();
        foreach($tmp_data as $value){
            if(is_numeric($value->standard)){
                $tmp++;
            }
        }
        return $tmp;
    }

    /**
     * @param $my_employee_id
     * @param $department_id
     * @param $month
     * @return string
     */
    public static function worked_out($my_employee_id, $department_id, $month){
        $user_id = Auth::user()->id;
        $date = Carbon::create(null,$month,01);
        $tmp = 0;
        $tmp_data = Timetable::where('user_id', $user_id)
            ->where('department_id', $department_id)
            ->where('my_employee_id', $my_employee_id)
            ->where('date', '<=', $date->lastOfMonth()->format('Y-m-d'))
            ->where('date', '>=', $date->firstOfMonth()->format('Y-m-d'))
            ->get();
        foreach($tmp_data as $value){
            if(is_numeric($value->standard)){
                $tmp_time = $value->standard[0];
                if(isset($value->standard[1])){
                    $a = $value->standard[1];
                    $a .= $value->standard[2];
                    $tmp_worked_out = (($tmp_time*1)*60*60) + (($a*1)*60);
                }
                $tmp_worked_out = (($tmp_time*1)*60*60);
                $tmp += $tmp_worked_out;
            }
        }
        return sprintf('%02d:%02d', ($tmp / 3600), ($tmp / 60 % 60));
    }

    /**
     * @param $my_employee_id
     * @param $month
     * @param $td
     * @return int|string
     */
    public static function combination($my_employee_id, $month, $td){
        $user_id = Auth::user()->id;
        $date = Carbon::create(null,$month,01);
        $coundDay = Carbon::create(null, $month,01)->daysInMonth;
        $tmp = 0;
        $tmp_string = '';
        $tmp_data = Combination::where('user_id', $user_id)
                            ->where('my_employee_id', $my_employee_id)
                            ->where('start', '<=', $date->lastOfMonth()->format('Y-m-d'))
                            ->where('end', '>=', $date->firstOfMonth()->format('Y-m-d'))
                            ->get();

        foreach($tmp_data as $value){
            if($td == 1){
                $tmp += $value->percentages;
                $tmp_string = $tmp;
            }elseif($td == 2){
                $date = Carbon::create(null,$month,01);
                for($ptr = 1; $ptr <= $coundDay; $ptr++){
                    if($value->start <= $date->format('Y-m-d') && $value->end >= $date->format('Y-m-d')){
                        $tmp += 1;
                    }
                    $date->addDay();
                }
                $tmp_string = $tmp;
            }elseif($td == 3){
                $period = $value->start . ' - ' . $value->end . "\n";
                $tmp_string .= $period;
            }
        }
        return $tmp_string;
    }

    /**
     * @param $month
     * @param $day
     * @return bool
     */
    public static function ifWeekday($month, $day){
        $tmp_day = Carbon::create(null, $month, $day);
        if($tmp_day->isWeekend()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public static function duty($my_employee_id, $month, $type){
        $user_id = Auth::user()->id;
        $firstDay = Carbon::create(null,$month,01)->firstOfMonth()->format('Y-m-d');
        $lastDay = Carbon::create(null,$month,01)->lastOfMonth()->format('Y-m-d');
        $count = DutyRoster::where('user_id', $user_id)->where('my_employee_id', $my_employee_id)->whereBetween('date', [$firstDay, $lastDay])->where('type', $type)->get();
        $time = 0;
        foreach($count as $value){
            $time += $value->time*1;
        }
        if($time == 0){
            return '';
        }else{
            return $time;
        }

    }

}
