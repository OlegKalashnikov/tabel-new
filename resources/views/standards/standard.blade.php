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
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a href="#doctor" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Врачи</span></a></li>
                        <li class="nav-item"><a href="#hospital" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Врачи стационара</span></a></li>
                        <li class="nav-item"><a href="#dentist" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Врачи стоматологи</span></a></li>
                        <li class="nav-item"><a href="#average" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Средний медперсонал</span></a></li>
                        <li class="nav-item"><a href="#nurses" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Санитарки</span></a></li>
                        <li class="nav-item"><a href="#quak" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">КВОПы</span></a></li>
                        <li class="nav-item"><a href="#medicaldispensary" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Врачебная амбулатория</span></a></li>
                        <li class="nav-item"><a href="#healthcenter" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Здравпункт</span></a></li>
                        <li class="nav-item"><a href="#cdl" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">КДЛ</span></a></li>
                        <li class="nav-item"><a href="#infectiousdiseaseroom" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Инфекционный кабинет</span></a></li>
                        <li class="nav-item"><a href="#physio" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Физио - средний медперсонал</span></a></li>
                        <li class="nav-item"><a href="#treatmentroom" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Процедурный кабинет</span></a></li>
                        <li class="nav-item"><a href="#roentgen" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Рентген</span></a></li>
                        <li class="nav-item"><a href="#juniormedicalstaff" class="nav-link " data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Младший медперссонал</span></a></li>
                        <li class="nav-item"><a href="#ahh" class="nav-link active" data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">АХЧ</span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active" id="ahh" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsAhh as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="doctor" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsDoctor as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="treatmentroom" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsTreatmentroom as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="average" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsAverage as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="physio" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsPhysio as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="hospital" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsHospital as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="dentist" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsDentist as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="nurses" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsNurses as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="quak" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsQuak as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="medicaldispensary" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsMedicaldispensary as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="healthcenter" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsHealthcenter as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="cdl" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsCdl as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="infectiousdiseaseroom" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsInfectiousdiseaseroom as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="roentgen" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsRoentgen as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane p-20" id="juniormedicalstaff" role="tabpanel">
                            <div class="table-responsive m-t-40">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ставка</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($standardsJuniormedicalstaff as $standard)
                                        <tr>
                                            <td>{{$standard->name}}</td>
                                            <td>{{$standard->rate}}</td>
                                            <td @if($month == 1) style="color: red;" @endif>{{$standard->jan}}</td>
                                            <td @if($month == 2) style="color: red;" @endif>{{$standard->feb}}</td>
                                            <td @if($month == 3) style="color: red;" @endif>{{$standard->mar}}</td>
                                            <td @if($month == 4) style="color: red;" @endif>{{$standard->apr}}</td>
                                            <td @if($month == 5) style="color: red;" @endif>{{$standard->may}}</td>
                                            <td @if($month == 6) style="color: red;" @endif>{{$standard->jun}}</td>
                                            <td @if($month == 7) style="color: red;" @endif>{{$standard->jul}}</td>
                                            <td @if($month == 8) style="color: red;" @endif>{{$standard->aug}}</td>
                                            <td @if($month == 9) style="color: red;" @endif>{{$standard->sep}}</td>
                                            <td @if($month == 10) style="color: red;" @endif>{{$standard->oct}}</td>
                                            <td @if($month == 11) style="color: red;" @endif>{{$standard->nov}}</td>
                                            <td @if($month == 12) style="color: red;" @endif>{{$standard->dec}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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