@extends('layouts.admin')
@section('title','Customers')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customers
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customers</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="cmsDataTable" class="table table-striped table-bordered">
                <thead class="alert alert-info">
                <tr>
                  <th>CMS Page Name</th>
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
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
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
        $('#cmsDataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "searching":true,
            "ajax":{
                     "url": "/en/getCustomerData",
                     "dataType": "json",
                     "type": "post",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                {"data": "srNo" ,sortable:true},
                {"data": "name",sortable:true },
                {"data": "email",sortable:true },
                {"data": "mobile",sortable:true},
                {"data": "registeration",sortable:true},
                 {
                "data": "status",sortable:false,
                "render": function(status) {
                  if (status==1) {
                 return "<a href='' class='label label-success'>Active</a>";
                } else {
                  return "<a href='' class='label label-danger'>Deactive</a>";
                } 

                }
                },
                {"data": "id",sortable:false,
                "render": function(id) {
                 return "<a href='/admin/edit/"+id+"/customer'><i class='fa fa-edit'></i></a>|<a ><i</a>|<a href='/admin/customer/delete/"+id+"' class='fa fa-trash'></a>";
                }
              },
            ]    
        });
    });
</script>

  @endsection

