@extends('partial.master')

@section('content')
    @foreach($products as $product)
        <div>{{ $product->name }}</div>
        <img src="{{ $product->image }}" alt="" width="300px" height="300px">
    @endforeach
@endsection
