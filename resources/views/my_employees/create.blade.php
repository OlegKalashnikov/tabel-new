@extends('layouts.app')

@section('page-css')
    <link href="{{asset('plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Создание списка сотрудников</h3>
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
                        <form method="POST" action="{{route('my.employee.store')}}" class="form-material">
                            @csrf
                            <div class="form-group">
                                <select class="select2" name="employee_id" style="width: 100%">
                                    <option value="">Выберите сотрудника</option>
                                    @foreach($selectEmployees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->employee}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="select2" name="department_id" style="width: 100%">
                                    <option value="">Выберите подразделение</option>
                                    @foreach($selectDepartments as $department)
                                        <option value="{{$department->id}}">{{$department->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="select2" name="position_id" style="width: 100%">
                                    <option value="">Выберите должность</option>
                                    @foreach($selectPositions as $position)
                                        <option value="{{$position->id}}">{{$position->position}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="select2" name="rate" style="width: 100%">
                                    <option value="">Выберите ставку</option>
                                    <option value="1">1</option>
                                    <option value="0.75">0.75</option>
                                    <option value="0.5">0.5</option>
                                    <option value="0.25">0.25</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Создать</button>
                            <a href="{{route('my.employee')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <div class="table-responsive m-t-40">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Ф.И.О. cотрудника</th>
                            <th>Отдел</th>
                            <th>Должность</th>
                            <th>Ставка</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($myEmployees as $myEmployee)
                            <tr>
                                <td>{{$myEmployee->employee->employee}}</td>
                                <td>{{$myEmployee->department->department}}</td>
                                <td>{{$myEmployee->position->position}}</td>
                                <td>{{$myEmployee->rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
    <script src="{{asset('plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <!-- This is data table -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $('#example23').DataTable();
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

        });
    </script>
@endsection