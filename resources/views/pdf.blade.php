<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Order - {{ $order[0]->id }}</title>
    <!-- Fonts -->
    
    <style>
.showtable{
    width:100%;
    margin-top:20px;
    border-collapse: collapse!important;
}
.showtable tr:nth-of-type(odd){
    background-color: #f9f9f9;
    border-top: 1px solid #000!important;
    border-bottom: 1px solid #929292;
}
.showtable td{
    padding:8px;
}
    </style>
</head>
<body>
    <div>
        <div style="text-align:center;width:100%;font-size:20px">{{ __('Order').' - '.$order[0]->id }}</div>
        <div>
            <table class="showtable">
                <tr>
                    <td>{{ __('Subscriber') }}</td>
                    <td>{{ $order[0]->username }}</td>
                </tr>
                <tr>
                    <td>{{ __('Email') }}</td>
                    <td>{{ $order[0]->useremail }}</td>
                </tr>
                <tr>
                    <td>{{ __('Branch name') }}</td>
                    <td>{{ $order[0]->branchname }}</td>
                </tr>
                <tr>
                    <td>{{ __('Branch location') }}</td>
                    <td>{{ $order[0]->location }}</td>
                </tr>
                <tr>
                    <td>{{ __('Branch coordinate') }}</td>
                    <td>{{ $order[0]->coordinate }}</td>
                </tr>
                <tr>
                    <td>{{ __('Deliver date') }}</td>
                    <td>{{ $order[0]->recdate }}</td>
                </tr>
                <tr>
                    <td>{{ __('Description') }}</td>
                    <td>{{ $order[0]->description }}</td>
                </tr>
            </table>
        </div>
        <div>
            <table class="showtable">
                <tr>
                    <th>{{__('Number')}}</th>
                    <th>{{__('Image')}}</th>
                    <th>{{ __('Article Number') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{__('Barcode')}}</th>
                    <th>{{ __('Quantity') }}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Total')}}</th>
                </tr>
                @php($sum_tot = 0)
                @foreach($suborder as $num => $item)
                @php($sum_tot+=$item->price*$item->quantity)
                <tr>
                    <td>{{$num+1}}</td>
                    <td><img height="50px" src="{{public_path('images/'.$item->imageurl)}}" alt="Product image"></td>
                    <td>{{$item->article_number}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->barcode}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>SEK {{number_format($item->price,2)}}</td>
                    <td>SEK {{number_format($item->quantity*$item->price,2)}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <hr>
 
            <table style="margin-top:50px;float:right">
                <tr style="border-top:1px solid #929292">
                    <td>{{__('Sub Total')}}:</td>
                    <td style="text-align:right;font-size:18px;width:250px">SEK {{number_format($sum_tot,2)}}</td>
                </tr>
                <tr style="border-top:1px solid #929292">
                    <td>{{__('VAT')}}:</td>
                    <td style="text-align:right;font-size:18px;width:250px">SEK {{number_format(($sum_tot*12/100),2)}}</td>
                </tr>
                <tr style="border-top:1px solid #929292">
                    <td style="font-weight:bold">{{__('Total')}}:</td>
                    <td style="text-align:right;font-size:18px;width:250px;font-weight:bold">SEK {{number_format(($sum_tot*12/100+$sum_tot),2)}}</td>
                </tr>
            </table>
        
    </div>
</body>
</body>
</html>