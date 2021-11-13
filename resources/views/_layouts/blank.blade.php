<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap">
        <title>{{ $page_title ?? 'Untitled' }} - {{ env('APP_NAME', 'My App') }}</title>
    </head>
    <body class="theme-light">
        <div class="holder">
            <div class="wrapper">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row no-gutters align-items-center justify-content-center h-100">
                            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('modal')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="/js/app.js" ></script>
    </body>
</html>