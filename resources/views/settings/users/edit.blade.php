@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Редактирование пользователя</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Пользователи</a></li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form method="POST" action="{{route('settings.user.update', $user)}}" class="form-material">
                            @csrf
                            {{method_field('patch')}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Ф.И.О пользователя">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="login" value="{{$user->login}}" placeholder="Логин">
                            </div>
                            <div class="form-group">
                                <select name="role_id" class="form-control">
                                    <option value="">Выберите роль</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if($role->id == $user->role_id) selected @endif>{{$role->display}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Обновить</button>
                            <a href="{{route('settings.user')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
