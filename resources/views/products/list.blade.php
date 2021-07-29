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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
    <style>
        .fa-star{
            color: goldenrod;
        }
    </style>
</head>
<body>
<div class="container p-5">
    <h2 class="text-center">List Product
    </h2>
    <div class="row m-5">
        @foreach($list as $obj)
        <div class="col-4 p-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{$obj->thumbnail}}" alt="Card image cap" height="200px">
                <div class="card-body">
                    <h5 class="card-title">{{$obj->name}}</h5>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <p class="card-text">{{$obj->price}}$</p>
                    <a href="/add/{{$obj->id}}" class="btn btn-primary">Add To Cart</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</body>
</html>
