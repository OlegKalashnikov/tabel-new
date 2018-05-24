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
            <h3 class="text-themecolor">Редактирование нормы</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                <li class="breadcrumb-item active">Настройки</li>
                <li class="breadcrumb-item"><a href="{{route('standard')}}">Нормы</a></li>
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
                        <form method="POST" action="{{route('standard.update', $standard)}}" class="form-material">
                            @csrf
                            {{method_field('patch')}}
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="name" value="{{ $standard->name }}" placeholder="Название нормы">
                            </div>
                            <div class="form-group">
                                <select class="select2" name="rate" style="width: 100%">
                                    <option value="">Выберите ставку</option>
                                    <option value="1" @if($standard->rate == 1) selected="selected" @endif>1</option>
                                    <option value="0.75" @if($standard->rate == 0.75) selected="selected" @endif>0.75</option>
                                    <option value="0.5" @if($standard->rate == 0.5) selected="selected" @endif>0.5</option>
                                    <option value="0.25" @if($standard->rate == 0.25) selected="selected" @endif>0.25</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <select class="select2" name="category_id" style="width: 100%">
                                    <option value="">Выберите категорию</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $standard->category_id) selected="selected" @endif>{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="january" value="{{ $standard->january }}" placeholder="Норма в январе">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="february" value="{{ $standard->february }}" placeholder="Норма в феврале">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="march" value="{{ $standard->march }}" placeholder="Норма в марте">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="april" value="{{ $standard->april }}" placeholder="Норма в апреле">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="may" value="{{ $standard->may }}" placeholder="Норма в мае">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="june" value="{{ $standard->june }}" placeholder="Норма в июне">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="july" value="{{ $standard->july }}" placeholder="Норма в июле">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="august" value="{{ $standard->august }}" placeholder="Норма в августе">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="september" value="{{ $standard->september }}" placeholder="Норма в сентябре">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="october" value="{{ $standard->october }}" placeholder="Норма в октябре">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="november" value="{{ $standard->november }}" placeholder="Норма в ноябре">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="december" value="{{ $standard->december }}" placeholder="Норма в декабре">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="year" value="{{ $standard->year }}" placeholder="Годовая норма">
                            </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Обновить</button>
                            <a href="{{route('standard')}}" class="btn btn-inverse waves-effect waves-light">Назад</a>
                        </form>
                    </div>
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