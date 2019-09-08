
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
            <th class="text-center">Product Number</th>
            <th class="text-center">Name</th>
            <th class="text-center">Image</th>
            <th class="text-center">Barcode</th>
            <th class="text-center">Price</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Total</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($order as $x => $item)
    <tr style="cursor: pointer" onclick="location.href='{{ route('order.show',$item->id) }}'" class="item{{$item->id}}">
            <td class="uk-text-center">{{$x+1}}</td>
            <td class="uk-text-center">{{$item->productid}}</td>
            <td class="uk-text-center">{{$item->name}}</td>
    <td class="uk-text-center"><img style="height:50px" src="{{ asset('images/'.$item->imageurl) }}" alt=""></td>
            <td class="uk-text-center">{{$item->barcode}}</td>
            <td class="uk-text-center">{{$item->price}}</td>
            <td class="uk-text-center">{{$item->quantity}}</td>
            <td class="uk-text-center">{{$item->price*$item->quantity}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection