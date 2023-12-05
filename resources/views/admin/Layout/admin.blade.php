<!DOCTYPE html>
{{--@dd( app()->getLocale())--}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ \App\Models\Utility::settingdata('name')}} - @yield('title')</title>

    {{--Data table Css--}}
    <link rel="icon" href="{{ asset('image/'.\App\Models\Utility::settingdata('website_logo')) }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- General CSS Files -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{-- Sweet Alert Css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" integrity="sha512-gOQQLjHRpD3/SEOtalVq50iDn4opLVup2TF8c4QPI3/NmUPNZOk2FG0ihi8oCU/qYEsw4P6nuEZT2lAG0UNYaw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{-- Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    {{--    <!-- Template CSS -->--}}
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">

    {{-- Toaster Css --}}
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">

    {{-- Ajax Cdn file--}}
    <script src="{{asset('assets/js/ajax_jquery.min.js')}}"></script>

</head>

<body>

<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        {{-- Nav Bar --}}
        @include('admin.Layout.header')

        {{-- Sidebar--}}
        @include('admin.Layout.sidebar')

        {{-- content--}}
        <div class="container-fluid">
            @yield('content')
        </div>

        {{-- footer--}}
        @include('admin.Layout.footer')
    </div>
</div>

<!-- Start Model -->

<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header align-items-center">
                <div class="modal-title">
                    <h5 class="mb-0" id="modelCommanModelLabel"></h5>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">Close</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->
<script>

    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
        }
    toastr.success("{{Session::get('success')}}", 'Success !', {timeout: 12000});

    @endif
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
        }
    toastr.error("{{Session::get('error')}}", 'Error !', {timeout: 12000});

    @endif  @if(Session::has('update'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
        }
    toastr.success("{{Session::get('update')}}", 'Update !', {timeout: 12000});

    @endif  @if(Session::has('delete'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
        }
    toastr.error("{{Session::get('delete')}}", 'Delete !', {timeout: 12000});

    @endif

    $(document).ready(function () {
        // let table = new DataTable('#table');
        var empDataTable = $('#table').DataTable({
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'copy'
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1] // Column index which needs to export
                    }
                },
                {
                    extend: 'csv',
                },
                {
                    extend: 'excel',
                }
            ]

        });
    });

</script>

</body>
</html>
