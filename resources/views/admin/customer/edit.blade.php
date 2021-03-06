@extends('layouts.admin')
@section('title','Edit Customer')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Customer
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Customer</a></li>
        <li class="active">Edit Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Customer Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              {!! Form::open(['url' => '/update/customer','method' => 'post']) !!}

                   {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $customer->id}}">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $customer->name }}" placeholder="Enter Name">
                </div>
                </div>

                 <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" value="{{$customer->email }}" name="email" placeholder="Enter email" required>
                </div>
                </div>

                  <div class="box-body">
                 <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="{{$customer->mobile }}" name="mobile" placeholder="Enter mobile">
                </div>
                </div>
                 
                  <div class="box-body">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Registeration Date</label>
                  <input type="date" class="form-control" id="registerationDate" value="{{$customer->registeration_date }}" name="registerationDate">
                </div>
                </div>
                 
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              {!! Form::close() !!}
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
      
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
@endsection
