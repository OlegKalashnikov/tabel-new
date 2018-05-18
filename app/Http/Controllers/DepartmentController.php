<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('settings.departments.department', [
            'departments' => Department::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadForm(){
        return view('settings.departments.upload');
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
                Department::create([
                    'department' => $insert->department,
                ]);
                $ptr++;
            }
        }
        return redirect()->route('settings.department')->with([
            'success'   => 'Данные успешно загружены',
            'log'       => $ptr
        ]);
    }

    /**
     * @param Department $department
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Department $department){
        return view('settings.departments.edit', [
            'department' => $department,
        ]);
    }

    /**
     * @param Request $request
     * @param Department $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Department $department){
        request()->validate([
            'department' => 'required',
        ]);
        $department->update($request->all());
        return redirect()->route('settings.department')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('settings.departments.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'department' => 'required',
        ]);
        Department::create($request->all());
        return redirect()->route('settings.department')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }
}
