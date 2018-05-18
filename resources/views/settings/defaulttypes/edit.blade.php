@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Редактирование вида неявки</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Тип неявки</a></li>
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
                        <form method="POST" action="{{route('settings.defaulttype.update', $defaulttype)}}" class="form-material">
                            @csrf
                            {{method_field('patch')}}
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="absence" value="{{$defaulttype->absence}}" placeholder="Вид неявки">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="reduction" value="{{$defaulttype->reduction}}" placeholder="Сокращение для табеля">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="holiday" value="1" id="basic_checkbox_1" @if($defaulttype->holiday) checked @endif />
                                <label for="basic_checkbox_1">Учитывать на праздниках</label>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Обновить</button>
                            <a href="{{route('settings.defaulttype')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection