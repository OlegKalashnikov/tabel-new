@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Редактирование записи</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Неявки</a></li>
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
                        <form method="POST" action="{{route('no.shows.update', $noShows)}}" class="form-material">
                            @csrf
                            {{method_field('patch')}}
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" value="{{$noShows->my_employee->employee->employee}}" readonly>
                            </div>
                            <div class="form-group">
                                <select name="default_type_id" class="form-control select2">
                                    <option value="0">Выберите тип неявки</option>
                                    @foreach($defaultTypes as $defaultType)
                                        <option value="{{$defaultType->id}}" @if($defaultType->id == $noShows->default_type_id) selected @endif>{{$defaultType->absence}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="start" class="form-control" value="{{$noShows->start}}" placeholder="Укажите дату начала периода" id="mdate_start">
                            </div>
                            <div class="form-group">
                                <input type="text" name="end" class="form-control" value="{{$noShows->end}}" placeholder="Укажите дату конца периода" id="mdate_end">
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Обновить</button>
                            <a href="{{route('no.shows')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
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
    <script src="{{asset('plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script>
        // MAterial Date picker
        $('#mdate_start').bootstrapMaterialDatePicker({ weekStart : 1, time: false });
        $('#mdate_end').bootstrapMaterialDatePicker({ weekStart : 1, time: false });

        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();

        });
    </script>
@endsection