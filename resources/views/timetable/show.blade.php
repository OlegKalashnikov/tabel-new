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
                    <h4 class="card-title">{{\App\Schedule::department_name($department_id)}}</h4>
                    <h6 class="card-subtitle">
                        <a href="{{route('timetable')}}" class="btn btn-outline-success"><i class="fa fa-arrow-left"></i> Назад</a>
                        <a href="" class="btn btn-outline-success"><i class="fa fa-print"></i> Распечатать</a>
                    </h6>
                    <div class="table-responsive">
                        <table id="schedules" class="table editable-table table-bordered table-striped m-b-0">
                            <thead>
                            <tr>
                                <th rowspan="2">Сотрудник</th>
                                <th rowspan="2">Должность</th>
                                <th colspan="{{$count_day}}">Отметки о явках и неявках на работу по числам месяца</th>
                                <th colspan="7">Итого отработано за месяц</th>
                                <th colspan="3">Совмещения</th>
                            </tr>
                            <tr>
                                @for($ptr=1; $ptr<=$count_day; $ptr++ )
                                    <th @if(\App\Timetable::ifWeekday($month, $ptr)) style="color: red" @endif>{{$ptr}}</th>
                                @endfor
                                <th>Дни явок</th>
                                <th>Отработано часов</th>
                                <th>Ночные</th>
                                <th>Ночные ургентные</th>
                                <th>Выходные</th>
                                <th>Праздничные</th>
                                <th>Вредность</th>
                                <th>%</th>
                                <th>Отработано часов</th>
                                <th>Период работы</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data_schedules as $key => $data_schedule)
                                    <tr>
                                        <td>{{\App\Schedule::schedule_my_employee($key)}}</td>
                                        <td>{{\App\Schedule::schedule_my_employee_position($key)}}</td>
                                            <?php $ptr = 1;?>
                                            @foreach($data_schedules[$key] as $date => $value)
                                                <td class="edit number_of_hours {{$date}} {{$key}}" @if(\App\Timetable::ifWeekday($month, $ptr)) style="color: red" @endif>{{$value[1]}}</td>
                                                <?php $ptr++;?>
                                            @endforeach
                                        <td>{{\App\Timetable::quantity($key, $department_id, $month)}}</td>
                                        <td>{{\App\Timetable::worked_out($key, $department_id, $month)}}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>{{\App\Timetable::combination($key, $month, 1)}}</td>
                                        <td>{{\App\Timetable::combination($key, $month, 2)}}</td>
                                        <td>{{\App\Timetable::combination($key, $month, 3)}}</td>
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
                    url:"{{route('timetable.update.ajax')}}",
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