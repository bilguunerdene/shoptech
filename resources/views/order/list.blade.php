
@extends('order.settings')

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
            <th class="text-center">{{ __('Order Number') }}</th>
            <th class="text-center">{{ __('Branch') }}</th>
            <th class="text-center">{{ __('Description') }}</th>
            <th class="text-center">{{ __('User') }}</th>
            <th class="text-center">{{ __('Deliver date') }}</th>
            <th class="text-center">{{ __('Created') }}</th>
            <th class="text-center">{{ __('Total') }}</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($order as $x => $item)
    <tr style="cursor: pointer" onclick="location.href='{{ route('order.show',$item->id) }}'" class="item{{$item->id}}">
            <td class="uk-text-center">{{$x+1}}</td>
            <td class="uk-text-center">{{$item->id}}</td>
            <td class="uk-text-center">{{$item->branchname}}</td>
            <td class="uk-text-center">{{$item->description}}</td>
            <td class="uk-text-center">{{$item->username}}</td>
            <td class="uk-text-center">{{$item->recdate}}</td>
            <td class="uk-text-center">{{$item->createddate}}</td>
            <td class="uk-text-center">{{$item->total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection