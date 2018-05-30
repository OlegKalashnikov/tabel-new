<?php

namespace App\Http\Controllers;

use App\Combination;
use App\MyEmployee;
use App\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showList(){
        $user_id = Auth::user()->id;
        //$data = Timetable::where('user_id', $user_id)->get()->groupBy('department_id');
        $data_individuallies = DB::table('data_individuallies')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data_medicall_staffs = DB::table('data_medicall_staffs')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data_not_medicall_staffs = DB::table('data_not_medicall_staffs')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data = [];
        $month = Carbon::now()->format('m');
        if(isset($data_individuallies[0]->department_id)){
            foreach($data_individuallies as $key => $value){
                $data[$value->department_id] = $value->month;
            }
        }
        if(isset($data_medicall_staffs[0]->department_id)){
            foreach($data_medicall_staffs as $value){
                $data[$value->department_id] = $value->month;
            }
        }
        if(isset($data_not_medicall_staffs[0]->department_id)){
            foreach($data_not_medicall_staffs as $value){
                $data[$value->department_id] = $value->month;
            }
        }
//        вв()
//        foreach($data as $key => $values){
//            foreach($values as $j => $value){
//                $tmp = $value;
//                if($values[$j] != $tmp){
//                    echo $key . ' - ' . $value . ' - '. $j .'<br>';
//                }
//
//            }
//        }
        //dd($data);
        return view('timetable.timetable', [
            'data' => $data,
            'month' => $month,
        ]);
    }

    /**
     * @param $department_id
     * @param $month
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($department_id, $month){
        $user_id = Auth::user()->id;
        $date = Carbon::create(null, $month);
        $coundDay = Carbon::create(null, $month)->daysInMonth;
        $tmp_data = Timetable::where('user_id', $user_id)->where('department_id', $department_id)->whereBetween('date',[$date->firstOfMonth()->format('Y-m-d'), $date->lastOfMonth()->format('Y-m-d') ])->get();
        foreach($tmp_data as $value){
            $data_schedules[$value->my_employee_id][$value->date][] = $value->number_of_days;
            $data_schedules[$value->my_employee_id][$value->date][] = $value->number_of_hours;
        }
        return view('timetable.show', [
            'data_schedules' => $data_schedules,
            'department_id' => $department_id,
            'count_day' => $coundDay,
            'first_day' => Carbon::create(null, $month)->format('Y-m-d'),
            'month' => $month,
        ]);
    }

    /**
     * @param Request $request
     */
    public function ajax(Request $request){
        $user_id = Auth::user()->id;
        $ajax = Timetable::where('user_id', $user_id)->where('my_employee_id', $request->my_employee_id)->where('date', $request->date)->get();
        if($request->field == 'number_of_hours'){
            foreach($ajax as $update){
                $update->update([
                    'number_of_hours' => $request->value,
                ]);
            }
        }
    }
    
    
    public function storeTimetable($month){
        $date = Carbon::create(null, $month, 01); //месяц за который формируем табель
        $firstDay = Carbon::create(null, $month, 01)->firstOfMonth()->format('Y-m-d');
        $endDay = Carbon::create(null, $month, 01)->lastOfMonth()->format('Y-m-d');
        $countDay= $date->daysInMonth;
        $monthSQL = mb_strtolower(Carbon::create(null, $month, 01)->format('M'));
        dump($date);
        dump($firstDay);
        dump($endDay);
        dump($countDay);
        dump($monthSQL);
        $user_id = Auth::user()->id;//id табельщика
        $myEmployees = MyEmployee::where('user_id', $user_id)->where('show', 1)->get(); //все активные сотрудники у табельщика
        $timetables = Timetable::where('user_id', $user_id)->get();
        dump($myEmployees);
        foreach($myEmployees as $myEmployee){
            //заполняем весь месяц
//            $number_of_hours =
            for($ptr = 1; $ptr <= $countDay; $ptr++){
                $timetable = new Timetable();
                $timetable->user_id = $user_id;
                $timetable->department_id = $myEmployee->department_id;
                $timetable->my_employee_id = $myEmployee->my_employee_id;
                if(!$date->isWeekend()){
                    $timetable->date = $date->format('Y-m-d');
                    //$ti
                }
            }
        }
    }
}
