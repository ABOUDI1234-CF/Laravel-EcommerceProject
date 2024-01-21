<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\FlareClient\View;
use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Pagination\LengthAwarePaginator;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype=='1'){
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue =0;
            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }
            $total_delivered = Order::where('delivery_status','=','delivered')->get()->count();
            $total_processing = Order::where('delivery_status','=','processing')->get()->count();
            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        }else{
            $user_id = Auth::id();
            $cartCount = Cart::where('user_id','=', $user_id)->count();   
            $orderCount = Order::where('user_id','=', $user_id)->count();
        
            $products = Product::paginate(10);
            $comments = Comment::orderby('id','desc')->get();
            $reply = Reply::all();

            return view('home.userpage',compact('products','comments','reply','cartCount','orderCount'));
        }
    }
    public function index()
    {
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();

        $products = Product::paginate(10);
        return View('home.userpage',compact('products','comments','reply'));
    }
    public function product_details($id)
    {
        $product= Product::find($id);
        
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        { 
            $user = Auth::user();
            $userid = $user->id;
            $product = Product::find($id);
            $product_exist_id = Cart::where('product_id','=',$id)->where('user_id','=',$userid)->pluck('id')->first();
            if($product_exist_id)
            {
                $cart = Cart::find($product_exist_id);
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if($product->discount_price!=null)
                {
                    $cart->price=$product->discount_price * $cart->quantity;
                }
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                return redirect()->back();

            }else
            {
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                if($product->discount_price!=null)
                {
                    $cart->price=$product->discount_price * $request->quantity;
                }
                else
                {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->save();
                Alert::success('Product added successfuly','we added the product to the cart');
                return redirect()->back();

            }

            

        }else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth::id())
        {
            

            $id = Auth::user()->id;
            $cart = Cart::where('user_id','=', $id)->get();
            $cartCount = Cart::where('user_id','=', $id)->count();
            

            return view('home.show_cart',compact('cart','cartCount'));

        }
        else 
        {
            return redirect('login');
        }
       
    }
    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        Cart::destroy($id);
        return redirect()->back();
    }
    public function cash_order()
    {
        $user = Auth::user();
        $user_id= $user->id;
        $data = Cart::where('user_id','=',$user_id)->get();
        foreach($data as $data)
        {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';
            $order->save();
            $cart_id = $data->id;

            $cart = Cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message','we will connect you soon'); 
    }
    public function stripe($totalPrice)
    {
        return view('home.stripe',compact('totalPrice'));
    }
    public function stripePost(Request $request,$totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "THANK YOU " 
        ]);
        $user = Auth::user();
        $user_id= $user->id;
        $data = Cart::where('user_id','=',$user_id)->get();
        foreach($data as $data)
        {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status='paid';
            $order->delivery_status='processing';
            $order->save();
            $cart_id = $data->id;

            $cart = Cart::find($cart_id);
            $cart->delete();
        }

      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
    public function show_order()
    {
        if(Auth::id())
        {
            $userId = Auth::user()->id;
            $order = Order::where('user_id','=',$userId)->get();
            $orderCount = Order::where('user_id','=', $userId)->count();
          
            return view('home.order',compact('order','orderCount'));

        }
        else {
            return redirect('login');
        }
    }
    public function cancel_order($id){
        $order = Order::find($id);
        $order->delivery_status = "you canceled the order";
        $order->save();
        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment = new Comment;
            $user = Auth::user();

            $comment->name = $user->name;
            $comment->user_id = $user->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();

        }else
        {
            return redirect('login');
        }

    }
    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply = new Reply;
            $user = Auth::user();

            $reply->name = $user->name;
            $reply->user_id = $user->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();

        }else
        {
            return redirect('login');
        }

    }
    public function searchp(Request $request){
        $searchText = $request->search;
        $products = Product::where('title','LIKE',"%$searchText%")->orwhere('category','LIKE',"$searchText")->orwhere('description','LIKE',"%$searchText%")->paginate(10);
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.userpage',compact('products','reply','comments'));
    }
    public function product()
    {
        $comments = Comment::orderby('id','desc')->get();
        $reply = Reply::all();

        $products = Product::paginate(10);
        return View('home.all_products',compact('products','comments','reply'));
    }
}
