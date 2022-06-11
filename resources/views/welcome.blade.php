@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
        <x-forms.new-product />
        </div>
        <div class="col-lg-8">
        <x-product.product-card />
</div>
    </div>
</div>
@endsection