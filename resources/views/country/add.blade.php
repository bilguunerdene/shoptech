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
    <input type="hidden" name="id" value="{{$country!=null?$country->id:''}}">
    <div class="uk-margin">
    <label class="uk-form-label" for="">Name</label>
    <div class="uk-form-controls"><input type="text" name="name" value="{{ $country!=null?$country->name:old('name')}}" class="uk-input required"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Countrycode</label>
    <div class="uk-form-controls"><input type="text" name="countrycode" value="{{ $country!=null?$country->countrycode:old('countrycode')}}" class="uk-input required"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Image</label>
    <div class="uk-form-controls" style="margin-left:15px" uk-form-custom="target: true">
        <input type="file" name="image">
    <input class="uk-input uk-form-width-medium" type="text" placeholder="{{ $country!=null?$country->imageurl:(old('imageurl')!=null?old('imageurl'):'Select file') }}" disabled>
    @if($country!=null&&$country->imageurl!=null)
    <div><img style="width:200px;height:200px" src="{{ asset('images/').'/'.$country->imageurl }}" alt=""></div>
    @endif
    </div>
    <!-- <button class="uk-button uk-button-default">Submit</button> -->
    </div>
    
   
    
<input type="submit" value="{{$country!=null?'Update':'Save'}}" class="uk-input uk-button-primary">
    </div>
    </form>
@endsection