<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ asset('css/ordersStyle.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <title>Orders</title>
    </head>
<body>
    {{-- @dd($orders) --}}
    <div class="container">
        <div class="row">
                <div class="col-lg-10 mx-auto mb-4">
                <div class="section-title text-center ">
                    <h3 class="top-c-sep">My orders</h3>
                    <p>Lorem ipsum dolor sit detudzdae amet, rcquisc adipiscing elit. Aenean socada commodo
                        ligaui egets dolor. Nullam quis ante tiam sit ame orci eget erovtiu faucid.</p>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">    
                    <div class="filter-result">

                        @foreach ($orders as $order)
                            <div class="job-box d-md-flex align-items-center justify-content-between mb-30" onclick="window.location.href = '/order/show/' + '{{$order->id}}'">
                                <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                    <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex bg-success">
                                        Paid
                                    </div>
                                    <div class="job-content">
                                        <h5 class="text-center text-md-left">Order Token: {{ $order->token }}</h5>
                                        <span>Order Date: {{ $order->order_date }}</span><br>
                                        <span><strong>Total :Rp {{ number_format($order->total,2, ',', '.') }}</strong></span>
                                    </div>
                                </div>
                            </div>    
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
