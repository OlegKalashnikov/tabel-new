<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('settings.users.user', [
            'users' => User::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm(){
        return view('settings.users.create', [
            'roles' => Role::where('id', '>', '1')->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        request()->validate([
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        if(isset($request->role_id)){
           User::create([
               'name' => $request->name,
               'login' => $request->login,
               'password' => Hash::make($request->password),
               'status' => 1,
               'role_id' => $request->role_id
           ]);

            return redirect()->route('settings.user')->with([
                'success'   => 'Данные успешно созданы',
            ]);
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(User $user){
        return view('settings.users.edit', [
            'user' => $user,
            'roles' => Role::where('id', '>', '1')->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user){
        request()->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required',
        ]);
        if(isset($request->role_id)){
            $user->update($request->all());
            return redirect()->route('settings.user')->with([
                'success'   => 'Данные успешно обновлены',
            ]);
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changepswdForm(User $user){
        return view('settings.users.changepswd', [
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changepswd(Request $request, User $user){
        request()->validate([
            'password' => 'required|string|min:5|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('settings.user')->with([
            'success'   => 'Данные успешно обновлены',
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blockForm(User $user){
        return view('settings.users.block', [
            'user' => $user
        ]);
    }

    public function block(Request $request, User $user){
        request()->validate([
            'status' => 'required',
        ]);

        if(isset($request->status)){
            $user->update($request->all());
            return redirect()->route('settings.user')->with([
                'success'   => 'Данные успешно обновлены',
            ]);
        }

    }
}
