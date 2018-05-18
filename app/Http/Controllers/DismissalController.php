<?php

namespace App\Http\Controllers;

use App\Dismissal;
use App\MyEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DismissalController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('dismissals.dismissal', [
            'dismissals' => Dismissal::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('dismissals.create', [
            'myEmployees' => MyEmployee::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'my_employee_id' => 'required',
            'date' => 'required',
        ]);

        Dismissal::create([
            'my_employee_id' => $request->my_employee_id,
            'date' => $request->date,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dismissal');
    }

    /**
     * @param Dismissal $dismissal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Dismissal $dismissal){
        return view('dismissals.edit', [
            'dismissal' => $dismissal,
        ]);
    }

    /**
     * @param Request $request
     * @param Dismissal $dismissal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Dismissal $dismissal){
        request()->validate([
            'date' => 'required',
        ]);

        $dismissal->update($request->all());

        return redirect()->route('dismissal');
    }

}
