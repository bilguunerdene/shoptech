@php($sum_tot = 0)
@extends('order.settings')

@section('section')
                @if (session('status'))
                            <div class="alert {{ session('status')==0?'alert-success':'alert-danger' }}" role="alert">
                                {{ session('msg') }}
                            </div>
                        @endif
    <div style="overflow-x:scroll">
    <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">{{ __('Product Number') }}</th>
            <th class="text-center">{{ __('Name') }}</th>
            <th class="text-center">{{ __('Image') }}</th>
            <th class="text-center">{{ __('Barcode') }}</th>
            <th class="text-center">{{ __('Price') }}</th>
            <th class="text-center">{{ __('Quantity') }}</th>
            <th class="text-center">{{ __('Total') }}</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($order as $x => $item)
        @php($sum_tot+=$item->price*$item->quantity)
    <tr style="cursor: pointer" onclick="location.href='{{ route('order.show',$item->id) }}'" class="item{{$item->id}}">
            <td class="uk-text-center">{{$x+1}}</td>
            <td class="uk-text-center">{{$item->productid}}</td>
            <td class="uk-text-center">{{$item->name}}</td>
    <td class="uk-text-center"><img style="height:50px" src="{{ asset('images/'.$item->imageurl) }}" alt=""></td>
            <td class="uk-text-center">{{$item->barcode}}</td>
            <td class="uk-text-center">{{$item->price}}</td>
            <td class="uk-text-center">{{$item->quantity}}</td>
            <td class="uk-text-center">{{$item->price*$item->quantity}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
<div class="uk-clearfix">
    <div class="uk-float-left">
        
    <a href="{{ route('downloadpdf',$orderid) }}"><button class="uk-button-primary uk-button" >Download as PDF</button></a>
    </div>
    <div class="uk-float-right">
        <h3 class="uk-float-left">Sub Total: </h3>
        <span class="uk-float-left uk-text-right uk-text-large" style="width:250px;">SEK {{number_format($sum_tot,2)}}</span>
    </div>
</div>
<div class="uk-clearfix">
    <div class="uk-float-right">
        <h3 class="uk-float-left">VAT: </h3>
        <span class="uk-float-left uk-text-right uk-text-large" style="width:250px;">SEK {{number_format($sum_tot*12/100,2)}}</span>
    </div>
</div>
<div class="uk-clearfix">
    <div class="uk-float-right">
        <h3 class="uk-float-left">Total: </h3>
        <span class="uk-float-left uk-text-right uk-text-large uk-text-bold" style="width:250px;">SEK {{number_format(($sum_tot*12/100+$sum_tot),2)}}</span>
    </div>
</div>
@endsection