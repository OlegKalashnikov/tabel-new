<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('settings.categories.category', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('settings.categories.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'category' => 'required|unique:categories',
        ]);
        Category::create($request->all());
        return redirect()->route('settings.category')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Category $category){
        return view('settings.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category){
        request()->validate([
            'category' => 'required|unique:categories',
        ]);
        $category->update($request->all());
        return redirect()->route('settings.category')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }
}
