<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    {{-- @stack('style') --}}
    <link rel="stylesheet" href="/css/index.css">

    <title>{{ $title }}</title>
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-light shadow-sm py-4">
        <div class="container">
            <a href="/" class="navbar-brand">ONPraktik</a>
            @yield('navbar')
        </div>
    </nav>

    @yield('container')



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/typeit@8.4.0/dist/index.umd.js"></script>
    @stack('script')

</body>
</html>