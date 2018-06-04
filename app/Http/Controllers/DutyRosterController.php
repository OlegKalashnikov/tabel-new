<?php

namespace App\Http\Controllers;

use App\DutyRoster;
use App\MyEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DutyRosterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('dutyrosters.dutyroster', [
            'dutyrosters' => DutyRoster::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('dutyrosters.create', [
            'myEmployees' => MyEmployee::where('user_id', Auth::user()->id)->where('show', 1)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'my_employee_id' => 'required',
            'type' => 'required',
            'date' => 'required',
        ]);

        DutyRoster::create([
            'my_employee_id' => $request->my_employee_id,
            'type' => $request->type,
            'date' => $request->date,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('duty.roster');
    }

    /**
     * @param DutyRoster $dutyRoster
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(DutyRoster $dutyRoster){
        return view('dutyrosters.edit', [
            'dutyroster' => $dutyRoster,
        ]);
    }

    /**
     * @param Request $request
     * @param DutyRoster $dutyRoster
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, DutyRoster $dutyRoster){
        request()->validate([
            'type' => 'required',
            'date' => 'required',
        ]);

        $dutyRoster->update($request->all());

        return redirect()->route('duty.roster');
    }
}
