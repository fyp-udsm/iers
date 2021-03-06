<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IERS - {{ $data[0]->course_code }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/all.css") }}">
    <!-- DataTables -->
    <link rel="stylesheet"
          href="{{ asset ("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css") }}">
    <!-- custom style -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/custom.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css") }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css") }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Header -->
@include('header')

<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @include('heading')
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">assessment form</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if(session()->has('message_danger'))
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <i class="fa fa-ban"></i> {{ session()->get('message_danger') }}
                        </div>
                    @endif
                    <div class="box">
                        <div class="box-body">
                            <div class="box box-default">
                                <div class="box-header with-border" style="text-align: center;">
                                    <h3 class="box-title">STUDENT COURSE EVALUATION FORM</h3>
                                </div>
                                <div class="box-body">
                                    <strong>Instructions:</strong> This form aims at capturing feedback from you
                                    regarding the quality of
                                    instruction you have received in this course. The information is confidential and
                                    will not be associated with your identity. Your honesty and constructive opinions
                                    will be useful in improving the delivery and quality of the course. Please take your
                                    time and carefully provide information on the various issues raised below.
                                </div>
                            </div>
                            <div class="box box-default">
                                <div class="box-body">
                                    COURSE CODE: {{ $data[0]->course_code }}<br>
                                    COURSE TITLE: {{ $data[0]->course_name }}<br>
                                    COLLEGE: {{ $data[0]->college_short_name }}<br>
                                    INSTRUCTOR'S FULL
                                    NAME: {{ $data[0]->name." ".$data[0]->middlename." ".$data[0]->lastname }}
                                </div>
                            </div>
                            <form method="post">
                                {{ csrf_field() }}
                                <table class="table table-bordered">
                                    <tr>
                                        <th>5=Excellent; 4=Very Good; 3=Satisfactory; 2=Poor; 1=Very Poor</th>
                                        <th>
                                            <div class="col-sm-1">5</div>
                                            <div class="col-sm-1">4</div>
                                            <div class="col-sm-1">3</div>
                                            <div class="col-sm-1">2</div>
                                            <div class="col-sm-1">1</div>
                                        </th>
                                    </tr>
                                    @foreach($data as $value)
                                        @if( Auth::User()->hasRole(['Student']) )
                                            <tr>
                                                <div class="form-group">
                                                    <input name="course_id" type="hidden"
                                                           value="{{ $data[0]->course_id }}">
                                                </div>
                                                <div class="form-group">
                                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                                </div>
                                                <td>{{ $value->content }}</td>
                                                <td>

                                                    <div class="form-group">
                                                        <input name="question_id['{{$value->question_id}}']"
                                                               type="hidden"
                                                               value="{{$value->question_id}}">
                                                    </div>
                                                    <div class="control-group">
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="5"/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="4"/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="3"/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="2"/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="1"/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @elseif(Auth::User()->hasRole(['Admin']) or Auth::User()->hasRole(['Instructor']))
                                            <tr>
                                                <div class="form-group">
                                                    <input name="course_id" type="hidden"
                                                           value="{{ $data[0]->course_id }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}"
                                                           disabled>
                                                </div>
                                                <td>{{ $value->content }}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input name="question_id['{{$value->question_id}}']"
                                                               type="hidden"
                                                               value="{{$value->question_id}}" disabled>
                                                    </div>
                                                    <div class="control-group">
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="5" disabled/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="4" disabled/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="3" disabled/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="2" disabled/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label class="control control--radio" style="width: 60px;">
                                                                <input type="radio"
                                                                       name="answer['{{$value->question_id}}']"
                                                                       value="1" disabled/>
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                                @if( Auth::User()->hasRole(['Student']) )
                                    <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button>
                                @elseif( Auth::User()->hasRole(['Admin']) or Auth::User()->hasRole(['Instructor']))
                                @endif
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('footer')
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jQuery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- DataTables -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- SlimScroll -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/fastclick/fastclick.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ("/bower_components/AdminLTE/dist/js/demo.js") }}"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
</script>
</body>
</html>
