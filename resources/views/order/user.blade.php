
@extends('order.settings')

@section('section')
                @if (session('status'))
                            <div class="alert {{ session('status')==0?'alert-success':'alert-danger' }}" role="alert">
                                {{ session('msg') }}
                            </div>
                        @endif
   <div class="uk-container uk-container-xsmall">
        <form class="uk-form-horizontal uk-margin-large">
       <div class="uk-text-center">
           <h3>{{ __('Account Details') }}</h3>
       </div>
       <div class="uk-margin">
            <label class="uk-form-label uk-text-right" for="form-horizontal-text">{{ __('Name') }}:</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-input" disabled value="{{ Auth::user()->name }}">
            </div>
        </div>
        <div class="uk-margin">
                <label class="uk-form-label uk-text-right" for="form-horizontal-text">{{ __('Email') }}:</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" disabled value="{{ Auth::user()->email }}">
                </div>
            </div>
        <div class="uk-margin">
                <label class="uk-form-label uk-text-right" for="form-horizontal-text">{{ __('Permission') }}:</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" disabled value="{{ Auth::user()->permissionId }}">
                </div>
            </div>
        <div class="uk-margin">
                <label class="uk-form-label uk-text-right" for="form-horizontal-text">{{ __('Last login IP address') }}:</label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" disabled value="{{ Auth::user()->lastipaddr }}">
                </div>
            </div>
    </form>
   </div>

@endsection