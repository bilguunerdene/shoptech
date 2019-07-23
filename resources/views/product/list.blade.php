
@extends('settings')
@extends('layouts.script')

@section('section')

    <table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Type</th>
            <th class="text-center">Country</th>
            <th class="text-center">Price</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Created</th>
            <th class="uk-text-center">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product as $x => $item)
        <tr class="item{{$item->id}}">
            <td class="uk-text-center">{{$x+1}}</td>
            <td class="uk-text-center">{{$item->name}}</td>
            <td class="uk-text-center">{{$item->type}}</td>
            <td class="uk-text-center">{{$item->country}}</td>
            <td class="uk-text-center">{{$item->price}}</td>
            <td class="uk-text-center">{{$item->cnt}}</td>
            <td class="uk-text-center">{{$item->created_at}}</td>
        <td class="uk-text-center"><button onclick="window.location='{{route('product.edit',['id'=>$item->id])}}'" class="edit-modal btn btn-info"
            >
            <span uk-icon="pencil"></span>
        </button>
        <button onclick="deleteprod({{$item->id}})" class="delete-modal btn btn-danger"
            >
            <span uk-icon="trash"></span>
        </button></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection