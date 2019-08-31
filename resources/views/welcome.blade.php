@extends('layouts.app')

@section('content')

<div class="uk-container uk-container-expand">
   <div class="alltypes" uk-grid>
        @foreach($country as $key => $item)
            <div class="uk-card uk-card-default uk-card-body uk-width-1-4">
                <a href="{{ route('filter','countryId='.$item->id) }}" class="uk-link-reset">
                    <div class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url(images/download.jpg);">
                    <p class="uk-h2 " style="color:white">{{ $item->name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
        @foreach($type as $key => $item)
            <div class="uk-card uk-card-default uk-card-body uk-width-1-4">
                <a href="{{ route('filter','type='.$item->id) }}" class="uk-link-reset">
                    <div class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url(images/download.jpg);">
                    <p class="uk-h2 " style="color:white">{{ $item->name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
   </div>

</div>

@endsection
