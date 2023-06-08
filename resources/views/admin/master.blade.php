@include('admin.partials.head')

@php
    if (!auth()->check()) {
        return redirect()->route('getLogin');
    }
@endphp
</head>

<body class="crm_body_bg">

    @include('admin.partials.sidebar')


    @include('admin.partials.main')

    {{-- content --}}

    @if (Session::get('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Well done!</h4>

            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::get('error_level'))
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading"> {{ Session::get('error_level') }}! @if (session('login_failed_attempts'))
                    Số lần nhập sai: {{ session('login_failed_attempts') }}
                @endif
            </h4>
        </div>
    @endif

    @yield('content')
    @include('admin.partials.checkAdmin')
    {{-- end-content --}}
    @include('admin.partials.footer')


</body>

<!-- Mirrored from demo.dashboardpack.com/user-management-html/Layouts.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Aug 2022 17:54:23 GMT -->

</html>
