@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-xs-12 col-md-4 mt-3">
        <x-forms.new-product />
        </div>
        <div class="col-lg-8 col-xs-12 col-md-8 mt-3">
     
            <x-product.product-card />
            
</div>
    </div>
</div>
@endsection