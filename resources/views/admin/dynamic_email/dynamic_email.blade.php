@extends('layouts.admin')
@section('title','Mail Templates')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mail Templates<br>
        <a href='/admin/email-templates/create' class='btn btn-primary'>Add</a> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master</a></li>
        <li><a href="#">Mail Templates</a></li>
      </ol>
    </section>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
               @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="customerDataTable" class="table table-striped table-bordered">
                <thead class="alert alert-info">
                <tr>
                  <th>Sr.No</th>
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Status</th>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css">
<script type="text/javascript">
 $(document).ready(function () {
    var customerTable =$('#customerDataTable').DataTable({
           "pagingType": "full_numbers",
            "processing": true,
            "serverSide": true,
            "searching":true,
            "ajax":{
                     "url": "/en/getDynamicEmailData",
                     "dataType": "json",
                     "type": "post",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                {"data": "srNo" ,sortable:false},
                {"data": "to",sortable:true },
                {"data": "subject",sortable:true },
                {
                "data": "status",sortable:true,
                "render": function(status) {
                  if (status==1) {
                 return "<a href='' class='label label-success'>Active</a>";
                  } else {
                  return "<a href='' class='label label-danger'>Deactive</a>";
                         } 

                  }
                },
            {
                  "data": "id",sortable:false,
                "render": function(id) {
                 return "<a href='/admin/email-templates/"+id+"/edit' class='fa fa-edit'></a>| <a href='/admin/template/delete/"+id+"' class='fa fa-trash'></a> ";
                }
            }
            ]    
        });
         
    });
</script>
@endSection