<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('login_user/css/style.css') }}">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>@yield('title')</header>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert" style="list-style:none">
                        <i class="ti-alert"></i>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                @if (Session::get('success'))
                    <div class="alert alert-success" role="alert" style="list-style:none">
                        <i class="ti-alert"></i>
                        <p style="color: green">{!! Session::get('success') !!} </p>
                    </div>
                @endif


                @if (Session::get('error'))
                    <div class="alert alert-danger">
                        <ul style="list-style:none">
                            <li style="color: red">{!! Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>

    </section>

    <!-- JavaScript -->
    <script src="{{ asset('login_user/js/script.js') }}"></script>
</body>

</html>
