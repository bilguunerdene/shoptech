@extends('layouts.app')

@section('content')
<div class="uk-container uk-container-expand">
    <div class="uk-text-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-scrollspy="cls: uk-animation-slide-bottom; target: .uk-card; delay: 300; repeat: true" uk-grid>
        
     @foreach($product as $x => $item)
    <div>
        <div class="uk-card uk-card-default uk-card-body">
            <div>
                <div class="image uk-display-inline-block">
                <img style="width:150px;max-height:140px" src="{{asset('images').'/'.$item->imageurl}}" alt="">
                </div>
                <div class="uk-text-left">
                    <span>{{$item->barcode}}</span>
                </div>
                <div class="price uk-text-right">
                    <span class="uk-text-bold uk-text-emphasis">SEK {{$item->price}}</span>
                </div>
                <div class="uk-text-center">
                    <div>{{$item->name}}</div>
                    <div>{{$item->cnt}} per one package</div>
                </div>
                <div class="pcontroller uk-margin" uk-grid>
                    <div class="uk-width-1-3 uk-width-medium-1-4"><div class="addbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="minusval({{$item->id}},{{$item->cnt}})"><span uk-icon="minus"></span></div></div>
                    <div class="uk-width-1-3 uk-width-medium-2-4"><input id="inputbtn{{$item->id}}" type="text" class="uk-input inputbtn" value="0"></div>
                    <div class="uk-width-1-3 uk-width-medium-1-4"><div class="minusbtn btncontrol uk-border-circle uk-link uk-text-muted" onclick="addval({{$item->id}},{{$item->cnt}})"><span uk-icon="plus"></span></div></div>
                </div>
            </div>
        </div>
    </div>
    @endforeach 
</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
function minusval(id,quantity){
    $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())-quantity);
}
function addval(id,quantity){
    $.ajax({
        "url": '{{ url("update-cart") }}',
        "type":"POST",
        "data": { "_token": "{{ csrf_token() }}","id":id, "quantity":quantity},
        "success":()=>{
            $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())+quantity);
        }
    });
}
</script>
@endsection