<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap">
    <title>{{ $page_title ?? 'Untitled' }}</title>
</head>
<body class="theme-light">
    @yield('content')
    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            window.location.href = '/'
        };
    </script>
</body>
</html>