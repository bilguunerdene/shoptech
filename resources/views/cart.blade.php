@extends('layouts.app')
@section('content')
<div class="uk-container uk-container-expand">
    <div uk-grid>
    <div class="uk-width-2-3"><div class="uk-card uk-card-default uk-card-body">
        <div class="heading">
            <h3>Shopping cart</h3>
        </div>
        @foreach($items as $x => $item)
        <hr>
        <div class="row uk-margin">
            <div class="uk-margin">
                <img style="width:150px;max-height:140px" src="{{asset('images').'/'.$item['photo']}}" alt="">
            </div>
            <div class="info">
            <div class="productid">Product ID: <a href="{{route('product.show',$item['id'])}}">{{$item['id']}}</a></div>
            <div class="productname">Product Name: {{$item['name']}}</div>
            </div>
            <div class="pcontrol">
            <div class="uk-text-right price">SEK {{number_format($item['price'])}}</div>
            <div class="pcontroller uk-margin" uk-grid>
                <div class="uk-width-1-3 uk-width-medium-1-4"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$item['id']}},{{$item['quantity']}})"><span uk-icon="minus"></span></div></div>
                <div class="uk-width-1-3 uk-width-medium-2-4"><input id="inputbtn{{$item['id']}}" type="text" class="uk-input inputbtn" value="0"></div>
                <div class="uk-width-1-3 uk-width-medium-1-4"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$item['id']}},{{$item['quantity']}})"><span uk-icon="plus"></span></div></div>
            </div>
            <div class="removeproduct"><a href="#"><span uk-icon="remove"></span></a></div>
            </div>
        </div>
        @endforeach
    </div></div>
    <div class="uk-width-1-3"><div class="uk-card uk-card-default uk-card-body">
        <div class="heading">
            <h3>Order information</h3>    
        </div>    
        <hr>
        <div class="uk-grid">
            <div class="uk-width-1-2"><span class="uk-text-left">Sub Total</span></div>
            <div class="uk-width-1-2"><span class="uk-text-right">Sub Total</span></div>
        </div>
        <hr>
        <div class="uk-grid">
                <div class="uk-width-1-2"><span class="uk-text-left">VAT</span></div>
                <div class="uk-width-1-2"><span class="uk-text-right">Sub Total</span></div>
            </div>
    </div></div>
    </div>
</div>
@endsection
