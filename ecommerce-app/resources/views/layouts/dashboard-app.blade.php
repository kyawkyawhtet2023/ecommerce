

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <style>
        :root{
            --primary:{{$profiles->primary}} ;
            --secondary:{{$profiles->secondary}};
            --name:{{$profiles->name_color}};
            --title:{{$profiles->title_color}};
            --price:{{$profiles->price_color}};
            --body:{{$profiles->body_color}};
            --night:white;
            --box : 1px 5px 5px 1px rgba(0, 0, 0, 0.5); 
        }
    </style>
    @vite('resources/css/app/dashboard/index.css')
</head>
<body>
    <header>
        @include('partials.dashboard-header') 
    </header>
    

    <main>
        <x-sidebar />
        
        <div>
            @if(session('success'))
            <div class="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert-danger " id="error-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
            @yield('content')
        </div>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function previewImage(event, imageId) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById(imageId);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        }


        document.addEventListener('DOMContentLoaded', function () {
    
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 4000);
    }

    
    // const errorAlert = document.getElementById('error-alert');
    // if (errorAlert) {
    //     setTimeout(() => {
    //         errorAlert.style.display = 'none'; 
    //     }, 5000);
    // }
});

    </script>
</body>
</html>
