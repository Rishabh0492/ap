@extends('layouts.admin')
@section('title','Dynamic Email | Edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dynamic Email<br>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">View</a></li>
      </ol>
    </section>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
$from = "company@company.com";
$to = "user@user.com";
$body_text = "Your email has been successfully verified...";
$banner_image_subject = "account_verified";
$final_message = build_email_template($banner_image_subject, $body_text);
send_email($to, $from, "You email has been verified", $final_message);
</body>
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
@endsection