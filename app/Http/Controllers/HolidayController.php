<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('settings.holidays.holiday', [
            'holidays' => Holiday::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('settings.holidays.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'type' => 'required',
            'date' => 'required',
        ]);
        if($request->type > 0){
            Holiday::create($request->all());
            return redirect()->route('settings.holiday')->with([
                'success'   => 'Данные успешно созданы',
            ]);

        }
    }

    /**
     * @param Holiday $holiday
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Holiday $holiday){
        return view('settings.holidays.edit', [
            'holiday' => $holiday,
        ]);
    }

    /**
     * @param Request $request
     * @param Holiday $holiday
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Holiday $holiday){
        request()->validate([
            'type' => 'required',
            'date' => 'required',
        ]);
        if($request->type > 0){
            $holiday->update($request->all());
            return redirect()->route('settings.holiday')->with([
                'success'   => 'Данные успешно обновлены',
            ]);
        }
    }

    /**
     * @param Holiday $holiday
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroyForm(Holiday $holiday){
        return view('settings.holidays.destroy', [
            'holiday' => $holiday,
        ]);
    }

    /**
     * @param Holiday $holiday
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Holiday $holiday){
        $holiday->delete();
        return redirect()->route('settings.holiday')->with([
            'success'   => 'Данные успешно удалены',
        ]);
    }

}
