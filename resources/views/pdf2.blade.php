<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
  <link rel="stylesheet" href="{{public_path('css/pdf.css')}}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
      <img src="{{public_path('images/logo.png')}}">
      </div>
      <div id="company">
        <h2 class="name">Eanplock</h2>
        <div>Eanplock Ethnic Adviser Norden AB </div>
        <div>Fagerstagatan 5 163 53 Spånga, Sweden</div>
        <div>+46 (0) 41024741</div>
        <div><a href="mailto:info@eanplock.se">info@eanplock.se</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE FROM:</div>
          <h2 class="name">{{ $order[0]->username }}</h2>
        <div class="email"><a href="mailto:{{$order[0]->useremail}}">{{$order[0]->useremail}}</a></div>
        </div>
        <div id="invoice">
        <h1>{{__('Order').' - '.$order[0]->id}}</h1>
        <div>{{__('Branch name').': '.$order[0]->branchname}}</div>
        <div>{{__('Branch location').': '.$order[0]->location}}</div>
        <div>{{__('Branch coordinate').': '.$order[0]->coordinate}}</div>
        <div class="date">{{__('Ordered date').': '.$order[0]->createddate}}</div>
        <div class="date">{{__('Due date').': '.$order[0]->recdate}}</div>
        
        </div>
      </div>
      <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="image">{{__('Image')}}</th>
            <th>{{ __('Article Number') }}</th>
            <th class="name">{{ __('Name') }}</th>
            <th>{{__('Barcode')}}</th>
            <th class="unit">{{__('Price')}}</th>
            <th class="qty">{{ __('Quantity') }}</th>
            <th class="total">{{__('Total')}}</th>
          </tr>
        </thead>
        <tbody>
          @php($sum_tot = 0)
                @foreach($suborder as $num => $item)
                @php($sum_tot+=$item->price*$item->quantity)
                <tr>
                    <td class="no">{{$num+1}}</td>
                    <td class="image"><img height="50px" src="{{public_path('images/'.$item->imageurl)}}" alt="Product image"></td>
                    <td>{{$item->article_number}}</td>
                    <td class="name">{{$item->name}}</td>
                    <td>{{$item->barcode}}</td>
                    <td class="unit">SEK {{number_format($item->price,2)}}</td>
                    <td class="qty">{{$item->quantity}}</td>
                    <td class="total">SEK {{number_format($item->quantity*$item->price,2)}}</td>
                </tr>
                @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5"></td>
            <td colspan="2">{{__('Sub Total')}}</td>
            <td>SEK {{number_format($sum_tot,2)}}</td>
          </tr>
          <tr>
            <td colspan="5"></td>
            <td colspan="2">{{__('VAT')}}</td>
            <td>SEK {{number_format(($sum_tot*12/100),2)}}</td>
          </tr>
          <tr>
            <td colspan="5"></td>
            <td colspan="2">{{__('Total')}}</td>
            <td>SEK {{number_format(($sum_tot*12/100+$sum_tot),2)}}</td>
          </tr>
        </tfoot>
      </table>
    <div id="thanks">{{__('Thank you!')}}</div>
      <div id="notices">
        <div>NOTICE:</div>
      <div class="notice">{{$order[0]->description}}</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>