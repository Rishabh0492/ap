@extends('layouts.admin')
@section('title','Users')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       All Admin Users<br>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">All Users</a></li>
      </ol>
    </section>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="customerDataTable" class="table table-striped table-bordered">
                <thead class="alert alert-info">
                <tr>
                  <th>Sr.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css">  
<script>
 $(document).ready(function () {
        $('#customerDataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "searching":true,
            "ajax":{
                     "url": "/en/getRegisterdUser",
                     "dataType": "json",
                     "type": "post",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                {"data": "id" ,sortable:true},
                {"data": "name",sortable:true },
                {"data": "email",sortable:true },
                {"data": "id",sortable:false,
                "render": function(id) {
                 if ({{ Auth::user()->id }} == id) {
                 return "<i class='fa fa-circle text-success'></i>|<a href='/admin/{{Auth::user()->id}}/editprofile' class='fa fa-edit btn-flat'></a>|<a href='/admin/user/delete/"+id+"' class='fa fa-trash'></a>";
                } else{
                 return "<a href='/admin/user/delete/"+id+"' class='fa fa-trash'></a>";

                }
              }
              }
            ]    
        });
    });
</script>
@endSection