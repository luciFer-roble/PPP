<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Practicas Pre-Profesionales</title>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
@include('layouts.navbar')

@include('layouts.sidebar')




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('layouts.contentTitle')
        <!-- Main content -->
        <div class="content">


                    @include('flash::message')

            @include('layouts.errors')
                    @yield('content')


        </div>
    <!-- /.content-wrapper -->
    </div>
    @include('layouts.sidebar2')


    @include('layouts.footer')
</div>
<script src="{{mix('js/vendor.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
{{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{--
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}
<script>
    $(document).ready(function() {
        $('#flash-overlay-modal').modal();
    });
    //$('#flash-overlay-modal').modal();
       $('div.alert').not('.alert-danger').delay(3000).fadeOut(350);

</script>
</body>
</html>