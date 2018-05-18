@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Удаление праздничного дня</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Праздничные дни</a></li>
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
                        <form method="POST" action="{{route('settings.holiday.destroy', $holiday)}}" class="form-material">
                            @csrf
                            {{method_field('delete')}}
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    <option value="0">Выберите тип дня</option>
                                    <option value="1" @if($holiday->type == 1) selected @endif >Предпраздничные день</option>
                                    <option value="2" @if($holiday->type == 2) selected @endif>Праздничный день</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="date" class="form-control" placeholder="Выберите день" value="{{$holiday->date}}" id="mdate">
                            </div>
                            <button type="submit" class="btn btn-danger waves-effect waves-light m-r-10">Удалить</button>
                            <a href="{{route('settings.holiday')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection