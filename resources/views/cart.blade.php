@extends('layouts.app')
@section('content')
<div class="uk-container uk-container-expand">
        <form action="{{ route('order.store') }}" method="POST">
                @csrf
                @method('POST')
    <div class="row">
            
    <div class="col-md-12 col-lg-8">
        <div class="uk-card uk-card-default uk-card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        <div class="heading">
            <h3>{{ __('Shopping cart') }}</h3>
        </div>
        @if(count($items)!=0)
        @foreach($items as $x => $item)
        <hr>
        <div class="row uk-margin" uk-grid>
            <div class="uk-margin uk-width-1-3">
                <img style="width:150px;max-height:140px" src="{{asset('images').'/'.$item['photo']}}" alt="">
            </div>
            <div class="info uk-width-1-3">
            <div class="productid">{{ __('Product ID') }}: <a href="{{route('product.show',$item['id'])}}">{{$item['id']}}</a></div>
            <div class="productname">{{ __('Product Name') }}: {{$item['name']}}</div>
            </div>
            <div class="pcontrol uk-width-1-3">
            <div class="uk-text-right price">SEK {{number_format($item['price'])}}</div>
            <div style="justify-content:flex-end" class="pcontroller uk-margin uk-text-center uk-flex">
                <div class="uk-margin-right"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$item['id']}},{{$item['cnt']}})"><span uk-icon="minus"></span></div></div>
                <div class="" style="width:140px"><input id="inputbtn{{$item['id']}}" type="text" class="uk-input inputbtn" value="{{$item['quantity']}}"></div>
                <div class="uk-margin-left"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$item['id']}},{{$item['cnt']}})"><span uk-icon="plus"></span></div></div>
            </div>
        <div class="removeproduct uk-text-right"><a href="{{route('remove-from-cart',$item['id'])}}"><span uk-icon="trash"></span> {{ __('Remove') }}</a></div>
            </div>
        </div>
        @endforeach
        <hr>
        <div class="uk-margin">
            <div class="uk-text-right">
            
            <button type="submit" class="uk-button uk-button-primary">{{__('Order')}}</button>
            
            </div>
        </div>
        @else
        <hr>
        <div class="uk-margin">
            <span>{{ __('You have no items in your shopping cart') }}</span>
        </div>
        @endif
    </div></div>
    <div class="col-md-12 col-lg-4">
        
<div class="uk-card uk-card-default uk-card-body">
    <div class="heading">
        <h3>{{ __('Order information') }}</h3>    
    </div>    
    <hr>
    <div class="uk-grid">
        <div class="uk-width-1-2 uk-text-left"><span class="">{{ __('Sub Total') }}</span></div>
    <div class="uk-width-1-2 uk-text-right"><span class="">{{number_format($total)}}</span></div>
    </div>
    <hr>
    <div class="uk-grid">
            <div class="uk-width-1-2 uk-text-left"><span class="">{{ __('VAT') }}</span></div>
    <div class="uk-width-1-2 uk-text-right"><span class="">{{number_format($vat=$total*12/100)}}</span></div>
        </div>
        <hr>
    <div class="uk-grid">
            <div class="uk-width-1-2 uk-text-left"><span class="">{{ __('Total') }}</span></div>
    <div class="uk-width-1-2 uk-text-right"><span class="">{{number_format($total+$vat)}}</span></div>
        </div>
    <div class="uk-grid">
        <div class="uk-width-1-1">
            <span>{{ __('Branch') }}:</span>
            <select name="branch" id="" class="uk-select">
                    <option value="">- Choose an one -</option>
                    @foreach($branch as $val)
                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
            </select>
        </div>
        <div class="uk-width-1-1">
            <span>{{ __('Order date') }}:</span>
        <input class="uk-input" type="date" name="orderdate" value="{{ date("Y-m-d") }}">
        </div>
        <div class="uk-width-1-1">
            <span>{{ __('Description') }}:</span>
            <textarea class="uk-textarea" rows="5" placeholder="" name="description"></textarea>
        </div>
        <div class="uk-width-1-1 uk-margin-top">
            
            <button type="submit" class="uk-button uk-button-primary">{{__('Order')}}</button>
            
        </div>
    </div>
</div>

    </div>
    
    </div>
</form> 
</div>
@endsection
@yield('scripts')