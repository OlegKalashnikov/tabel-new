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
                    <div class="card-subtitle">
                        <div class="btn-group">
                            <a href="{{route('timetable.create', $month)}}" class="btn btn-outline-success">Сформировать табель за текущий месяц</a>
                            <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('timetable.create', 1)}}">Сформировать табель за январь</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 2)}}">Сформировать табель за февраль</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 3)}}">Сформировать табель за март</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 4)}}">Сформировать табель за апрель</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 5)}}">Сформировать табель за май</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 6)}}">Сформировать табель за июнь</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 7)}}">Сформировать табель за июль</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 8)}}">Сформировать табель за август</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 9)}}">Сформировать табель за сентябрь</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 10)}}">Сформировать табель за октябрь</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 11)}}">Сформировать табель за ноябрь</a>
                                <a class="dropdown-item" href="{{route('timetable.create', 12)}}">Сформировать табель за декабрь</a>
                            </div>
                        </div>
                    </div>
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
                                @forelse($data as $key => $value)
                                    <tr>
                                        <td>{{\App\Schedule::department_name($key)}}</td>
                                        <td>{{\App\Schedule::month($value)}}</td>
                                        <td class="text-nowrap">
                                            <a href="{{route('timetable.show', [$key, $value])}}" data-toggle="tooltip" data-original-title="Просмотр"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Сформируйте табель</td>
                                    </tr>
                                @endforelse
                            </tdoby>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection