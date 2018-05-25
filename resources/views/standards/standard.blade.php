@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Нормы продолжительности рабочего дня по категориям и ставкам</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Нормы</li>
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
                        <a href="{{route('standard.create')}}" class="btn btn-outline-success"><i class="fa fa-plus"></i> Новая норма</a>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table  class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Январь</th>
                                <th>Февраль</th>
                                <th>Март</th>
                                <th>Апрель</th>
                                <th>Май</th>
                                <th>Июнь</th>
                                <th>Июль</th>
                                <th>Август</th>
                                <th>Сентябрь</th>
                                <th>Октябрь</th>
                                <th>Ноябрь</th>
                                <th>Декабрь</th>
                                <th>За год</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($standards as $standard)
                                <tr>
                                    <td><a href="{{route('standard.edit', $standard)}}">{{$standard->name}}</a></td>
                                    <td>{{$standard->january}}</td>
                                    <td>{{$standard->february}}</td>
                                    <td>{{$standard->march}}</td>
                                    <td>{{$standard->april}}</td>
                                    <td>{{$standard->may}}</td>
                                    <td>{{$standard->june}}</td>
                                    <td>{{$standard->july}}</td>
                                    <td>{{$standard->august}}</td>
                                    <td>{{$standard->september}}</td>
                                    <td>{{$standard->october}}</td>
                                    <td>{{$standard->november}}</td>
                                    <td>{{$standard->december}}</td>
                                    <td>{{$standard->year}}</td>
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