<!DOCTYPE html>
<html lang="tr">

<head>
    {{-- <meta charset="utf-8"> --}}
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=iso-859-1"> --}}
    {{-- <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-9"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/popper.min.js') }}"></script>

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.all.min.css') }}">   

</head>

<body>

    <div class="wrapper">
        
        @include('layouts.sidebar')
        

        <div id="content">

            @include('layouts.navbar')

            <section>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Font Awesome JS -->
    <script src="{{ asset('js/font-awesome.all.min.js') }}"></script>   

    <script>
        $(document).ready(function () {
            alertBox = document.getElementById('alert-box');
            if (alertBox !== null) {
                setTimeout(() => { $('#alert-box').slideUp('slow'); }, 5000);                
            }

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    @stack('scripts')
</body>

</html>