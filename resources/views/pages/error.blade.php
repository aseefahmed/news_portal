<!doctype html>
<html lang="en" class="fixed">


<!-- Mirrored from myiideveloper.com/helsinki/helsinki-green/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Feb 2017 08:56:36 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>NRB Express</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link href="{{ asset('public/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/css/datetimepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/plugins/bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet" type="text/css">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('public/css/toaster.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">



    <style>
        input.submitted.ng-invalid
        {
            border:1px solid #f00;
        }
        select.submitted.ng-invalid
        {
            border:1px solid #f00;
        }
    </style>
</head>

<body ng-app="myApp">
<div class="wrap">
    <div class="page-body">
        <div class="row animated bounce">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel mt-xlg">
                    <div class="panel-content">
                        <h1 class="error-number">404</h1>
                        <h2 class="error-name">Invalid Request</h2>
                        <p class="error-text">Sorry, something went wrong.
                            <br/>Please wait a moment and try again or use one of the options below</p>
                        <div class="row mt-xlg">
                             <div class="col-sm-6  col-sm-offset-3">
                                <a href="{{ url('login') }}" class="btn btn-sm btn-primary btn-block">Login Now</a>
                                <a href="{{ url('forget-password') }}" class="btn btn-sm btn-lighter-2 btn-block mb-xlg">Recover Password Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script src="{{ asset('public/js/all.js') }}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" type="text/javascript"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('public/js/toaster.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/plugins/angular/angular.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/controller.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/datetimepicker.js') }}" type="text/javascript"></script>

{{--<script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('public/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>--}}

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js">
</script>
{{--<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js">
</script>--}}

</body>

<!-- Mirrored from pages.revox.io/dashboard/latest/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Jan 2017 04:46:22 GMT -->
</html>