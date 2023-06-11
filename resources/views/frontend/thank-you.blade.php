@extends('layouts.app')

@section('title', 'Thank you')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-primary">
                    Thank you for your order.
                </h4>
                <hr>
                <p>
                    Your order has been placed and is being processed. When the item(s) are shipped, you will receive an
                    email with the details.
                </p>
                <p>If you have any questions, please feel free to <a href="{{ url('/contact-us') }}">contact us</a>, our
                    customer service center is working for you 24/7.</p>
                <p>
                    <a href="{{ url('/orders') }}" class="btn btn-primary">View orders history</a>
                or <a href="{{ url('/') }}" class="btn btn-primary">Go to homepage</a>
                </p>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>

@endsection
