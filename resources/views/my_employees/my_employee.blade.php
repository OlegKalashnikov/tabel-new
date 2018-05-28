@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Мои сотрудники</h3>
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
                <div class="card-body">
                    <div class="card-subtitle">
                        <a href="{{route('my.employee.create')}}" class="btn btn-outline-success"><i class="fa fa-plus"></i> Добавить сотрудника</a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Формирование данных
                            </button>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="{{route('my.employee.create.medicalstaff')}}">Для медперсонала</a>
                                <a class="dropdown-item" href="{{route('my.employee.create.notmedicalstaff')}}">Для не медперсонала</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('my.employee.create.individually')}}">Отдельно по сотруднику</a>
                            </div>
                        </div>
                        <a href="{{route('my.employee.store.chart')}}" class="btn btn-outline-success"><i class="fa fa-plus"></i> Сформировать график</a>
                        <div class="btn-group">
                            <a href="{{route('my.employee.store.report.card')}}" class="btn btn-outline-success">Сформировать табель за текущий месяц</a>
                            <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Сформировать табель за январь</a>
                                <a class="dropdown-item" href="#">Сформировать табель за февраль</a>
                                <a class="dropdown-item" href="#">Сформировать табель за март</a>
                                <a class="dropdown-item" href="#">Сформировать табель за апрель</a>
                                <a class="dropdown-item" href="#">Сформировать табель за май</a>
                                <a class="dropdown-item" href="#">Сформировать табель за июнь</a>
                                <a class="dropdown-item" href="#">Сформировать табель за июль</a>
                                <a class="dropdown-item" href="#">Сформировать табель за август</a>
                                <a class="dropdown-item" href="#">Сформировать табель за сентябрь</a>
                                <a class="dropdown-item" href="#">Сформировать табель за октябрь</a>
                                <a class="dropdown-item" href="#">Сформировать табель за ноябрь</a>
                                <a class="dropdown-item" href="#">Сформировать табель за декабрь</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Ф.И.О. сотрудника</th>
                                <th>Отдел</th>
                                <th>Должность</th>
                                <th>Ставка</th>
                                <th>Норма</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($myEmployees as $myEmployee)
                                <tr>
                                    <td>{{$myEmployee->employee->employee}}</td>
                                    <td>{{$myEmployee->department->department}}</td>
                                    <td>{{$myEmployee->position->position}}</td>
                                    <td>{{$myEmployee->rate}}</td>
                                    <td>{{\App\MyEmployee::standard($myEmployee, 05)}}</td>
                                    <td class="text-nowrap">
                                        {{--<a href="" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>--}}
                                        <a href="{{route('my.employee.destroy', $myEmployee)}}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash text-danger"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
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

        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    </script>
@endsection