<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Order</title>
</head>
<body>
@if(session('success-msg'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong>{{session('success-msg')}}
    </div>
@endif
<div class="container mt-5">
    <h2>Thông tin đơn hàng #{{$orders->id}}</h2>
    <ul style="list-style-type: none">
        <li>Trạng thái : {{$orders->isCheckout ? 'Đã thanh toán' : 'Chờ thanh toán'}}</li>
        <li>Tên người nhận : {{$orders->shipName}}</li>
        <li>Số điện thoại : {{$orders->shipPhone}}</li>
        <li>Địa chỉ : {{$orders->shipAddress}}</li>
        <li>Ghi chú : {{$orders->note}}</li>
    </ul>
    <?php
    $totalPrice = 0
    ?>
    <div class="row">
        <table class="table table-dark">
            <thead>
            <tr>
                <th>Name</th>
                <th>Thumbnail</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>SubTotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders->orderDetails as $orderDetail)
                <?php
                if (!empty($orderDetail)) {
                    $totalPrice += $orderDetail->unitPrice * $orderDetail->quantity;
                }
                ?>
                <tr>
                    <td>{{$orderDetail->product->name}}</td>
                    <td><img src="{{$orderDetail->product->thumbnail}}" alt="" width="200px"></td>
                    <td>{{$orderDetail->product->price}}</td>
                    <td>{{$orderDetail->quantity}}</td>
                    <td>{{$orderDetail->unitPrice}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row justify-content-around">
        <div class="col-6">
            <strong>Total Price : {{$totalPrice}}$</strong>
        </div>
        <div class="col-6">
            @if(!$orders->isCheckout == true)
                <div id="paypal-button"></div>
            @endif
        </div>
    </div>
</div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        env: 'sandbox', // Or 'production'
        // Set up the payment:
        // 1. Add a payment callback
        payment: function (data, actions) {
            // 2. Make a request to your server
            return actions.request.post('/paypal/create-payment', {
                orderId: {{$orders->id}},
            })
                .then(function (res) {
                    // 3. Return res.id from the response
                    return res.id;
                });
        },
        // Execute the payment:
        // 1. Add an onAuthorize callback
        onAuthorize: function (data, actions) {
            // 2. Make a request to your server
            return actions.request.post('/paypal/execute-payment', {
                paymentID: data.paymentID,
                payerID: data.payerID
            })
                .then(function (res) {
                    alert('Payment Success !!')
                    location.reload();
                    // 3. Show the buyer a confirmation message.
                });
        }
    }, '#paypal-button');
</script>
</body>
</html>
