<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 style="font-size: 15px;">PDF </h1>
   Customer Name : <h3>{{$order->name}}</h3>
   Customer Email : <h3>{{$order->email}}</h3>
   Customer Address : <h3>{{$order->address}}</h3>
   Customer Phone : <h3>{{$order->phone}}</h3>
   Customer Id : <h3>{{$order->user_id}}</h3>
   Product Name : <h3>{{$order->product_title}}</h3>
   Product Price : <h3>{{$order->price}}</h3>
   Product Quantity : <h3>{{$order->quantity}}</h3>
   Payment Status : <h3>{{$order->payment_status}}</h3>
   Product Id: <h3>{{$order->product_id}}</h3>
   <br> <br>
   <img height="100" width="200" src="{{ public_path('/product/' . $order->image) }}" />

</body>
</html>
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: black;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        /* Add additional styling as needed */

    </style>
</head>
<body>
    <h1>Order Details</h1>
    <div>
        <strong>Customer Name:</strong>
        <h3>{{$order->name}}</h3>
    </div>
    <div>
        <strong>Customer Email:</strong>
        <h3>{{$order->email}}</h3>
    </div>
    <div>
        <strong>Customer Address:</strong>
        <h3>{{$order->address}}</h3>
    </div>
    <div>
        <strong>Customer Phone:</strong>
        <h3>{{$order->phone}}</h3>
    </div>
    <div>
        <strong>Customer Id:</strong>
        <h3>{{$order->user_id}}</h3>
    </div>
    <div>
        <strong>Product Name:</strong>
        <h3>{{$order->product_title}}</h3>
    </div>
    <div>
        <strong>Product Price:</strong>
        <h3>${{$order->price}}</h3>
    </div>
    <div>
        <strong>Product Quantity:</strong>
        <h3>{{$order->quantity}}</h3>
    </div>
    <div>
        <strong>Payment Status:</strong>
        <h3>{{$order->payment_status}}</h3>
    </div>
    <div>
        <strong>Product Id:</strong>
        <h3>{{$order->product_id}}</h3>
    </div>

    <img src="{{ public_path('/product/' . $order->image) }}" alt="Product Image">

</body>
</html>
