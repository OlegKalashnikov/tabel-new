@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Создание сотрудника</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Сотрудники</a></li>
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
                        <form method="POST" action="{{route('settings.employee.store')}}" class="form-material">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="employee" value="{{ old('employee') }}" placeholder="Ф.И.О. сотрудника">
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Создать</button>
                            <a href="{{route('settings.employee')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection