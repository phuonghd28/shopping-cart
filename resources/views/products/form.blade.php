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
    <title>Document</title>
</head>
<body>
<div class="container p-3">
    <h2 class="text-center">Tạo mới sản phẩm</h2>
    <div>
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-6 form-group">
                    Name
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
                <div class="col-6 form-group">
                    Price
                    <input type="text" class="form-control" placeholder="Enter price" name="price">
                </div>
            </div>
          <div class="row">
              <div class="col-9 form-group">
                  Thumbnail
                  <input type="text" class="form-control" placeholder="Enter thumbnail" name="thumbnail">
              </div>
              <div class="col-3 form-group mt-4">
                  <button class="form-control btn btn-primary">Gửi</button>
              </div>
          </div>
        </form>
    </div>
</div>
</body>
</html>
