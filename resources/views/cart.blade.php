@extends('layouts.app')
@section('content')
<div class="uk-container uk-container-expand">
        <form action="{{ route('order.store') }}" method="POST">
                @csrf
                @method('POST')
    <div class="row">
            
    <div class="col-md-12 col-lg-8 uk-margin-bottom">
        <div class="uk-card uk-card-default uk-card-body">
        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
        <div style="display:flex" class="heading">
            <div><h3>{{ __('Shopping cart') }}</h3></div>
            <div style="display: block;
            flex: auto;
            justify-content: end;
            align-self: center;"><div class="removeproduct uk-text-right"><a href="{{route('removeall-from-cart')}}"><span uk-icon="trash"></span> {{ __('Remove All') }}</a></div></div>
        </div>
        <div>
            <ul class="uk-subnav uk-subnav-pill" uk-switcher>
                <li><a href="#">Main</a></li>
                <li><a href="#">Confirmation</a></li>
            </ul>
            <ul class="uk-switcher uk-margin">
                <li>
                        @if(count($items)!=0)
                        @foreach($items as $x => $item)
                        <hr>
                        <div class="row uk-margin">
                            <div class="uk-margin">
                                <img style="max-width:200px;max-height:140px" src="{{asset('images').'/'.$item['photo']}}" alt="">
                            </div>
                            <div class="info">
                            <div class="productid">{{ __('Product ID') }}: <a href="{{route('product.show',$item['id'])}}">{{$item['id']}}</a></div>
                            <div class="productname">{{ __('Product Name') }}: {{$item['name']}}</div>
                            </div>
                            <div class="pcontrol" style="flex:auto">
                            <div class="uk-text-right price">SEK {{number_format($item['inprice'])}}</div>
                            <div style="justify-content:flex-end" class="pcontroller uk-margin uk-text-center uk-flex">
                                <div class="uk-margin-right"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$item['id']}},{{$item['cnt']}},{{$item['inprice']}})"><span uk-icon="minus"></span></div></div>
                                <div class="" style="width:140px"><input id="inputbtn{{$item['id']}}" type="text" class="uk-input inputbtn" value="{{$item['quantity']}}"></div>
                                <div class="uk-margin-left"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$item['id']}},{{$item['cnt']}},{{$item['inprice']}})"><span uk-icon="plus"></span></div></div>
                            </div>
                        <div class="removeproduct uk-text-right"><a href="{{route('remove-from-cart',$item['id'])}}"><span uk-icon="trash"></span> {{ __('Remove') }}</a></div>
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        <div class="uk-margin">
                            <div class="uk-text-right">
                            
                            <button class="uk-button uk-button-primary" uk-switcher-item="next">{{__('Confirm')}}</button>
                            
                            
                            </div>
                        </div>
                        @else
                        <hr>
                        <div class="uk-margin">
                            <span>{{ __('You have no items in your shopping cart') }}</span>
                        </div>
                        @endif
                </li>
                <li>
                        <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <span>{{ __('Branch') }}:</span>
                                    <select name="branch" id="" class="uk-select">
                                            <option value="">- Choose an one -</option>
                                            @foreach($branch as $val)
                                            <option value="{{ $val->id }}" {{$val->id==Auth::user()->branchid?"selected":""}}>{{ $val->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="uk-width-1-1">
                                    <span>{{ __('Due date') }}:</span>
                                <input class="uk-input" type="date" name="orderdate" value="{{ date("Y-m-d") }}">
                                </div>
                                <div class="uk-width-1-1">
                                    <span>{{ __('Description') }}:</span>
                                    <textarea class="uk-textarea" rows="5" placeholder="" name="description"></textarea>
                                </div>
                                
                            </div>
                        @if(count($items)!=0)
                        @foreach($items as $x => $item)
                        <hr>
                        <div class="row uk-margin row_{{$item['id']}}">
                            <div class="uk-margin">
                                <img style="max-width:200px;max-height:140px" src="{{asset('images').'/'.$item['photo']}}" alt="">
                            </div>
                            <div class="info">
                            <div class="productid">{{ __('Product ID') }}: <a href="{{route('product.show',$item['id'])}}">{{$item['id']}}</a></div>
                            <div class="productname">{{ __('Product Name') }}: {{$item['name']}}</div>
                            </div>
                            <div class="pcontrol" style="flex:auto">
                            <div class="uk-text-right price">SEK <span data-value="{{$item['inprice']*$item['quantity']}}" class="itemtotal">{{number_format($item['inprice']*$item['quantity'])}}</span></div>
                            <div style="justify-content:flex-end" class="uk-margin uk-text-center uk-flex">
                            SEK {{number_format($item['inprice'])." X "}} <span data-value="{{$item['quantity']}}" class="quantity">{{number_format($item['quantity'])}}</span>
                            </div>
                        
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
                </li>
            </ul>
        </div>
        
        
    </div></div>
    <div class="col-md-12 col-lg-4">
        
<div class="uk-card uk-card-default uk-card-body">
    <div class="heading">
        <h3>{{ __('Order information') }}</h3>    
    </div>    
    <hr>
    <div class="uk-grid">
        <div class="uk-width-1-2 uk-text-left"><span class="">{{ __('Sub Total') }}</span></div>
    <div class="uk-width-1-2 uk-text-right"><span data-value="{{($total)}}" class="subtotal">{{number_format($total)}}</span></div>
    </div>
    <hr>
    <div class="uk-grid">
            <div class="uk-width-1-2 uk-text-left"><span class="">{{ __('VAT') }}</span></div>
    <div class="uk-width-1-2 uk-text-right"><span data-value="{{($total*12/100)}}" class="vat">{{number_format($vat=$total*12/100)}}</span></div>
        </div>
        <hr>
    <div class="uk-grid">
            <div class="uk-width-1-2 uk-text-left"><span class="">{{ __('Total') }}</span></div>
    <div class="uk-width-1-2 uk-text-right"><span data-value="{{($total+$vat)}}" class="grandtotal">{{number_format($total+$vat)}}</span></div>
        </div>
    
</div>

    </div>
    
    </div>
</form> 
</div>
@endsection
@yield('scripts')