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
    <input type="hidden" name="id" value="{{$type!=null?$type->id:''}}">
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Name') }}</label>
    <div class="uk-form-controls"><input type="text" name="name" value="{{ $type!=null?$type->name:old('name')}}" class="uk-input required"></div>
    </div>
       
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Image') }}</label>
    <div class="uk-form-controls" style="margin-left:15px" uk-form-custom="target: true">
        <input type="file" name="image">
    <input class="uk-input uk-form-width-medium" type="text" placeholder="{{ $type!=null?$type->imageurl:(old('imageurl')!=null?old('imageurl'):'Select file') }}" disabled>
    @if($type!=null&&$type->imageurl!=null)
    <div><img style="width:200px;height:200px" src="{{ asset('images/').'/'.$type->imageurl }}" alt=""></div>
    @endif
    </div>
    <!-- <button class="uk-button uk-button-default">Submit</button> -->
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">{{ __('Detail') }}</label>
    <div class="uk-form-controls"><textarea class="uk-textarea" name="detail">{{ $type!=null?$type->detail:old('detail') }}</textarea></div>
    </div>
    
<input type="submit" value="{{$type!=null?'Update':'Save'}}" class="uk-input uk-button-primary">
    </div>
    </form>
@endsection