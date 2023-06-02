@extends('layouts.app')

@section('title', 'Checkout')

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
                    email with the delivery details.
                </p>
                <p>
                    If you have any questions, please feel free to contact us at <a
                        href="mailto:contact@shopthuydung.store">contact@shopthuydung.store{{ config('settings.site_email') }}</a>.
                </p>
            </div>
        </div>
    </div>

@endsection
