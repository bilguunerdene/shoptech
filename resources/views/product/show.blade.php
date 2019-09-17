@extends('layouts.app')
@section('content')
<div class="uk-container uk-container-expand">
    <div>
        <div class="uk-card uk-card-default uk-card-body">
            <div class="uk-child-width-1-1@s uk-child-width-1-1@m uk-child-width-1-2@l" uk-grid>
                <div class="leftsection">
                <img src="{{ asset('images/').'/'.$product[0]->imageurl }}" alt="">
                </div>
                <div class="rightsection">
                    <div>
                    <h1>{{ $product[0]->name }}</h1>
                    </div>
                    <div>
                    <span>{{ $product[0]->article_number }}</span>
                    </div>
                    <div class="uk-margin">
                        <div style="justify-content:flex-start" class="pcontroller uk-margin uk-text-center uk-flex">
                            <div class="uk-margin-right"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$product[0]->id}},{{$product[0]->cnt}})"><span uk-icon="minus"></span></div></div>
                            <?php
                            $quantity = 0;
                            if(Session::has('cart'))
                                foreach(Session::get('cart') as $key => $items){
                                    if($key == $product[0]->id)
                                    $quantity = $items['quantity'];
                                }
                            ?>
                        <div style="max-width:100px"><input id="inputbtn{{$product[0]->id}}" type="text" class="uk-input inputbtn" value="{{$quantity}}"></div>
                            <div class="uk-margin-left"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$product[0]->id}},{{$product[0]->cnt}})"><span uk-icon="plus"></span></div></div>
                        </div>
                    </div>
                    <div>
                        <table class="showtable">
                            <tr>
                                <td>{{ __('Inprice') }}</td>
                                <td>SEK {{ number_format($product[0]->inprice,2) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Outprice') }}</td>
                                <td>SEK {{ number_format($product[0]->price,2) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Barcode') }}</td>
                                <td>{{ $product[0]->barcode }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Package Size') }}</td>
                                <td>{{ $product[0]->cnt }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Country') }}</td>
                                <td>{{ $product[0]->country }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Type') }}</td>
                                <td>{{ $product[0]->type }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection