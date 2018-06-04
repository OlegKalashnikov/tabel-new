<?php

namespace App\Http\Controllers;

use App\Category;
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
use App\Timetable;
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
        $myEmployees = MyEmployee::where('user_id', $user_id)->where('show', 1)->get();
        $last_updated_at_timetables = Timetable::where('user_id', $user_id)->orderBy('updated_at', 'desc')->limit(1)->value('updated_at');
        if(is_null($last_updated_at_timetables) || !empty($last_updated_at_timetables)){
            //dd($last_updated_at_timetables);
            $show_btn_timetables = TRUE;
        }
        return view('my_employees.my_employee', [
            'myEmployees' => $myEmployees,
            'show_btn_timetables' => $show_btn_timetables,
            'month' => mb_strtolower(\Illuminate\Support\Carbon::now()->format('M')),
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
        $selectCategories = Category::all();
        return view('my_employees.create', [
            'selectEmployees' => $selectEmployees,
            'selectDepartments' => $selectDepartments,
            'selectPositions' => $selectPositions,
            'myEmployees' => MyEmployee::where('user_id', $user_id)->where('show', 1)->get(),
            'selectCategories' => $selectCategories,
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
            'category_id' => 'required'
        ]);
        $user_id = Auth::user()->id;
        MyEmployee::create([
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'rate' => $request->rate,
            'user_id' => $user_id,
            'category_id' => $request->category_id
        ]);

        return view('my_employees.create', [
            'myEmployees' => MyEmployee::where('user_id', $user_id)->where('show', 1)->get(),
            'selectEmployees' => Employee::all(),
            'selectDepartments' => Department::all(),
            'selectPositions' => Position::all(),
            'selectCategories' => Category::all(),
        ]);
    }

    /**
     * @param MyEmployee $myEmployee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showStatus(MyEmployee $myEmployee){
        $myEmployee->update([
            'show' => 0
        ]);
        return redirect()->route('my.employee');
    }


    /**
     * @param MyEmployee $myEmployee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFormEdit(MyEmployee $myEmployee){
        $categories = Category::all();
        $positions = Position::all();
        $departments = Department::all();
        return view('my_employees.edit', [
            'categories' => $categories,
            'positions' => $positions,
            'departments' => $departments,
            'myEmployee' => $myEmployee
        ]);
    }

    /**
     * @param Request $request
     * @param MyEmployee $myEmployee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, MyEmployee $myEmployee){
        request()->validate([
            'employee_id' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'rate' => 'required',
            'category_id' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $myEmployee->update([
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'rate' => $request->rate,
            'user_id' => $user_id,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('my.employee');
    }

}
