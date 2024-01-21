<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
          <div style="padding-left: 50px; padding-bottom:30px;">
            <form action="{{url('searchp')}}" method="GET">
              @csrf
              <input style="color: black; width:500px;" type="text" name="search" placeholder="search for something">
              <input type="submit" value="Search" class="btn btn-outline-primary">
            </form>
          </div>
       </div>
       <div class="row">
         @foreach ($products as $product)
             
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_details',$product->id)}}" class="option1">
                      Product Detail
                      </a>
                     <form action="{{url('add_cart',$product->id)}}" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-md-4">
                              <input type="number" min="1" value="1" name="quantity" style="width: 100px">

                           </div>
                        
                           <div class="col-md-4">
                              <input type="submit" value="Add To Cart">

                           </div>

                        </div>
                        
                        
                     </form>
                   </div>
                </div>
                <div class="img-box">
                   <img src="product/{{$product->image}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{$product->title}}
                   </h5>
                   @if($product->discount_price!=null)
                   <h6 style="color: red">
                      ${{$product->discount_price}}
                   </h6>
                   <h6 style="text-decoration: line-through; color:blue"  >
                      ${{$product->price}}
                   </h6>
                   @else

                   <h6 style="color: blue">
                      ${{$product->price}}
                   </h6>
                   @endif
                </div>
             </div>
          </div>
          @endforeach
                    {!!$products->appends(Request::all())->links()!!}


          
    </div>
 </section>
 <script>
   document.addEventListener("DOMContentLoaded", function(event) { 
       var scrollpos = localStorage.getItem('scrollpos');
       if (scrollpos) window.scrollTo(0, scrollpos);
   });

   window.onbeforeunload = function(e) {
       localStorage.setItem('scrollpos', window.scrollY);
   };
</script>