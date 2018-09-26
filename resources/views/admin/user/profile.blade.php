@extends('layouts.admin')
@section('title','User profile')
@section('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">User Profile</li>
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
              <h3 class="box-title">User Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="row">
    		<div class="col-md-12"><!--left col-->
           <ul class="list-group">
            <li class="list-group-item text-right"><span class="pull-left"><strong>Name</strong></span> {{Auth::user()->name}}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span>  {{Auth::user()->email}}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Registeration Date</strong></span>{{date("d-m-Y", strtotime(Auth::user()->created_at))}}</li>
            <!-- <li class="list-group-item text-right"><span class="pull-left"><strong>User image</strong></span>{{ Auth::User()->image }}</li> -->
          </ul> 
              <a href="/admin/{{Auth::user()->id}}/editprofile" class="btn btn-primary btn-flat">Edit Profile</a>

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
