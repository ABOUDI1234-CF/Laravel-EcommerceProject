<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Required meta tags -->
   @include('admin.css')
   <style type="text/css">
    label{
        display: inline-block;
        width: 300px;
        font-size: 15px;
        font-weight: bold;
    }
</style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
      <div class="main-panel">
        <div class="content-wrapper">
            <h1 style="font-size: 25px; text-align:center;">send email to {{$order->email}}</h1>
            <form method="POST" action="{{url('send_user_email',$order->id)}}">
                @csrf
            <div style="padding-left: 35%; padding-top:30px;">
                <label>Email Greeting</label>
                <input style="color: black;" type="text" name="greeting">
            </div>
            <div style="padding-left: 35%; padding-top:30px;">
                <label>Email FirstLine</label>
                <input style="color: black;" type="text" name="firstline">
            </div>
            <div style="padding-left: 35%; padding-top:30px;">
                <label>Email Body</label>
                <input style="color: black;" type="text" name="body">
            </div>
            <div style="padding-left: 35%; padding-top:30px;">
                <label>Email Button name</label>
                <input style="color: black;" type="text" name="button">
            </div>
            <div style="padding-left: 35%; padding-top:30px;">
                <label>Email Url</label>
                <input style="color: black;" type="text" name="url">
            </div>
            <div style="padding-left: 35%; padding-top:30px;">
                <label>Email Last Line</label>
                <input style="color: black;" type="text" name="lastline">
            </div>
            <div style="padding-left: 35%; padding-top:30px;">
                <input  type="submit" value="Send Email" class="btn btn-primary">
            </div>
            </form>
        </div>
      </div>      
        <!-- partial -->
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
  </body>
</html>