@extends('layouts.app')

@section('content')

<div class="uk-container uk-container-expand">
   <div class="alltypes uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-grid>
        @foreach($country as $key => $item)
            <div class="uk-card uk-card-default uk-card-body">
                <a href="{{ route('filter','countryId='.$item->id) }}" class="uk-link-reset">
                    <div class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url(images/{{$item->imageurl}});">
                    <p class="uk-h2 " style="color:white">{{ $item->name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
        @foreach($type as $key => $item)
            <div class="uk-card uk-card-default uk-card-body">
                <a href="{{ route('filter','type='.$item->id) }}" class="uk-link-reset">
                    <div class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url(images/{{$item->imageurl}});">
                    <p class="uk-h2 " style="color:white">{{ $item->name }}</p>
                    </div>
                </a>
            </div>
        @endforeach
   </div>

</div>

@endsection
