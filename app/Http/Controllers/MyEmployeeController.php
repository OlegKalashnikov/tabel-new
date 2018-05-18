<?php

namespace App\Http\Controllers;

use App\Combination;
use App\DataIndividually;
use App\DataMedicallStaff;
use App\DataNotMedicallStaff;
use App\DefaultType;
use App\Department;
use App\Dismissal;
use App\Employee;
use App\Holiday;
use App\MyEmployee;
use App\NoShows;
use App\Position;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyEmployeeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        $user_id = Auth::user()->id;
        $myEmployees = MyEmployee::where('user_id', $user_id)->get();
        return view('my_employees.my_employee', [
            'myEmployees' => $myEmployees,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        $selectPositions = Position::all();
        $selectDepartments = Department::all();
        $selectEmployees = Employee::all();
        $user_id = Auth::user()->id;
        return view('my_employees.create', [
            'selectEmployees' => $selectEmployees,
            'selectDepartments' => $selectDepartments,
            'selectPositions' => $selectPositions,
            'myEmployees' => MyEmployee::where('user_id', $user_id)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request){
        request()->validate([
            'employee_id' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'rate' => 'required',
        ]);
        $user_id = Auth::user()->id;
        MyEmployee::create([
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'rate' => $request->rate,
            'user_id' => $user_id,
        ]);

        return view('my_employees.create', [
            'myEmployees' => MyEmployee::where('user_id', $user_id)->get(),
            'selectEmployees' => Employee::all(),
            'selectDepartments' => Department::all(),
            'selectPositions' => Position::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createFormMedicallStaf(){
        $user_id = Auth::user()->id;
        return view('my_employees.data_medical_staff', [
            'selectDepartments' => Department::all(),
            'myEmployees' => MyEmployee::where('user_id', $user_id)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMedicallStaf(Request $request){
        request()->validate([
            'department_id' => 'required',
            'month' => 'required',
            'my_employee_id' => 'required',
            'clock_rate' => 'required',
            'start_day' => 'required',
            'end_day' => 'required',
            'number_of_hours' => 'required',
            'number_of_days' => 'required',
        ]);

        $user_id = Auth::user()->id;

        foreach($request->my_employee_id as $insert){
            //dump(MyEmployee::where('id', $insert)->value('rate'));
            if(!isset($request->date_weekday)){
                DataMedicallStaff::create([
                    'department_id' =>  $request->department_id,
                    'month' => $request->month,
                    'my_employee_id' => $insert,
                    'clock_rate' => $request->clock_rate,
                    'start_day' => $request->start_day,
                    'end_day' =>  MyEmployee::timeForBettingAtEight($request->end_day, MyEmployee::where('id', $insert)->value('rate')),
                    'number_of_hours' => MyEmployee::timeForBettingAtEight($request->number_of_hours, MyEmployee::where('id', $insert)->value('rate')),
                    'number_of_days' => $request->number_of_days,
                    'user_id' => $user_id,
                ]);
            }else{
                DataMedicallStaff::create([
                    'department_id' =>  $request->department_id,
                    'month' => $request->month,
                    'my_employee_id' => $insert,
                    'clock_rate' => $request->clock_rate,
                    'start_day' => $request->start_day,
                    'end_day' => MyEmployee::timeForBettingAtEight($request->end_day, MyEmployee::where('id', $insert)->value('rate')),
                    'number_of_hours' => MyEmployee::timeForBettingAtEight($request->number_of_hours, MyEmployee::where('id', $insert)->value('rate')),
                    'number_of_days' => $request->number_of_days,
                    'user_id' => $user_id,
                    'date_weekday' => $request->date_weekday,
                    'start_day_weekday' => $request->start_day_weekday,
                    'end_day_weekday' => $request->end_day_weekday,
                ]);
            }
        }
        return redirect()->route('my.employee');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createFormNotMedicallStaf(){
        $user_id = Auth::user()->id;
        return view('my_employees.data_not_medical_staff', [
            'selectDepartments' => Department::all(),
            'myEmployees' => MyEmployee::where('user_id', $user_id)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNotMedicallStaf(Request $request){
        request()->validate([
            'department_id' => 'required',
            'month' => 'required',
            'my_employee_id' => 'required',
            'clock_rate' => 'required',
            'start_day' => 'required',
            'end_day' => 'required',
            'number_of_hours' => 'required',
            'number_of_days' => 'required',
        ]);

        $user_id = Auth::user()->id;

        foreach($request->my_employee_id as $insert){
            DataNotMedicallStaff::create([
                'department_id' =>  $request->department_id,
                'month' => $request->month,
                'my_employee_id' => $insert,
                'clock_rate' => $request->clock_rate,
                'start_day' => $request->start_day,
                'end_day' => MyEmployee::timeForBettingAtEight($request->end_day, MyEmployee::where('id', $insert)->value('rate')),
                'number_of_hours' => MyEmployee::timeForBettingAtEight($request->number_of_hours, MyEmployee::where('id', $insert)->value('rate')),
                'number_of_days' => $request->number_of_days,
                'user_id' => $user_id,
            ]);
        }
        return redirect()->route('my.employee');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createFormIndividually(){
        $user_id = Auth::user()->id;
        return view('my_employees.data_individually', [
            'selectDepartments' => Department::all(),
            'myEmployees' => MyEmployee::where('user_id', $user_id)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeIndividually(Request $request){
        request()->validate([
            'department_id' => 'required',
            'month' => 'required',
            'my_employee_id' => 'required',
            'clock_rate' => 'required',
            'start_day' => 'required',
            'end_day' => 'required',
            'number_of_hours' => 'required',
            'date' => 'required',
        ]);

        $tmp = []; //временный массив для дат
        $user_id = Auth::user()->id;
        foreach($request->date as $item => $date){
            $tmp = explode(',', $date);
            foreach($tmp as $insert_date){
                DataIndividually::create([
                    'user_id'           => $user_id,
                    'department_id'     => $request->department_id,
                    'month'             => $request->month,
                    'my_employee_id'    => $request->my_employee_id,
                    'clock_rate'        => $request->clock_rate,
                    'number_of_days'    => $request->number_of_days,
                    'date'              => $insert_date,
                    'start_day'         => $request->start_day[$item],
                    'end_day'           => $request->end_day[$item],
                    'number_of_hours'   => $request->number_of_hours[$item],
                ]);
            }
        }

        return redirect()->route('my.employee');
    }

    public function storeChart(){
        $user_id = Auth::user()->id;
        $month = Carbon::now()->format('m');
        $date = Carbon::now();
        $count_day = $date->daysInMonth;
        $first_day = $date->firstOfMonth()->format('Y-m-d');
        $last_day = $date->lastOfMonth()->format('Y-m-d');
        $data_medicall_staff = DataMedicallStaff::where('user_id', $user_id)->where('month', $month)->get(); //данные по мед работникам
        $data_not_medicall_staff = DataNotMedicallStaff::where('user_id', $user_id)->where('month', $month)->get(); //данные по прочим работникам
        $data_individually = DataIndividually::where('user_id', $user_id)->where('date', '>=', $first_day)->where('date', '<=', $last_day)->get(); //данные по индивидуальным графикам рабаты
        $holidays = Holiday::where('date', '>=', $first_day)->where('date', '<=', $last_day)->get(); //праздничные и предпраздничные дни
        //$combinations = Combination::where('user_id', $user_id)->where('start', '<=', $last_day)->where('end', '>=', $first_day)->get();//совмещения
        $dismissals = Dismissal::where('user_id', $user_id)->where('date', '>=', $first_day)->where('date', '<=', $last_day)->get();//увольнения
        $no_shows = NoShows::where('user_id', $user_id)->where('start', '<=', $last_day)->where('end', '>=', $first_day)->get();//неявки

        if(isset($data_not_medicall_staff[0]->id)){ //если есть у данного пользователя нет медперсонал
//            dump('Не медперсонал');
            foreach($data_not_medicall_staff as $insert){//обходим массив сотрудников для которых формируем график
                $first_day_for = Carbon::now()->firstOfMonth();//первый день текущего месяца
                $ptr_sick_leave = 0; //количество дней больничного листа во время отпуска
                for($ptr = 0; $ptr < $count_day; $ptr++){//обходим весь месяц по дням для конкретного сотрудника
                    $data = new Schedule(); //создаем объект типа График
                    $data->user_id = $user_id; //id табельщика
                    $data->my_employee_id = $insert->my_employee_id; //id сотрудника
                    $data->department_id = $insert->department_id;//id подразделения текущего сотрудника
                    /*====================================================================================*/
                    /*
                     * Проверка на рабочие дни и выходные
                     * */
                    if(!$first_day_for->isWeekend()){//если не суббота или воскресенье
                        $data->start_day = $insert->start_day; //начало рабочего дня текущего сотрудника
                        $data->end_day = $insert->end_day; //конец рабочего дня текущего сотрудника
                        $data->date = $first_day_for->format('Y-m-d'); //день месяца
                    }elseif($first_day_for->isWeekend()){//если суббота или воскресенье
                        $data->start_day = 0; //рабочее время по 0
                        $data->end_day = 0; //рабочее время по 0
                        $data->date = $first_day_for->format('Y-m-d'); //день месяца
                    }
                    /*=======================================================================================*/
                    /*
                     * Проверка на предпраздничные дни и праздники
                     * */
                    foreach($holidays as $holiday){
                        if($holiday->type == 1 && $holiday->date == $first_day_for->format('Y-m-d')){//предпраздничный, сокращенный день
                            $data->start_day = $insert->start_day; //начало рабочего дня текущего сотрудника
                            $data->end_day = MyEmployee::timeHolidays($insert->end_day, MyEmployee::where('id', $insert->my_employee_id)->value('rate')); //сокращение рабочего дня в зависимости от скавки текущего сотрудника
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($holiday->type == 2 && $holiday->date == $first_day_for->format('Y-m-d')){
                            $data->start_day = 0;
                            $data->end_day = 0;
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }
                    }
                    /*=========================================================================================*/
                    /*
                     * Проверка на неявки текущего сотрудника на работу
                     * */
                    foreach($no_shows as $no_show){
                        if($no_show->default_type_id == 7 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//командировка
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 6 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//специализация
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 5 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//ученический отпуск
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 4 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//без содержания
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 3 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//прогул
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 2  && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){ //отпуск
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');;
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 1  && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){// б/л
                            $employee = NoShows::where('my_employee_id', $insert->my_employee_id)->where('default_type_id', '=', 2)->where('start', '<=', $first_day_for->format('Y-m-d'))->where('end', '>=', $first_day_for->format('Y-m-d'))->get();
                            if(isset($employee[0]->id)){
                                $ptr_sick_leave++;
                            }
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                            $end_date = $first_day_for->format('Y-m-d');
                        }

                    }
                    /*=========================================================================================*/
                    /*
                     * Проверка на увольнения
                     * */
                    foreach($dismissals as $dismissal){
                        if($dismissal->my_employee_id == $insert->my_employee_id && $dismissal->date <= $first_day_for->format('Y-m-d')){
                            $data->start_day = 'Уво';
                            $data->end_day = 'лен';
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }
                    }
                    $data->save();//сохраняем данные в БД
                    $first_day_for->addDay(); //прибавляем один день
                }
                /*
                 * Если есть совпадения периодов б/л с отпуском.
                 * Продлеваем отпуск на кол-во дней б/л
                 * */
                if(!empty($ptr_sick_leave)){
                    $tmp_date = explode('-',$end_date);
                    $tmp_date_for = Carbon::create($tmp_date[0], $tmp_date[1], $tmp_date[2]+1);
                    for($ptr = 0; $ptr < $ptr_sick_leave; $ptr++){
                        $tmp = Schedule::where('my_employee_id', $insert->my_employee_id)->where('date', $tmp_date_for->format('Y-m-d'))->get();//Находим текущий день и обновляем его
                        $tmp[0]->start_day = DefaultType::where('id', 2)->value('reduction');
                        $tmp[0]->end_day = DefaultType::where('id', 2)->value('reduction');
                        $tmp[0]->date = $tmp_date_for->format('Y-m-d');
                        $tmp[0]->save();
                        $tmp_date_for->addDay();
                    }
                }
            }
        }

        if(isset($data_medicall_staff[0]->id)){//если есть у данного пользователя есть медперсонал
//            dump('Медперсонал');
            foreach($data_medicall_staff as $insert){//обходим массив сотрудников для которых формируем график
                $first_day_for = Carbon::now()->firstOfMonth();//первый день текущего месяца
                $ptr_sick_leave = 0; //количество дней больничного листа во время отпуска
                for($ptr=0; $ptr<$count_day; $ptr++){//обходим весь месяц по дням для конкретного сотрудника
                    $data = new Schedule(); //создаем объект типа График
                    $data->user_id = $user_id; //id табельщика
                    $data->my_employee_id = $insert->my_employee_id; //id сотрудника
                    $data->department_id = $insert->department_id;//id подразделения текущего сотрудника
                    /*====================================================================================*/
                    /*
                     * Проверка на рабочие дни и выходные
                     * */
                    if(!$first_day_for->isWeekend()){//если не суббота или воскресенье
                        $data->start_day = $insert->start_day; //начало рабочего дня текущего сотрудника
                        $data->end_day = $insert->end_day; //конец рабочего дня текущего сотрудника
                        $data->date = $first_day_for->format('Y-m-d'); //день месяца
                    }elseif($first_day_for->isWeekend()){//если суббота или воскресенье
                        $data->start_day = 0; //рабочее время по 0
                        $data->end_day = 0; //рабочее время по 0
                        $data->date = $first_day_for->format('Y-m-d'); //день месяца
                    }
                    if(isset($insert->date_weekday) && $insert->date_weekday == $first_day_for->format('Y-m-d')){
                        $data->start_day = $insert->start_day_weekday; //рабочее время в рабочий выходной
                        $data->end_day = $insert->end_day_weekday; //рабочее время в рабочий выходной
                        $data->date = $insert->date_weekday; //дата рабочего выходного
                    }
                    /*=======================================================================================*/
                    /*
                     * Проверка на предпраздничные дни и праздники
                     * */
                    foreach($holidays as $holiday){
                        if($holiday->type == 1 && $holiday->date == $first_day_for->format('Y-m-d')){//предпраздничный, сокращенный день
                            $data->start_day = $insert->start_day; //начало рабочего дня текущего сотрудника
                            $data->end_day = MyEmployee::timeHolidays($insert->end_day, MyEmployee::where('id', $insert->my_employee_id)->value('rate')); //сокращение рабочего дня в зависимости от скавки текущего сотрудника
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($holiday->type == 2 && $holiday->date == $first_day_for->format('Y-m-d')){
                            $data->start_day = 0;
                            $data->end_day = 0;
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }
                    }
                    /*=========================================================================================*/
                    /*
                     * Проверка на неявки текущего сотрудника на работу
                     * */
                    foreach($no_shows as $no_show){
                        if($no_show->default_type_id == 7 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//командировка
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 6 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//специализация
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 5 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//ученический отпуск
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 4 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//без содержания
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 3 && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){//прогул
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 2  && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){ //отпуск
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }elseif($no_show->default_type_id == 1  && $no_show->my_employee_id == $insert->my_employee_id && ($no_show->start <= $first_day_for->format('Y-m-d') && $no_show->end >= $first_day_for->format('Y-m-d'))){// б/л
                            $employee = NoShows::where('my_employee_id', $insert->my_employee_id)->where('default_type_id', '=', 2)->where('start', '<=', $first_day_for->format('Y-m-d'))->where('end', '>=', $first_day_for->format('Y-m-d'))->get();
                            if(isset($employee[0]->id)){
                                $ptr_sick_leave++;
                            }
                            $data->start_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->end_day = DefaultType::where('id', $no_show->default_type_id)->value('reduction');
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                            $end_date = $first_day_for->format('Y-m-d');
                        }

                    }
                    /*=========================================================================================*/
                    /*
                     * Проверка на увольнения
                     * */
                    foreach($dismissals as $dismissal){
                        if($dismissal->my_employee_id == $insert->my_employee_id && $dismissal->date <= $first_day_for->format('Y-m-d')){
                            $data->start_day = 'Уво';
                            $data->end_day = 'лен';
                            $data->date = $first_day_for->format('Y-m-d'); //день месяца
                        }
                    }
                    $data->save();//сохраняем данные в БД
                    $first_day_for->addDay(); //прибавляем один день
                }
                /*
                 * Если есть совпадения периодов б/л с отпуском.
                 * Продлеваем отпуск на кол-во дней б/л
                 * */
                if(!empty($ptr_sick_leave)){
                    $tmp_date = explode('-',$end_date);
                    $tmp_date_for = Carbon::create($tmp_date[0], $tmp_date[1], $tmp_date[2]+1);
                    for($ptr = 0; $ptr < $ptr_sick_leave; $ptr++){
                        $tmp = Schedule::where('my_employee_id', $insert->my_employee_id)->where('date', $tmp_date_for->format('Y-m-d'))->get();//Находим текущий день и обновляем его
                        $tmp[0]->start_day = DefaultType::where('id', 2)->value('reduction');
                        $tmp[0]->end_day = DefaultType::where('id', 2)->value('reduction');
                        $tmp[0]->date = $tmp_date_for->format('Y-m-d');
                        $tmp[0]->save();
                        $tmp_date_for->addDay();
                    }
                }
            }
        }

        if(isset($data_individually[0]->id)) {//если есть у данного пользователя есть есть сведения по конктетном сотруднику
//            dump('Индивидуальный график');
            $count_individually_employees = DataIndividually::where('user_id', $user_id)->where('date', '>=', $first_day)->where('date', '<=', $last_day)->get()->groupBy('my_employee_id');//количество сотрудников по индивидуальным графикам
            foreach($count_individually_employees as $key => $inserts){
//                dump(count($inserts));
                $first_day_for = Carbon::now()->firstOfMonth();//первый день текущего месяца
                $ptr_sick_leave = 0; //количество дней больничного листа во время отпуска
                for($ptr = 0; $ptr < $count_day; $ptr++){//обходим текущий месяц
                    $data = new Schedule();//создаем новый объект
                    $data->user_id = $user_id; //id табельщика
                    foreach($inserts as $insert){//рабочие даты текущего сотрудника
                        $data->my_employee_id = $insert->my_employee_id; //id сотрудника
                        $data->department_id = $insert->department_id;//id подразделения текущего сотрудника
                        if($insert->date == $first_day_for->format('Y-m-d')){
                            $data->start_day = $insert->start_day;
                            $data->end_day = $insert->end_day;
                            $data->date = $insert->date;
                            break;
                        }else{
                            $data->start_day = 0;
                            $data->end_day = 0;
                            $data->date = $first_day_for->format('Y-m-d');
                            continue;
                        }
                    }
                    $data->save();
                    $first_day_for->addDay();
                }
            }
        }

        return redirect()->route('my.employee');
    }
}
