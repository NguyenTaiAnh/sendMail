@extends('main')
@section('extra_js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            var oTable = $('#user').DataTable({
                processing:true,
                serverSide:true,
                pageLength:10,
                sort: false,
                searching: true,
                ajax: {
                    url: '{{route('users.dataTable')}}',
                    data: function (d) {
                        d.keyword = $('#keyword').val()
                        d.status = $('#status').val()
                    }
                },
                columns: [
                    {data:'name', searchable:false},
                    {data:'email', searchable: true},
                    {data:'password_user', searchable: true},
                    {data:'created_at', searchable:false},
                    // {data:'action', searchable:false},
                ]
            })
            // $(document).on('click', '.category-edit', function () {
            //     let id = $(this).attr('data-id');
            //     $.ajax({
            //         method: 'get',
            //         url: '/admin/categories/show/' + id,
            //         success:function (data, statusTxt, xhr) {
            //             if (xhr.status === 200) {
            //                 $('.p-id').val(data.id)
            //                 $('.p-name').val(data.name)
            //                 $('.p-description').val(data.description)
            //             }
            //         }
            //     })
            // });
            // $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            //     $(".alert").slideUp(500);
            // });
        });
    </script>
@stop
@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Emails</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table style="width: 100%;" class="data-table table table-bordered table-hover" id="user">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Emails</th>
                                        <th>Password</th>
                                        <th>CreateAt</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
