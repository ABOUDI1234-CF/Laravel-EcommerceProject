<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

//use PDF;

class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                $category = Category::all();
                return view('admin.category',compact('category'));


            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }
       
    }
    public function add_category(Request $request)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
               $category = new Category;
               $category->category_name=$request->category;
               $category->save();
               return redirect()->back()->with('message','category added successfully');


            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

    }
    public function delete_category($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
               $category = Category::find($id);
               Category::destroy($id);
               return redirect()->back();


            }else{
             //   $products = Product::paginate(10);
             //   $comments = Comment::orderby('id','desc')->get();
             //   $reply = Reply::all();
             //   return view('home.userpage',compact('products','comments','reply'));
                             return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

    }
    public function view_product()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                $category = Category::all(); 
                return view('admin.product',compact('category'));


            }else{
               // $products = Product::paginate(10);
                //$comments = Comment::orderby('id','desc')->get();
                //$reply = Reply::all();
                //return view('home.userpage',compact('products','comments','reply'));
                return redirect()->back();
            }
            
        }
        else{
            return redirect('login');
        }
    }
    public function add_product(Request $request)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
               $product = new Product;
               $product->title=$request->title;
               $product->description=$request->description;
               $product->price=$request->price;
               $product->quantity=$request->quantity;
               $product->discount_price=$request->dis_price;
               $product->category=$request->category;
               $image=$request->image;
               $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('product',$imagename);
               $product->image=$imagename;
               $product->save();
               return redirect()->back();


            }else{
               // $products = Product::paginate(10);
                //$comments = Comment::orderby('id','desc')->get();
               // $reply = Reply::all();
               // return view('home.userpage',compact('products','comments','reply'));
             return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }


    }
    public function show_product()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
               $product = Product::all();
               return view('admin.show_product',compact('product'));



            }else{
            //    $products = Product::paginate(10);
              //  $comments = Comment::orderby('id','desc')->get();
               // $reply = Reply::all();
                //return view('home.userpage',compact('products','comments','reply'));
               return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

    }
    public function delete_product($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
              $product = Product::find($id);
              Product::destroy($id);
              return redirect()->back();



            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

    }
    public function update_product($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
             $category=Category::all();
             $product = Product::find($id);
             return view('admin.update_product',compact('product','category'));



            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

    }
    public function update_product_confirm(Request $request,$id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
              $product = Product::find($id);
              $product->title=$request->title;
              $product->description=$request->description;
              $product->price=$request->price;
              $product->quantity=$request->quantity;
              $product->discount_price=$request->dis_price;
              $product->category=$request->category;
              $image=$request->image;
             if($image)
             {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
            


           }
            $product->save();
        
        return redirect()->back();



            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
             return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

        
    }
    public function order()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
              $order = Order::all();
              return view('admin.order',compact('order'));



            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

    }
    public function delivered($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
             $order = Order::find($id);
             $order->delivery_status="delivered";
             $order->payment_status="paid";
             $order->save();
             return redirect()->back();



            }else{
             //   $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

    }
   // public function print_pdf($id)
    //{
      //  $pdf = PDF::loadView('admin.pdf');
       // return $pdf->download('order_details.pdf');
   // }
   public function print_pdf($id)
{
    if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
             $order = Order::find($id);

             // Make sure the order exists
             if (!$order) {
             abort(404, 'Order not found');
    }

    $pdf = app('dompdf.wrapper')->loadView('admin.pdf', compact('order'));

    return $pdf->download('order_details.pdf');



            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

}
public function send_Email($id)

{
   if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
              $order = Order::find($id);
              return view('admin.email_info',compact('order'));



            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

}
public function send_user_email(Request $request, $id)

{
    if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
             $order = Order::find($id);
        $details = [
        'greeting'=>$request->greeting,
        'firstline'=>$request->firstline,
        'body'=>$request->body,
        'button'=>$request->button,
        'url'=>$request->url,
        'lastline'=>$request->lastline,

        ];
    Notification::send($order,new SendEmailNotification($details));
    return redirect()->back();



            }else{
             //   $products = Product::paginate(10);
             //   $comments = Comment::orderby('id','desc')->get();
             //   $reply = Reply::all();
             //   return view('home.userpage',compact('products','comments','reply'));
                             return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }


}
public function searchdata(Request $request){
   if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
              $searchText = $request->search;
              $order = Order::where('name','LIKE',"%$searchText%")->get();
              return view('admin.order',compact('order'));



            }else{
            //    $products = Product::paginate(10);
            //    $comments = Comment::orderby('id','desc')->get();
            //    $reply = Reply::all();
            //    return view('home.userpage',compact('products','comments','reply'));
                            return redirect()->back();

            }
            
        }
        else{
            return redirect('login');
        }

}



}
