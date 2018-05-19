<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url({{asset('img/background/user-info.jpg')}}) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{asset('img/profile/user_icon_default.png')}}" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{\App\User::initials(Auth::user())}}</a>
                <div class="dropdown-menu animated flipInY">
                    <a href="#" class="dropdown-item"><i class="ti-user"></i> Мои сотрудники</a>
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> Мой график</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Мой табель</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="ti-settings"></i> Настройки табеля</a>
                    <div class="dropdown-divider"></div>
                    <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Выход</a> </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="{{url('/')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Главная </span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('my.employee')}}" aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span class="hide-menu">Сотрудники</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('no.shows')}}" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Неявки</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('combination')}}" aria-expanded="false"><i class="mdi mdi-calendar-plus"></i><span class="hide-menu">Совмещения</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('dismissal')}}" aria-expanded="false"><i class="mdi mdi-delete-forever"></i><span class="hide-menu">Увольнения</span></a></li>
                <li class="nav-devider"></li>
                <li> <a class="waves-effect waves-dark" href="{{route('schedule')}}" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">График</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('timetable')}}" aria-expanded="false"><i class="mdi mdi-table-large"></i><span class="hide-menu">Табель</span></a></li>
                <li class="nav-devider"></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-printer"></i><span class="hide-menu">Печатные формы</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="javascript:void(0)">График</a></li>
                        <li><a href="javascript:void(0)">Табель</a></li>
                    </ul>
                </li>
                <li class="nav-devider"></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Настройки</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('settings.user')}}">Пользователи</a></li>
                        <li><a href="javascript:void(0)">Роли</a></li>
                        <li><a href="{{route('settings.holiday')}}">Праздничные дни</a></li>
                        <li><a href="{{route('settings.defaulttype')}}">Типы неявок</a></li>
                        <li><a href="{{route('settings.employee')}}">Сотрудники</a></li>
                        <li><a href="{{route('settings.position')}}">Должности</a></li>
                        <li><a href="{{route('settings.department')}}">Отделения</a></li>
                    </ul>
                </li>
                <li><br></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item--><a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item--><a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item--><a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>
