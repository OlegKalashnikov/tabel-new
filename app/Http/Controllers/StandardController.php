<?php

namespace App\Http\Controllers;

use App\Category;
use App\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StandardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        $month = Carbon::now()->format('m');
        $standardsAhh = Standard::where('category_id', 13)->get(); //АХЧ
        $standardsDoctor = Standard::where('category_id', 1)->get(); //Врачи
        $standardsAverage = Standard::where('category_id', 2)->get(); //Средние
        $standardsTreatmentroom = Standard::where('category_id', 11)->get(); //Процедурный кабинет
        $standardsPhysio = Standard::where('category_id', 10)->get(); //Физио
        $standardsHospital = Standard::where('category_id', 9)->get(); //Врачи стационар
        $standardsInfectiousdiseaseroom = Standard::where('category_id', 8)->get(); //Инфекционный кабинет
        $standardsNurses = Standard::where('category_id', 3)->get(); //Санитарки
        $standardsQuak = Standard::where('category_id', 4)->get(); //Квоп
        $standardsMedicaldispensary = Standard::where('category_id', 5)->get(); //ВА
        $standardsHealthcenter = Standard::where('category_id', 6)->get(); //ЗП
        $standardsCdl = Standard::where('category_id', 7)->get(); //КДЛ
        $standardsDentist = Standard::where('category_id', 12)->get(); //Врач стоматолог
        $standardsRoentgen = Standard::where('category_id', 14)->get(); //рентген
        $standardsJuniormedicalstaff = Standard::where('category_id', 15)->get(); //младший
        //dd($month);
        return view('standards.standard', [
            'standardsAhh' => $standardsAhh,
            'standardsDoctor' => $standardsDoctor,
            'standardsAverage' => $standardsAverage,
            'standardsTreatmentroom' => $standardsTreatmentroom,
            'standardsHospital' => $standardsHospital,
            'standardsPhysio' => $standardsPhysio,
            'standardsInfectiousdiseaseroom' => $standardsInfectiousdiseaseroom,
            'standardsNurses' => $standardsNurses,
            'standardsQuak' => $standardsQuak,
            'standardsMedicaldispensary' => $standardsMedicaldispensary,
            'standardsHealthcenter' => $standardsHealthcenter,
            'standardsCdl' => $standardsCdl,
            'standardsDentist' => $standardsDentist,
            'standardsRoentgen' => $standardsRoentgen,
            'standardsJuniormedicalstaff' => $standardsJuniormedicalstaff,
            'month' => $month,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('standards.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'category_id' => 'required',
            'name' => 'required',
            'jan' => 'required',
            'feb' => 'required',
            'mar' => 'required',
            'apr' => 'required',
            'may' => 'required',
            'jun' => 'required',
            'jul' => 'required',
            'aug' => 'required',
            'sep' => 'required',
            'oct' => 'required',
            'nov' => 'required',
            'dec' => 'required',
            'rate' => 'required',
        ]);
        Standard::create($request->all());
        return redirect()->route('standard')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }

    /**
     * @param Standard $standard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Standard $standard){
        return view('standards.edit', [
            'standard' => $standard,
            'categories' => Category::all(),
        ]);
    }

    /**
     * @param Request $request
     * @param Standard $standard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Standard $standard){
        request()->validate([
            'category_id' => 'required',
            'name' => 'required',
            'jan' => 'required',
            'feb' => 'required',
            'mar' => 'required',
            'apr' => 'required',
            'may' => 'required',
            'jun' => 'required',
            'jul' => 'required',
            'aug' => 'required',
            'sep' => 'required',
            'oct' => 'required',
            'nov' => 'required',
            'dec' => 'required',
            'rate' => 'required',
        ]);
        $standard->update($request->all());
        return redirect()->route('standard')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }
}
