@extends('layouts.app')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-9 col-8 align-self-center">
            <h3 class="text-themecolor">Список графиков</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Графики</li>
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
                    <h4 class="card-title">{{\App\Schedule::department_name($department_id)}}</h4>
                    <div class="table-responsive">
                        <table id="schedules" class="table editable-table table-bordered table-striped m-b-0">
                            <thead>
                            <tr>
                                <th rowspan="3">Сотрудник</th>
                                <th rowspan="3">Должность</th>
                                <th colspan="5">Период</th>

                            </tr>
                            <tr>
                                @for($ptr=1; $ptr<=$count_day; $ptr++ )
                                    <th colspan="2">{{$ptr}}</th>
                                @endfor
                            </tr>
                            <tr>
                                @for($ptr=1; $ptr<=$count_day; $ptr++ )
                                    <th>Начало рабочего дня</th>
                                    <th>Конец рабочего дня</th>
                                @endfor
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data_schedules as $key => $data_schedule)
                                    <tr>
                                        <td>{{\App\Schedule::schedule_my_employee($key)}}</td>
                                        <td>{{\App\Schedule::schedule_my_employee_position($key)}}</td>
                                            @foreach($data_schedules[$key] as $date => $value)
                                                <td class="edit start_day {{$date}} {{$key}}">{{$value[0]}}</td>
                                                <td class="edit end_day {{$date}} {{$key}}">{{$value[1]}}</td>
                                            @endforeach
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
    <!-- Editable -->
    <script src="{{asset('plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/tiny-editable/mindmup-editabletable.js')}}"></script>
    <script src="{{asset('plugins/tiny-editable/numeric-input-example.js')}}"></script>
    {{--<script>--}}
        {{--$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();--}}
    {{--</script>--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function(){
            //при нажатии на ячейку таблицы с классом edit
            $('td.edit').click(function(){
            //находим input внутри элемента с классом ajax и вставляем вместо input его значение
            $('.ajax').html($('.ajax input').val());
            //удаляем все классы ajax
            $('.ajax').removeClass('ajax');
            //Нажатой ячейке присваиваем класс ajax
            $(this).addClass('ajax');
            //внутри ячейки создаём input и вставляем текст из ячейки в него
            $(this).html('<input id="editbox" size="'+ $(this).text().length+'" type="text" value="' + $(this).text() + '" />');
            //устанавливаем фокус на созданном элементе
            $('#editbox').focus();
            //определяем нажатие кнопки на клавиатуре
            $('td.edit').keydown(function(event){
            //получаем значение класса и разбиваем на массив
            //в итоге получаем такой массив - arr[0] = edit, arr[1] = наименование столбца, arr[2] = id строки
            arr = $(this).attr('class').split( " " );
            //проверяем какая была нажата клавиша и если была нажата клавиша Enter (код 13)
            if(event.which == 13){
                //получаем наименование таблицы, в которую будем вносить изменения
                var table = $('table').attr('id');
                //выполняем ajax запрос методом POST
                $.ajax({
                    type: "POST",
                    //в файл update_cell.php
                    url:"{{route('schedule.update.ajax')}}",
                    //создаём строку для отправки запроса
                    //value = введенное значение
                    //id = номер строки
                    //field = название столбца
                    //table = собственно название таблицы
                    data: "value="+$('.ajax input').val()+"&date="+arr[2]+"&field="+arr[1]+"&my_employee_id="+arr[3]+"&table="+table,
                    //при удачном выполнении скрипта, производим действия
                    success: function(data){
                        //находим input внутри элемента с классом ajax и вставляем вместо input его значение
                        $('.ajax').html($('.ajax input').val());
                        //удаялем класс ajax
                        $('.ajax').removeClass('ajax');
                    }});
                }});
            });
        });
        $('#editbox').on('blur',function(){
            $('.ajax').html($('.ajax input').val());
            $('.ajax').removeClass('ajax');
        });
    </script>
@endsection