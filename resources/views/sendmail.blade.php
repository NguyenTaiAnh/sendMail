@extends('main')
@section('extra_js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    {{--    <script src="/vendor/js/plugin-multi-upload-file.js" type="text/javascript"></script>--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    {{--    <script src="/vendor/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>--}}
    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'description_ckeditor');
        });

    </script>
@stop
@section('body')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Send Mail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- general form elements -->
                    <div class="card card-primary" style="width: 100%">
                        <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form enctype="multipart/form-data" role="form" method="post" action="{{route('mail.store')}}" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" name="filepath"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="description_ckeditor" name="content" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

