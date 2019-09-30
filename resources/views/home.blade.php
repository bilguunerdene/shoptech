@extends('layouts.app')

@section('content')

<div class="home uk-container uk-container-expand">
    @isset($country)
    <div class="filter">
    <form action="{{ route('filter') }}" method="GET">
            <div class="uk-margin" uk-grid>
                    <div class="uk-width-1-2">
                        <label for="countryId">{{ __('Country') }}: </label>
                            <select name="countryId" class="uk-select" onchange="this.form.submit()">
                                    <option value="All">All</option>
                                    @foreach($country as $c)
                                <option value="{{ $c->id }}" {{$c->id==request('countryId')?'selected':''}}>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                    </div>
                    <div class="uk-width-1-2">
                        <label for="type">{{ __('Type') }}: </label>
                            <select name="type" class="uk-select" onchange="this.form.submit()">
                                    <option value="All">{{ __('All') }}</option>
                                    @foreach($type as $c)
                                <option value="{{ $c->id }}" {{$c->id==request('type')?'selected':''}}>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                    </div>
                </div>
    </form>
    </div>
    @endisset
    <div class="uk-text-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-scrollspy="cls: uk-animation-slide-bottom; target: .uk-card; delay: 300; repeat: false" uk-grid>
        
     @foreach($product as $item)
    <div>
        <div class="uk-card uk-card-default uk-card-body">
            <div>
                <div class="image uk-display-inline-block">
                <a href="{{route('product.show',$item->id)}}"><img src="{{asset('images').'/'.$item->imageurl}}" alt=""></a>
                </div>
                <div class="uk-text-left">
                    <span>{{$item->article_number}}</span>
                </div>
                <div class="price uk-text-right">
                    <span class="uk-text-bold uk-text-emphasis">SEK {{number_format($item->price)}}</span>
                </div>
                <div class="uk-text-center">
                    <div>{{$item->name!=null?$item->name:"Unknown name of product"}}</div>
                    <div>{{$item->cnt}} per one package</div>
                </div>
                <div class="uk-text-center">
                <button onclick="addtofav({{$item->id}})" id="heart_{{$item->id}}" class="button button-like {{$item->favid!=null?'liked':''}}">
                        <i class="fa fa-heart"></i>
                        <span>Like</span>
                      </button>
                </div>
                <div class="pcontroller uk-margin uk-text-center uk-flex">
                    <div class="uk-margin-right"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$item->id}},{{$item->cnt}})"><span uk-icon="minus"></span></div></div>
                    <?php
                    $quantity = 0;
                    if(Session::has('cart'))
                        foreach(Session::get('cart') as $key => $items){
                            if($key == $item->id)
                            $quantity = $items['quantity'];
                        }
                    ?>
                <div class=""><input id="inputbtn{{$item->id}}" type="text" class="uk-input inputbtn" value="{{$quantity}}"></div>
                    <div class="uk-margin-left"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$item->id}},{{$item->cnt}})"><span uk-icon="plus"></span></div></div>
                </div>
            </div>
        </div>
    </div>
    @endforeach 
</div>
<div class="pagination uk-margin">
    {{ $product->appends(['name' => Request::get('name')])->links() }}
</div>
</div>

@endsection
