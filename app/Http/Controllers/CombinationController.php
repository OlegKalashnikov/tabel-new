<?php

namespace App\Http\Controllers;

use App\Combination;
use App\MyEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CombinationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('combinations.combination', [
            'combinations' => Combination::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('combinations.create', [
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
            'percentages' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        Combination::create([
            'my_employee_id' => $request->my_employee_id,
            'percentages' => $request->percentages,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('combination');
    }

    /**
     * @param Combination $combination
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Combination $combination){
        return view('combinations.edit', [
            'combination' => $combination,
        ]);
    }

    /**
     * @param Request $request
     * @param Combination $combination
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Combination $combination){
        request()->validate([
            'percentages' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $combination->update($request->all());

        return redirect()->route('combination');
    }
}
