

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <style>
        :root{
            --primary:{{$profiles->primary}} ;
            --secondary:{{$profiles->secondary}};
            --name:{{$profiles->name_color}};
            --title:{{$profiles->title_color}};
            --price:{{$profiles->price_color}};
            --body:{{$profiles->body_color}};
            --night:#121212;
            --box : 1px 5px 5px 1px rgba(0, 0, 0, 0.5); 
        }
    </style>
</head>
<body>
    <header>
        @include('partials.user-header') 
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('partials.user-footer') 
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
