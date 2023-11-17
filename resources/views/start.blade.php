<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Внутренний сайт ГКБ №34</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="asset{{'img/favicon.png'}}" rel="icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/time.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('js/datatable/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/daterangepicker/daterangepicker.css') }}" rel="stylesheet">


</head>

<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
        <div class="d-flex align-items-center">
            <i class="bi bi-phone"></i> Отдел компьютерного обеспечения: Тел. 354-64-20. внутр. 251 - по вопросам МИС;
            333 - по работе ПК; 378 - электронные подписи
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<section id="main">
    <header id="header" class="fixed-top">

        <div class="container d-flex align-items-center">
            <div class="logo me-auto">
                <a href="/login" class="logo me-auto"><img src="{{ url('storage/img/heart.png') }}" alt=""/></a>
            </div>

            <div class="container d-flex align-items-center">
                <div class="logo me-auto">
                    <a href="/" class="logo me-auto"><img src="{{ url('storage/ico/unnamed.jpg') }}" alt=""/></a>
                </div>


                <div class="row">
                    <nav id="navbar" class="navbar order-last order-lg-0">
                        <ul>

                            <li><a class="nav-link scrollto" href="{{url('page/mis')}}">МИС НСО</a></li>
                            <li><a class="nav-link scrollto" href="{{url('page/eln')}}">ЭЛН</a></li>
                            <li><a class="nav-link scrollto" href="{{url('page/poly')}}">Поликлиника</a></li>
                            <li><a class="nav-link scrollto" href="{{url('page/prikaz')}}">Приказы/Инструкции</a></li>
                            <li><a class="nav-link scrollto" href="{{url('sec/?id=sec')}}">IT отдел</a></li>
                            <li><a class="nav-link scrollto" href="{{url('page/blank')}}">Бланки</a></li>
                            <li><a class="nav-link scrollto" href="{{url('page/video')}}">Видео</a></li>
                            <li><a class="nav-link scrollto" href="{{url('page/telemed')}}">Телемедицина</a></li>
                            <li><a class="nav-link scrollto" href="{{url('kadr/?id=ok')}}">Кадры</a></li>
                            <li><a class="nav-link scrollto " href="{{url('apt/?id=apt')}}">Аптека</a></li>
                            <li><a class="nav-link scrollto " href="{{url('phone')}}">Телефоны</a></li>
                            <li><a class="nav-link scrollto" href="{{url('about')}}">О сайте</a></li>
                            <li>
                                <watch class="container-fluid ojenymode text-center"
                                       style="margin-left: 15px; margin-top: 3px;">
                                    <time id="date" class="clocktext"></time>
                                    <time id="time" class="clocktext"><span> </span></time>
                                </watch>
                            </li>
                        </ul>

                    </nav><!-- .navbar -->

                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->name=='mgr')
                        <div class="row ml-5">
                            <div class="dropdown">
                                <a class="btn btn-danger btn-sm border-danger" href="#" role="button"
                                   id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Компы
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="/pc">Список ПК</a></li>
                                    <li><a class="dropdown-item" href="javascript:void 0"
                                           onclick="$('#logout-form').submit();">Выход</a></li>
                                </ul>
                            </div>
                        </div>

                    @endif

                    @if(\Illuminate\Support\Facades\Auth::user()->name=='itgroup')
                        <div class="row ml-5">
                            <div class="dropdown">
                                <a class="btn btn-danger btn-sm border-danger" href="#" role="button"
                                   id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    IT zone
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="/pc">Список ПК</a></li>
                                    <!--		<li><a class="dropdown-item" href="/org">Оргтехника</a></li> -->
                                    <li><a class="dropdown-item" href="/cartridge/list">Картриджи</a></li>
                                    <li><a class="dropdown-item" href="/adm">Админка сайта</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void 0"
                                           onclick="$('#logout-form').submit();">Выход</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </header>

</section>

<section id="cta" style="margin-top: 10px;">

    <div align="center" class=@yield('divtype')>

        @yield('content')

    </div>

</section>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<script src="{{ asset('js/jquery-3.7.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/myengine.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/findpc.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/datatable/dataTables.ru.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/daterangepicker/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/my_datatable.js')}}" type="text/javascript"></script>


<script type="text/javascript" src="{{asset('/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    const editor = document.getElementById('editor1')
    if (editor) {
        CKEDITOR.replace('editor1');
    }

</script>

</body>

</html>
