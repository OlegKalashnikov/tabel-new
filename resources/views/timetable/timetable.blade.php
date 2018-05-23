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