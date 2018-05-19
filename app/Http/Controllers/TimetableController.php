<?php

namespace App\Http\Controllers;

use App\Combination;
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
        $data_individuallies = DB::table('data_individuallies')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data_medicall_staffs = DB::table('data_medicall_staffs')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        $data_not_medicall_staffs = DB::table('data_not_medicall_staffs')->select('department_id', 'month')->where('user_id', $user_id)->groupBy('department_id', 'month')->get();
        return view('timetable.timetable', [
            'data_individuallies' => $data_individuallies,
            'data_medicall_staffs' => $data_medicall_staffs,
            'data_not_medicall_staffs' => $data_not_medicall_staffs,
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
}
