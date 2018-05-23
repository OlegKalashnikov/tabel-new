<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showList(){
        $user_id = Auth::user()->id;
        $data_individuallies = DB::table('data_individuallies')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data_medicall_staffs = DB::table('data_medicall_staffs')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data_not_medicall_staffs = DB::table('data_not_medicall_staffs')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data = [];
        if(isset($data_individuallies[0]->department_id)){
            foreach($data_individuallies as $value){
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
        return view('schedule.schedule', [
            'data' => $data,
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
        $tmp_data = Schedule::where('user_id', $user_id)->where('department_id', $department_id)->whereBetween('date',[$date->firstOfMonth()->format('Y-m-d'), $date->lastOfMonth()->format('Y-m-d') ])->get();
        foreach($tmp_data as $value){
            $data_schedules[$value->my_employee_id][$value->date][] = $value->start_day;
            $data_schedules[$value->my_employee_id][$value->date][] = $value->end_day;
            $data_schedules[$value->my_employee_id][$value->date][] = $value->clock_rate;
            $data_schedules[$value->my_employee_id][$value->date][] = $value->number_of_hours;
        }
        return view('schedule.show', [
            'data_schedules' => $data_schedules,
            'department_id' => $department_id,
            'count_day' => $coundDay,
            'first_day' => Carbon::create(null, $month)->format('Y-m-d'),
            'month' => $month,
        ]);
    }

    public function ajax(Request $request){
        $user_id = Auth::user()->id;
        $ajax = Schedule::where('user_id', $user_id)->where('my_employee_id', $request->my_employee_id)->where('date', $request->date)->get();

        if($request->field == 'start_day'){
            foreach($ajax as $update){
                $update->update([
                    'start_day' => $request->value,
                ]);
            }
        }elseif($request->field == 'end_day'){
            foreach($ajax as $update){
                $update->update([
                    'start_day' => $request->value,
                ]);
            }
        }
    }

}
