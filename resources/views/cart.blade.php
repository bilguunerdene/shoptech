@extends('layouts.app')
@section('content')
<div class="uk-container uk-container-expand">
    
    <div class="row">
    <div class="col-md-12 col-lg-8">
        <div class="uk-card uk-card-default uk-card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        <div class="heading">
            <h3>Shopping cart</h3>
        </div>
        @if(count($items)!=0)
        @foreach($items as $x => $item)
        <hr>
        <div class="row uk-margin" uk-grid>
            <div class="uk-margin uk-width-1-3">
                <img style="width:150px;max-height:140px" src="{{asset('images').'/'.$item['photo']}}" alt="">
            </div>
            <div class="info uk-width-1-3">
            <div class="productid">Product ID: <a href="{{route('product.show',$item['id'])}}">{{$item['id']}}</a></div>
            <div class="productname">Product Name: {{$item['name']}}</div>
            </div>
            <div class="pcontrol uk-width-1-3">
            <div class="uk-text-right price">SEK {{number_format($item['price'])}}</div>
            <div style="justify-content:flex-end" class="pcontroller uk-margin uk-text-center uk-flex">
                <div class="uk-margin-right"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$item['id']}},{{$item['cnt']}})"><span uk-icon="minus"></span></div></div>
                <div class="" style="width:140px"><input id="inputbtn{{$item['id']}}" type="text" class="uk-input inputbtn" value="{{$item['quantity']}}"></div>
                <div class="uk-margin-left"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$item['id']}},{{$item['cnt']}})"><span uk-icon="plus"></span></div></div>
            </div>
        <div class="removeproduct uk-text-right"><a href="{{route('remove-from-cart',$item['id'])}}"><span uk-icon="trash"></span> Remove</a></div>
            </div>
        </div>
        @endforeach
        <hr>
        <div class="uk-margin">
            <div class="uk-text-right">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                @method('POST')
            <button type="submit" class="uk-button uk-button-primary">{{__('Order')}}</button>
            </form>
            </div>
        </div>
        @else
        <hr>
        <div class="uk-margin">
            <span>You have no items in your shopping cart</span>
        </div>
        @endif
    </div></div>
    <div class="col-md-12 col-lg-4">
        
<div class="uk-card uk-card-default uk-card-body">
    <div class="heading">
        <h3>Order information</h3>    
    </div>    
    <hr>
    <div class="uk-grid">
        <div class="uk-width-1-2 uk-text-left"><span class="">Sub Total</span></div>
    <div class="uk-width-1-2 uk-text-right"><span class="">{{number_format($total)}}</span></div>
    </div>
    <hr>
    <div class="uk-grid">
            <div class="uk-width-1-2 uk-text-left"><span class="">VAT</span></div>
    <div class="uk-width-1-2 uk-text-right"><span class="">{{number_format($vat=$total*12/100)}}</span></div>
        </div>
        <hr>
    <div class="uk-grid">
            <div class="uk-width-1-2 uk-text-left"><span class="">Total</span></div>
    <div class="uk-width-1-2 uk-text-right"><span class="">{{number_format($total+$vat)}}</span></div>
        </div>
</div>

    </div>
    </div>
</div>
@endsection
@yield('scripts')