<?php

namespace App\Http\Controllers;

use App\DefaultType;
use App\MyEmployee;
use App\NoShows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoShowsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('no_shows.no_shows', [
            'noShows' => NoShows::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('no_shows.create', [
            'myEmployees' => MyEmployee::where('user_id', Auth::user()->id)->get(),
            'defaultTypes' => DefaultType::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'my_employee_id' => 'required',
            'default_type_id' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        NoShows::create([
            'my_employee_id' => $request->my_employee_id,
            'default_type_id' => $request->default_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('no.shows');
    }

    /**
     * @param NoShows $noShows
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(NoShows $noShows){
        return view('no_shows.edit', [
            'noShows' => $noShows,
            'defaultTypes' => DefaultType::all(),
        ]);
    }

    /**
     * @param Request $request
     * @param NoShows $noShows
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, NoShows $noShows){
        request()->validate([
            'default_type_id' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $noShows->update([
            'my_employee_id' => $noShows->my_employee_id,
            'default_type_id' => $request->default_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('no.shows');
    }
}
