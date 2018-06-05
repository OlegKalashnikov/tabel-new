<?php

namespace App\Http\Controllers;

use App\Combination;
use App\DefaultType;
use App\Dismissal;
use App\DutyRoster;
use App\Holiday;
use App\MyEmployee;
use App\NoShows;
use App\Standard;
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
        $month = Carbon::now()->format('m');
        $departmentTimetable = DB::table('timetables')->groupBy('department_id', 'month')->where('user_id', $user_id)->get();
        $data = array();
        foreach($departmentTimetable as $value){
            $data[$value->department_id][] = $value->month;
        }
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
        //dd($tmp_data);
        foreach($tmp_data as $value){
            $data_schedules[$value->my_employee_id][$value->date][] = $value->standard;
        }
        //dd($data_schedules);
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
        $firstDay = Carbon::create(null, $month, 01)->firstOfMonth()->format('Y-m-d');// первый день
        $endDay = Carbon::create(null, $month, 01)->lastOfMonth()->format('Y-m-d'); //последний день
        $countDay= $date->daysInMonth;//кол-во дней в месяце
        $monthSQL = mb_strtolower(Carbon::create(null, $month, 01)->format('M'));// название месяца для запроса к БД по выборке нормы
        $user_id = Auth::user()->id;//id табельщика
        $myEmployees = MyEmployee::where('user_id', $user_id)->where('show', 1)->get(); //все активные сотрудники у табельщика
        $timetables = Timetable::where('user_id', $user_id)->where('month', $month)->get(); //есть ли заполненые данные в месяце за который формируем табель
        $holidays = Holiday::where('date', '>=', $firstDay)->where('date', '<=', $endDay)->orderBy('type', 'asc')->get(); //праздничные и предпраздничные дни
        $narrowSpecialistsId = [17, 18, 48, 15, 30, 14, 27, 215, 31, 38, 39, ]; //список должностей узких специалистов
        $lastSaturday = new Carbon('last saturday of '. $date); //последняя суббота месяца
        if($timetables->isEmpty()){//если данных в табеле за текущий месяц нет
            foreach($myEmployees as $myEmployee){//проходим по всем сотрудникам
                $date_for = Carbon::create(null, $month, 01);//месяц за который формируем табель
                $standard = explode('(', Standard::where('category_id', $myEmployee->category_id)->where('rate', $myEmployee->rate)->value($monthSQL));// формируем стандарт для сотрудника в текущем месяце
                if(isset($standard[1])){//если есть сокращенный день или нужно выработать до нормы
                    $holiday_standard = explode(')', $standard[1]);
                }
                for($ptr = 1; $ptr <= $countDay; $ptr++){//обходим месяц
                    $store = new Timetable();//создаем объект
                    $store->user_id = $user_id; //табельщик
                    $store->department_id = $myEmployee->department_id; //подразделение
                    $store->my_employee_id = $myEmployee->id; //сотрудник
                    $store->month = $month; //месяц
                    if($myEmployee->category_id == 10 || $myEmployee->category_id == 11){ //6 дневная рабочая неделя
                        if(!$date_for->isSunday()){ //если не воскресенье
                            $store->date = $date_for->format('Y-m-d');
                            $store->standard = $standard[0];
                        }else{ // воскресенье
                            $store->date = $date_for->format('Y-m-d');
                            $store->standard = 'В';
                        }
                        if($holidays->isNotEmpty()){//если есть праздники и сокращенные дни
                            foreach($holidays as $holiday){
                                if($holiday->type == 1 && $holiday->date == $date_for->format('Y-m-d') && $holiday->sixday){//предпраздничный
                                    $store->date = $date_for->format('Y-m-d');
                                    $store->standard = $holiday_standard[0];
                                }elseif($holiday->type == 2 && $holiday->date == $date_for->format('Y-m-d') && $holiday->sixday){ //праздник
                                    $store->date = $date_for->format('Y-m-d');
                                    $store->standard = 'П';
                                }
                            }
                        }
                        $store->save(); //сохраняем
                    }else{//5 дневная рабочая неделя
                        if(!$date_for->isWeekend()){//если не выходные
                            $store->date = $date_for->format('Y-m-d');
                            $store->standard = $standard[0];
                        }else{//если выходные
                            $store->date = $date_for->format('Y-m-d');
                            $store->standard = 'В';
                        }
                        if($holidays->isNotEmpty()){//если есть праздники и сокращенные дни
                            foreach($holidays as $holiday){
                                if($holiday->type == 1 && $holiday->date == $date_for->format('Y-m-d')){//предпраздничный
                                    $store->date = $date_for->format('Y-m-d');
                                    $store->standard = $holiday_standard[0];
                                }elseif($holiday->type == 2 && $holiday->date == $date_for->format('Y-m-d')){ //праздник
                                    $store->date = $date_for->format('Y-m-d');
                                    $store->standard = 'П';
                                }
                            }
                        }
                        $store->save();
                    }
                    $date_for->addDay();
                }
                /*последняя суббота для узких специалистов*/
                if(array_search($myEmployee->position_id, $narrowSpecialistsId)){
//                    dump($lastSaturday->format('Y-m-d'));
//                    dump($user_id);
//                    dump($myEmployee->id);
                    $employeeTimetable = Timetable::where('user_id', $user_id)->where('my_employee_id', $myEmployee->id)->where('date', $lastSaturday->format('Y-m-d'))->get();
//                    dump($employeeTimetable);
                    if($holidays->isEmpty()){
                        $employeeTimetable[0]->standard = $holiday_standard[0];
                    }else{
                        $employeeTimetable[0]->standard = $standard[0];
                    }
                    $employeeTimetable[0]->save();
                }
                $noShows = NoShows::where('user_id', $user_id)->where('start', '<=', $endDay)->where('end', '>=', $firstDay)->where('my_employee_id', $myEmployee->id)->orderBy('default_type_id', 'decs')->get();//неявки
                if($noShows->isNotEmpty()){//если у текущего сотрудника есть неявки в этом месяце
                    foreach($noShows as $noShow){
                        $updateNoShowsTimetables = Timetable::where('user_id', $user_id)->where('my_employee_id', $noShow->my_employee_id)->where('date', '>=', $noShow->start)->where('date', '<=', $noShow->end)->get();//записи в табеле за период неявки
                        foreach($updateNoShowsTimetables as $store){
                            $store->standard = $noShow->defaulttype->reduction;
                            $store->save();
                        }
                    }
                }
                $dutyRosters = DutyRoster::where('user_id', $user_id)->where('date', '>=', $firstDay)->where('date', '<=', $endDay)->where('my_employee_id', $myEmployee->id)->get();
                if($dutyRosters->isNotEmpty()){
                    foreach($dutyRosters as $dutyRoster){
                        $updateDutyTimetables = Timetable::where('user_id', $user_id)->where('my_employee_id', $dutyRoster->my_employee_id)->where('date', $dutyRoster->date)->get();
                        foreach($updateDutyTimetables as $store){
                            $store->standard = $dutyRoster->time;
                            $store->save();
                        }
                    }
                }
                $dismissals = Dismissal::where('user_id', $user_id)->where('my_employee_id', $myEmployee->id)->where('date', '>=', $firstDay)->where('date', '<=', $endDay)->get(); //если сотрудник уволен
                if($dismissals->isNotEmpty()){//если существует запись
                    foreach($dismissals as $dismissal){
                        $updateDismissalsTimetables = Timetable::where('user_id', $user_id)->where('my_employee_id', $noShow->my_employee_id)->where('date', '>=', $dismissal->date)->get();
                        foreach($updateDismissalsTimetables as $store){
                            $store->standard = 'Уволен';
                            $store->save();
                        }
                        $myEmployee->show = 0;//убираем со списка активный сотрудников текущего табьельщика
                        $myEmployee->save();
                    }
                }
            }
        }else{
            dump('NotEmpty');
        }
        //return redirect()->route('timetable');
    }
}
