@extends('layouts.app')


@section('content')


        
        <h3 style="text-align: center; margin: 25px;">
                You need to login to access this page
        </h3>
        
        <h5 style="text-align: center; margin: 25px;">
        
            <a href="{{ route('products.list') }}">
                Go Back
            </a>
        
        </h5>

@endsection