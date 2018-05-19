@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-9 col-8 align-self-center">
            <h3 class="text-themecolor">Список табелей</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Табель</li>
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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Подразделение</th>
                                    <th>Месяц</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tdoby>
                                @if(isset($data_individuallies[0]->department_id))
                                    @foreach($data_individuallies as $data_individually)
                                        <tr>
                                            <td>{{\App\Schedule::department_name($data_individually->department_id)}}</td>
                                            <td>{{\App\Schedule::month($data_individually->month)}}</td>
                                            <td class="text-nowrap">
                                                <a href="{{route('timetable.show', [$data_individually->department_id, $data_individually->month])}}" data-toggle="tooltip" data-original-title="Просмотр"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                                                {{--<a href="#" data-toggle="tooltip" data-original-title="Редактирование"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>--}}
                                                {{--<a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(isset($data_not_medicall_staffs[0]->department_id))
                                    @foreach($data_not_medicall_staffs as $data_not_medicall_staff)
                                        <tr>
                                            <td>{{\App\Schedule::department_name($data_not_medicall_staff->department_id)}}</td>
                                            <td>{{\App\Schedule::month($data_not_medicall_staff->month)}}</td>
                                            <td class="text-nowrap">
                                                <a href="{{route('timetable.show', [$data_not_medicall_staff->department_id, $data_not_medicall_staff->month])}}" data-toggle="tooltip" data-original-title="Просмотр"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                                                {{--<a href="#" data-toggle="tooltip" data-original-title="Редактирование"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>--}}
                                                {{--<a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(isset($data_medicall_staffs[0]->department_id))
                                    @foreach($data_medicall_staffs as $data_medicall_staff)
                                        <tr>
                                            <td>{{\App\Schedule::department_name($data_medicall_staff->department_id)}}</td>
                                            <td>{{\App\Schedule::month($data_medicall_staff->month)}}</td>
                                            <td class="text-nowrap">
                                                <a href="{{route('timetable.show', [$data_medicall_staff->department_id, $data_medicall_staff->month])}}" data-toggle="tooltip" data-original-title="Просмотр"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                                                {{--<a href="#" data-toggle="tooltip" data-original-title="Редактирование"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>--}}
                                                {{--<a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tdoby>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection