<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('settings.employees.employee', [
            'employees' => Employee::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadForm(){
        return view('settings.employees.upload');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request){
        request()->validate([
            'upload' => 'required|file|max:2048'
        ]);

        $path = $request->file('upload')->getRealPath();
        $data = Excel::load($path, function ($reader){})->get();
        $ptr = 0;
        if(!empty($data)){
            foreach ($data as $insert){
                Employee::create([
                    'employee' => $insert->employee,
                ]);
                $ptr++;
            }
        }
        return redirect()->route('settings.employee')->with([
            'success'   => 'Данные успешно загружены',
            'log'       => $ptr
        ]);
    }

    /**
     * @param Employee $employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Employee $employee){
        return view('settings.employees.edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Employee $employee){
        request()->validate([
            'employee' => 'required',
        ]);
        $employee->update($request->all());
        return redirect()->route('settings.employee')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('settings.employees.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'employee' => 'required',
        ]);
        Employee::create($request->all());
        return redirect()->route('settings.employee')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }
}
