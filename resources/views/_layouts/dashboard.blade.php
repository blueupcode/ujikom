<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/solid.min.css" integrity="sha512-twSH00i0q49z+tz89pCmLfnioJy8/8jxR8iJ3ckoOYmjA6tPGJV+28VNqa79Ra2e/Pzyifd2ngh/51InxdC9lw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" integrity="sha512-1OkRbjg36JUuckLBPoOyXvbr9tWEQ/w0dNi5mGKqrbHQVLXBTYRhRjabpkxRfqDfSTy0MtaafzJYrIcCqQeAaQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>{{ $page_title ?? 'Untitled' }} - {{ env('APP_NAME', 'My App') }}</title>
    </head>
    <body class="theme-light aside-active aside-desktop-maximized aside-mobile-minimized">
        <div class="holder">
            @include('_partials.layout.aside')
            <div class="wrapper">
                @include('_partials.layout.header')
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @yield('modal')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="/js/app.js" ></script>
    </body>
</html>