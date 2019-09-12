@extends('settings')
@section('section')
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
                    <form class="uk-form-horizontal" action="{{ $action }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method($method)
    <input type="hidden" name="id" value="{{$product!=null?$product->id:''}}">
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Article Number') }}</label>
    <div class="uk-form-controls"><input type="text" name="article_number" value="{{ $product!=null?$product->name:old('article_number')}}" class="uk-input required"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Name') }}</label>
    <div class="uk-form-controls"><input type="text" name="name" value="{{ $product!=null?$product->name:old('name')}}" class="uk-input required"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Country') }}</label>
    <div class="uk-form-controls"><select class="uk-select" name="country" name="" id="">
        <option value="">- Choose an one -</option>
    @foreach($country as $val)
    <option value="{{ $val->id }}" {{old('type')==$val->id||($product!=null?$product->country:'')==$val->id?'selected':''}}>{{ $val->name }}</option>
    @endforeach
    </select></div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Barcode') }}</label>
    <div class="uk-form-controls"><input type="text" name="barcode" class="uk-input" value="{{ $product!=null?$product->barcode:old('barcode') }}"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('In Price') }}</label>
    <div class="uk-form-controls"><input type="text" name="inprice" class="uk-input" value="{{ $product!=null?$product->inprice:old('inprice') }}"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Out Price') }}</label>
    <div class="uk-form-controls"><input type="text" name="price" class="uk-input" value="{{ $product!=null?$product->price:old('price') }}"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Quantity per package') }}</label>
    <div class="uk-form-controls"><input type="text" name="quantity" class="uk-input" value="{{ $product!=null?$product->cnt:old('quantity') }}"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Type') }}</label>
    <div class="uk-form-controls"><select class="uk-select" name="type" name="" id="">
        <option value="">- Choose an one -</option>
    @foreach($type as $val)
    <option value="{{ $val->id }}" {{old('type')==$val->id||($product!=null?$product->type:'')==$val->id?'selected':''}}>{{ $val->name }}</option>
    @endforeach
    </select></div>
    
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Image') }}</label>
    <div class="uk-form-controls" style="margin-left:15px" uk-form-custom="target: true">
        <input type="file" name="image">
    <input class="uk-input uk-form-width-medium" type="text" placeholder="{{ $product!=null?$product->imageurl:(old('imageurl')!=null?old('imageurl'):'Select file') }}" disabled>
    @if($product!=null&&$product->imageurl!=null)
    <div><img style="width:200px;height:200px" src="{{ asset('images/').'/'.$product->imageurl }}" alt=""></div>
    @endif
    </div>
    <!-- <button class="uk-button uk-button-default">Submit</button> -->
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Detail') }}</label>
    <div class="uk-form-controls"><textarea class="uk-textarea" name="detail">{{ $product!=null?$product->detail:old('detail') }}</textarea></div>
    </div>
    
<input type="submit" value="{{$product!=null?__('Update'):__('Save')}}" class="uk-input uk-button-primary">
    </div>
    </form>
@endsection