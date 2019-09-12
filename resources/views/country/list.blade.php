
@extends('settings')
@extends('layouts.script')

@section('section')
                @if (session('status'))
                            <div class="alert {{ session('status')==0?'alert-success':'alert-danger' }}" role="alert">
                                {{ session('msg') }}
                            </div>
                        @endif
    <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">{{ __('Name') }}</th>
            <th class="text-center">{{ __('Image') }}</th>
            <th class="text-center">{{ __('Countrycode') }}</th>
            <th class="text-center">{{ __('Created') }}</th>
            <th class="uk-text-center">{{ __('Edit') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($country as $x => $item)
        <tr class="item{{$item->id}}">
            <td class="uk-text-center">{{$x+1}}</td>
            <td class="uk-text-center">{{$item->name}}</td>
            <td class="uk-text-center"><img style="height:50px" src="images/{{$item->imageurl}}" alt=""></td>
            <td class="uk-text-center">{{$item->countrycode}}</td>
            <td class="uk-text-center">{{$item->created_at}}</td>
        <td class="uk-text-center">
        
        <!-- <a href="{{route('product.edit',['id'=>$item->id])}}"><div class="btn btn-info"><span uk-icon="pencil"></span></div></a>
        <a href="{{route('product.destroy',['id'=>$item->id])}}"><div class="btn btn-danger"><span uk-icon="trash"></span></div></a> -->
        <form class="uk-display-inline" action="{{route('country.edit',['id' => $item->id])}}" method="GET">
        @csrf
        <button class="btn btn-info" type="submit"><span uk-icon="pencil"></span></button>
        </form>
        <form class="uk-display-inline" action="{{route('country.destroy',['id' => $item->id])}}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger" type="submit"><span uk-icon="trash"></span></button>
        </form>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection