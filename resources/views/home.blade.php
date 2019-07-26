@extends('layouts.app')

@section('content')
<div class="uk-container uk-container-expand">
    <div class="uk-text-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-scrollspy="cls: uk-animation-slide-bottom; target: .uk-card; delay: 300; repeat: true" uk-grid>
        
     @foreach($product as $item)
    <div>
        <div class="uk-card uk-card-default uk-card-body">
            <div>
                <div class="image uk-display-inline-block">
                <img style="width:150px;max-height:140px" src="{{asset('images').'/'.$item->imageurl}}" alt="">
                </div>
                <div class="uk-text-left">
                    <span>{{$item->barcode}}</span>
                </div>
                <div class="price uk-text-right">
                    <span class="uk-text-bold uk-text-emphasis">SEK {{number_format($item->price)}}</span>
                </div>
                <div class="uk-text-center">
                    <div>{{$item->name}}</div>
                    <div>{{$item->cnt}} per one package</div>
                </div>
                <div style="justify-content:flex-end" class="pcontroller uk-margin uk-text-center uk-flex">
                    <div class="uk-margin-right"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$item->id}},{{$item->cnt}})"><span uk-icon="minus"></span></div></div>
                    <div class=""><input id="inputbtn{{$item->id}}" type="text" class="uk-input inputbtn" value="{{in_array($item->id,Session::get('cart'))?Session::get('cart')[$item->id]['quantity']:0}}"></div>
                    <div class="uk-margin-left"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$item->id}},{{$item->cnt}})"><span uk-icon="plus"></span></div></div>
                </div>
            </div>
        </div>
    </div>
    @endforeach 
</div>
</div>

@endsection
