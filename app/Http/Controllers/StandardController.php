<?php

namespace App\Http\Controllers;

use App\Category;
use App\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('standards.standard', [
            'standards' => Standard::all(),
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
            'january' => 'required',
            'february' => 'required',
            'march' => 'required',
            'april' => 'required',
            'may' => 'required',
            'june' => 'required',
            'july' => 'required',
            'august' => 'required',
            'september' => 'required',
            'october' => 'required',
            'november' => 'required',
            'december' => 'required',
            'year' => 'required',
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
            'january' => 'required',
            'february' => 'required',
            'march' => 'required',
            'april' => 'required',
            'may' => 'required',
            'june' => 'required',
            'july' => 'required',
            'august' => 'required',
            'september' => 'required',
            'october' => 'required',
            'november' => 'required',
            'december' => 'required',
            'year' => 'required',
            'rate' => 'required',
        ]);
        $standard->update($request->all());
        return redirect()->route('standard')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }
}
