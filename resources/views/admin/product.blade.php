<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   @include('admin.css')
   <style type="text/css">
    .div_center{
     text-align: center;
     padding-top: 40px;}
    .font_size{
        font-size: 40px;
     padding-bottom: 40px;
    }
    .text_color{
    color: black;
    padding-bottom: 20px;
   }
   label{
    display: inline-block;
    width: 200px;
   }
   .div_design{
    padding-bottom: 15px;
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
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div >
                    <h1 class="font_size">Add Product</h1>
                    <form action="{{url('add_product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div >
                        <label>Product Title</label>
                        <input type="text" class="text_color" name="title" placeholder="write a title" required="">
                    </div>
                    <div >
                        <label>Product Description</label>
                        <input type="text" class="text_color" name="description" placeholder="write a desc" required="">
                    </div>
                    <div >
                        <label>Product Price</label>
                        <input type="number" class="text_color" name="price" placeholder="write a price" required="">
                    </div>
                    <div >
                        <label>Product Quantity</label>
                        <input type="number" min="0" class="text_color" name="quantity" placeholder="write a quantity" required="">
                    </div>
                    <div >
                        <label>Discount price</label>
                        <input type="number" class="text_color" name="dis_price" placeholder="write a price" >
                    </div>
                    <div >
                        <label >Product Category</label>

                        <select class="text_color" name="category" >
                            <option value="" selected="">Add a category here</option>
                            @foreach ($category as $cate)
                            <option value="{{$cate->category_name}}" >{{$cate->category_name}}</option>

                                
                            @endforeach
                        </select>
                    </div >
                    <div>
                        <label >Product Image</label>
                        <input type="file" name="image" required="">
                       
                    </div>
                    <div>
                        <input type="submit" value="add product" class="btn btn-primary">
                    </div>
                    <form>

                </div>
            </div>
        </div>        
    <!-- container-scroller -->

    <!-- plugins:js -->
   @include('admin.script')
  </body>
</html>