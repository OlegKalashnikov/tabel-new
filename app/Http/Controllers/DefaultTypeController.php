<?php

namespace App\Http\Controllers;

use App\DefaultType;
use Illuminate\Http\Request;

class DefaultTypeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('settings.defaulttypes.defaulttype', [
            'defaulttypes' => DefaultType::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('settings.defaulttypes.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'absence' => 'required',
            'reduction' => 'required',
        ]);
        DefaultType::create($request->all());
        return redirect()->route('settings.defaulttype')->with([
            'success'   => 'Данные успешно созданы',
        ]);
    }

    /**
     * @param DefaultType $defaulttype
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(DefaultType $defaulttype){
        return view('settings.defaulttypes.edit', [
            'defaulttype' => $defaulttype,
        ]);
    }

    /**
     * @param Request $request
     * @param DefaultType $defaulttype
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, DefaultType $defaulttype){
        request()->validate([
            'absence' => 'required',
            'reduction' => 'required',
        ]);
        if(isset($request->holiday)){
            $defaulttype->update($request->all());
        }elseif(!isset($request->holiday)){
            $defaulttype->update([
                'absence' => $request->absence,
                'reduction' => $request->reduction,
                'holiday' => 0,
            ]);
        }

        return redirect()->route('settings.defaulttype')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }
}
