@extends('settings')
@section('section')
            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    <form class="uk-form-horizontal" action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="uk-margin">
    <label class="uk-form-label" for="">Name</label>
    <div class="uk-form-controls"><input type="text" name="name" class="uk-input required"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Barcode</label>
    <div class="uk-form-controls"><input type="text" name="barcode" class="uk-input"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Price</label>
    <div class="uk-form-controls"><input type="text" name="price" class="uk-input"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Quantity per package</label>
    <div class="uk-form-controls"><input type="text" name="cnt" class="uk-input"></div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Type</label>
    <div class="uk-form-controls"><select class="uk-select" name="type" name="" id="">
    @foreach($type as $val)
    <option value="{{ $val->id }}">{{ $val->name }}</option>
    @endforeach
    </select></div>
    
    <div class="uk-margin">
    <label class="uk-form-label" for="">Image</label>
    <div class="uk-form-controls" style="margin-left:15px" uk-form-custom="target: true">
        <input type="file" name="image">
        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled>
    </div>
    <!-- <button class="uk-button uk-button-default">Submit</button> -->
    </div>
    <div class="uk-margin">
    <label class="uk-form-label" for="">Detail</label>
    <div class="uk-form-controls"><textarea class="uk-textarea" name="detail"></textarea></div>
    </div>
    
    <input type="submit" value="Save" class="uk-input uk-button-primary">
    </div>
    </form>
@endsection