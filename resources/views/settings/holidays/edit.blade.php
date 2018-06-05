@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Редактирование праздничного дня</h3>
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
                        <form method="POST" action="{{route('settings.holiday.update', $holiday)}}" class="form-material">
                            @csrf
                            {{method_field('patch')}}
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
                            <div class="form-group">
                                <select name="sixday" class="form-control">
                                    <option value="">Учитывать при 6-ти дневной рабочей недели</option>
                                    <option value="0" @if(!$holiday->sixday) selected @endif>Нет</option>
                                    <option value="1" @if($holiday->sixday) selected @endif>Да</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Обновить</button>
                            <a href="{{route('settings.holiday')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <!-- ============================================================== -->
    <!-- Plugins for this page -->
    <!-- ============================================================== -->
    <!-- Plugin JavaScript -->

    <script src="{{asset('plugins/moment/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
        // MAterial Date picker
        $('#mdate').bootstrapMaterialDatePicker({ weekStart : 1, time: false });
    </script>
@endsection