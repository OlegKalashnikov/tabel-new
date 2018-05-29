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
            <h3 class="text-themecolor">Создание нормы</h3>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{route('standard.store')}}" class="form-material">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="name" value="{{ old('name') }}" placeholder="Название нормы">
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
                            <div class="form-group">
                                <select class="select2" name="category_id" style="width: 100%">
                                    <option value="">Выберите категорию</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="jan" value="{{ old('jan') }}" placeholder="Норма в январе">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="feb" value="{{ old('feb') }}" placeholder="Норма в феврале">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="mar" value="{{ old('mar') }}" placeholder="Норма в марте">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="apr" value="{{ old('apr') }}" placeholder="Норма в апреле">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="may" value="{{ old('may') }}" placeholder="Норма в мае">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="jun" value="{{ old('jun') }}" placeholder="Норма в июне">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="jul" value="{{ old('jul') }}" placeholder="Норма в июле">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="aug" value="{{ old('aug') }}" placeholder="Норма в августе">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="sep" value="{{ old('sep') }}" placeholder="Норма в сентябре">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="oct" value="{{ old('oct') }}" placeholder="Норма в октябре">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="nov" value="{{ old('nov') }}" placeholder="Норма в ноябре">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-line" name="dec" value="{{ old('dec') }}" placeholder="Норма в декабре">
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Создать</button>
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