<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PositionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('settings.positions.position', [
            'positions' => Position::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadForm(){
        return view('settings.positions.upload');
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
                Position::create([
                    'position' => $insert->position,
                ]);
                $ptr++;
            }
        }
        return redirect()->route('settings.position')->with([
            'success'   => 'Данные успешно загружены',
            'log'       => $ptr
        ]);
    }

    /**
     * @param Position $position
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Position $position){
        return view('settings.positions.edit', [
            'position' => $position,
        ]);
    }

    /**
     * @param Request $request
     * @param Position $position
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Position $position){
        request()->validate([
            'position' => 'required',
        ]);
        $position->update($request->all());
        return redirect()->route('settings.position')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('settings.positions.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'position' => 'required',
        ]);
        Position::create($request->all());
        return redirect()->route('settings.position')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }
}
