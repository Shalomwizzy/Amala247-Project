<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Guest Form</title>
</head>
<body class="antialiased">
    <h1>Guest Form</h1>
    <div class="container">
        <form method="POST" action="{{ route('guest.pay.now') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
            @csrf
            @method('post')
            <div class="row" style="margin-bottom: 40px;">
                <div class="col-md-8 col-md-offset-2">
                    @foreach ($cartItems as $cartItem)
                        <p>
                            <div>
                                {{ $cartItem->product->product_name }}
                                ₦ {{ $cartItem->amount }}
                            </div>
                        </p>
                        <input type="hidden" name="item_name[]" value="{{ $cartItem->product->product_name }}">
                        <input type="hidden" name="item_price[]" value="{{ $cartItem->amount }}">
                        <input type="hidden" name="quantity[]" value="{{ $cartItem->quantity }}">
                    @endforeach
    
                    <p>
                        <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                        </button>
                    </p>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
