<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Banco de Contemplados') }}{{$titulo}}</title>
        <link rel="stylesheet" href="{{assets('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/morris.js/morris.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{assets('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/datatables.net-bs/css/dataTables.buttons.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/datatables.net-bs/css/dataTables.buttons.bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('node_modules/sweetalert2/dist/sweetalert2.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/select2/dist/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{assets('bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
        <link rel="stylesheet" href="{{assets('dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{assets('dist/css/skins/skin-blue.min.css')}}">
        <link rel="stylesheet" href="{{assets('plugins/iCheck/all.css')}}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        {{--  <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />  --}}
        <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/select/1.2.6/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('bower_components/toastr/toastr.css')}}" rel="stylesheet">
        <link href="{{assets('css/commom.css')}}" rel="stylesheet">
        <link href="{{assets('css/backend/app.css')}}" rel="stylesheet">
        <script src="{{assets('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{assets('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
      var routes = {
        backend:{
          ajax:{
            upload: '{{route('backend.ajax.upload')}}',
            delete: '{{route('backend.ajax.delete')}}',
            load: '{{route('backend.ajax.load')}}',
          }
        }
      }
    </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('backend.shared.menu')
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Versão</b> 1.0.0
                </div>
                <strong>Copyright &copy; {{date('Y')}} <a href="http://www.voxdigital.com.br" target="_new">Vox Digital</a>.</strong> Todos os direitos reservados.
            </footer>
        </div>
    </body>
</html>
<script src="{{assets('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{assets('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{assets('bower_components/morris.js/morris.min.js')}}"></script>
<script src="{{assets('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<script src="{{assets('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{assets('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{assets('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{assets('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{assets('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{assets('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{assets('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{assets('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{assets('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{assets('dist/js/adminlte.min.js')}}"></script>
<script src="{{assets('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{assets('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{assets('bower_components/datatables.net-bs/js/dataTables.buttons.min.js')}}"></script>
<script src="{{assets('bower_components/datatables.net-bs/js/dataTables.buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{assets('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{assets('bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
<script src="{{assets('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{assets('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{assets('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{assets('plugins/input-mask/jquery.inputmask.numeric.extensions.js')}}"></script>
<script src="{{assets('plugins/input-mask/jquery.inputmask.phone.extensions.js')}}"></script>
<script src="{{assets('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('bower_components/toastr/toastr.js')}}"></script>
<script src="{{assets('js/backend/mask.js')}}"></script>
<script src="{{assets('js/backend/app.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
{{--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/froala_editor.pkgd.min.js?{{rand(0, 99999999999999999)}}"></script>  --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/js/froala_editor.pkgd.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/languages/pt_br.js?{{rand(0, 99999999999999999)}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/plugins/image.min.js?{{rand(0, 99999999999999999)}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/plugins/image_manager.min.js?{{rand(0, 99999999999999999)}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/third_party/image_aviary.min.js?{{rand(0, 99999999999999999)}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>
