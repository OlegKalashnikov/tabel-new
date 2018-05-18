@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Пользователи</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
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
                        <a href="{{route('settings.user.create')}}" class="btn btn-outline-success"><i class="fa fa-plus"></i> Новый пользователь</a>
                        <a href="javascript:void(0)" class="btn btn-outline-success"> Онлайн пользователи</a>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ФИО пользователя</th>
                                    <th>Логин</th>
                                    <th>Роль</th>
                                    <th>Статус</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->login}}</td>
                                        <td>{{$user->role->display}}</td>
                                        <td>
                                            @if($user->status)
                                                Активен
                                            @else
                                                Заблокирован
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="{{route('settings.user.edit', $user)}}" data-toggle="tooltip" data-original-title="Редактировать"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                            <a href="{{route('settings.user.changepswd', $user)}}" data-toggle="tooltip" data-original-title="Сменить пароль"> <i class="fa fa-key text-inverse m-r-10"></i> </a>
                                            <a href="{{route('settings.user.block', $user)}}" data-toggle="tooltip" data-original-title="Заблокировать"> <i class="fa fa-close text-danger"></i> </a>
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