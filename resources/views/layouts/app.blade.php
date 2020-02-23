<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"
            defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">
</head>
<body id="app">

<header class="uk-container uk-container-expand uk-background-primary uk-light">
    <nav uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo"
               href="#">
                {{ config("app.name") }}
            </a>

            <ul class="uk-navbar-nav">
                <li class="uk-active">
                    <a href="#">
                        <span class="uk-margin-small-right uk-icon"
                              uk-icon="icon: home;"></span>
                        Menu 1
                    </a>
                </li>
                <li>
                    <a href="#"> Menu II</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="uk-grid-collapse uk-child-width-expand@s"
     uk-grid>

    <aside class="uk-width-1-6">
        <div class="uk-padding uk-height-viewport">
            <div>
                <ul class="uk-nav uk-nav-default">
                    <li>
                        <a href="#"> MASTER DATA</a>
                    </li>
                    <li class="{{ \Illuminate\Support\Facades\Route::is("obat.*") ? "uk-active" : "" }}  ">
                        <a href="{{ route("obat.index") }}">
                            <i class="fas fa-pills"></i>
                            Obat
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <article class="uk-width-expand uk-padding uk-dark">
        <div class="uk-card uk-card-default uk-card-body">
            @yield("content")
        </div>
    </article>
</main>


<script src="{{ asset("js/app.js") }}"></script>

@yield("footer-script")

</body>
</html>
