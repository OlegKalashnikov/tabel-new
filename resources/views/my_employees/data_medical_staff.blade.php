@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/wizard/steps.css')}}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
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
        <div class="col-md-7 col-8 align-self-center">
            <h3 class="text-themecolor">Данные для формирования графика и табеля учета рабочего времени</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Сотрудники</li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body wizard-content">
                    <h6 class="card-subtitle">Внесите данные для автоматического формирования табеля и графика</h6>
                    <form action="{{route('my.employee.store.medicalstaff')}}" method="POST" class="tab-wizard wizard-circle form-material">
                        @csrf
                        <!-- Step 1 -->
                        <h6>Основные данные</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="select2" name="department_id" style="width: 100%">
                                            <option value="">Выберите подразделение</option>
                                            @foreach($selectDepartments as $department)
                                                <option value="{{$department->id}}">{{$department->department}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="select2" name="month" style="width: 100%">
                                            <option value="">Выберите месяц за который формируете данные</option>
                                            <option value="1">Январь</option>
                                            <option value="2">Февраль</option>
                                            <option value="3">Март</option>
                                            <option value="4">Апрель</option>
                                            <option value="5">Май</option>
                                            <option value="6">Июнь</option>
                                            <option value="7">Июль</option>
                                            <option value="8">Август</option>
                                            <option value="9">Сентябрь</option>
                                            <option value="10">Октябрь</option>
                                            <option value="11">Ноябрь</option>
                                            <option value="12">Декабрь</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pb-5">
                                    <select id='pre-selected-options' name="my_employee_id[]" multiple='multiple' style="width: 100%">
                                        @foreach($myEmployees as $myEmployee)
                                            <option value="{{$myEmployee->id}}">{{$myEmployee->employee->employee}} - {{$myEmployee->position->position}} - {{$myEmployee->rate}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h6>Норма часов</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="clock_rate" class="form-control" placeholder="Укажите месячную норму часов на ставку">
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h6>График</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" data-mask="99:99" name="start_day" class="form-control" placeholder="Укажите начало рабочего дня">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" data-mask="99:99" name="end_day" class="form-control" placeholder="Укажите конец рабочего дня">
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 4 -->
                        <h6>Табель</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" data-mask="99:99" name="number_of_hours" class="form-control" placeholder="Укажите количество часов в день на ставку">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="number_of_days" placeholder="Укажите количество рабочих дней">
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 5 -->
                        <h6>Выходные</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control " name="date_weekday" id="mdate" placeholder="Укажите дату выхода в выходной день">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" data-mask="99:99" name="start_day_weekday" class="form-control " placeholder="Укажите начало рабочего дня">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" data-mask="99:99" name="end_day_weekday" class="form-control " placeholder="Укажите конец рабочего дня">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{asset('plugins/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{asset('plugins/wizard/jquery.validate.min.js')}}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('plugins/wizard/steps.js')}}"></script>
    <script src="{{asset('plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript" src="{{asset('plugins/multiselect/js/jquery.multi-select.js')}}"></script>

    <script src="{{asset('js/mask.js')}}"></script>
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

    <script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();

            // For multiselect
            $('#pre-selected-options').multiSelect();
            $('#optgroup').multiSelect({
                selectableOptgroup: true
            });
        });
    </script>
@endsection