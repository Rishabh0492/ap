@extends('layouts.admin')
@section('title','Dynamic Email | Edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dynamic Email<br>
        <a href='/admin/dynamic-emails/create' class='btn btn-primary'>Add</a> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dynamic Email</a></li>
      </ol>
    </section>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Email Template</h3>
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
                  <th>subject</th>
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
        $('#customerDataTable').DataTable({
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
                {"data": "id" ,sortable:true},
                {"data": "to",sortable:true },
                {"data": "subject",sortable:true },
            {
                  "data": "id",sortable:false,
                "render": function(id) {
                 return "<a href='/admin/dynamic-emails/"+id+"/edit' class='fa fa-edit'></a>| <a href='/admin/template/delete/"+id+"' class='fa fa-trash'></a> ";
                }
            }
            ]    
        });
    });
</script>
@endSection