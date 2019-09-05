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
    <input type="hidden" name="id" value="{{$user!=null?$user->id:''}}">
    <div class="uk-margin">
    <label class="uk-form-label" for="">Name</label>
    <div class="uk-form-controls"><input type="text" name="name" value="{{ $user!=null?$user->name:old('name')}}" class="uk-input required"></div>
    </div>

    <div class="uk-margin">
    <label class="uk-form-label" for="">Email</label>
    <div class="uk-form-controls"><input type="text" name="name" value="{{ $user!=null?$user->name:old('name')}}" class="uk-input required"></div>
    </div>

    <div class="uk-margin">
    <label class="uk-form-label" for="">Permission</label>
    <div class="uk-form-controls"><select class="uk-select" name="permission" name="" id="">
        <option value="">- Choose an one -</option>
    @foreach($permission as $val)
    <option value="{{ $val->id }}" {{old('permission')==$val->id||($user!=null?$user->permissionId:'')==$val->id?'selected':''}}>{{ $val->name }}</option>
    @endforeach
    </select></div>
       
    <div class="uk-margin">
    <label class="uk-form-label" for="">Branch</label>
    <div class="uk-form-controls"><select class="uk-select" name="branch" name="" id="">
        <option value="">- Choose an one -</option>
    @foreach($branch as $val)
    <option value="{{ $val->id }}" {{old('branch')==$val->id||($user!=null?$user->branchid:'')==$val->id?'selected':''}}>{{ $val->name }}</option>
    @endforeach
    </select></div>

    <div class="uk-margin">
    <label class="uk-form-label" for="">Image</label>
    <div class="uk-form-controls" style="margin-left:15px" uk-form-custom="target: true">
        <input type="file" name="image">
    <input class="uk-input uk-form-width-medium" type="text" placeholder="{{ $user!=null?$user->imageurl:(old('imageurl')!=null?old('imageurl'):'Select file') }}" disabled>
    @if($user!=null&&$user->imageurl!=null)
    <div><img style="width:200px;height:200px" src="{{ asset('images/').'/'.$user->imageurl }}" alt=""></div>
    @endif
    </div>
    <!-- <button class="uk-button uk-button-default">Submit</button> -->
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Password</label>
    <div class="uk-form-controls"><input type="password" name="password" value="{{ $user!=null?'':old('password')}}" class="uk-input required"></div>
    </div>
    
<input type="submit" value="{{$user!=null?'Update':'Save'}}" class="uk-input uk-button-primary">
    </div>
    </form>
@endsection