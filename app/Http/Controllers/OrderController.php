<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use App\Order,App\Suborder,App\Branch;
use Validator,Redirect,Response,File,Form,DB,Auth,PDF,Mail;
class OrderController extends Controller
{
    public function index(){
        return view('order.settings');
    }
    public function store(){
        $rules = array (
            'branch' => 'required',
            'orderdate' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
        $orderid = DB::table('orders')->insertGetId(
            [ 'orderid' => 1,
              'createddate' => date('Y-m-d'),
              'user' => Auth::user()->id,
              'description' => request('description'),
              'recdate' => request('orderdate'),
              'branchid' => request('branch'),
              'status' => 1 ]
        );
        $total = 0;
        $articleno = [];
        $articlename = [];
        $noofitems = [];
        $priceexclvat = [];
        $vatpercent = [];
        $mainvat = env('MAIN_VAT','20');
        foreach(Session::get('cart') as $id => $item){
            $total += $item['quantity']*$item['inprice'];
            $suborder = new Suborder();
            $suborder->orderid = $orderid;
            $suborder->productid = $item['id'];
            $suborder->quantity = $item['quantity'];
            $suborder->price = $item['inprice'];
            $suborder->createddate = date('Y-m-d');
            $suborder->save();
            array_push($articleno,$item['id']);
            array_push($articlename,$item['name']);
            array_push($noofitems,$item['quantity']);
            array_push($priceexclvat,$item['inprice']);
            array_push($vatpercent,$mainvat);
        }
        $resp = $this->submitOrder($articleno,$articlename,$priceexclvat,$noofitems,$vatpercent);
        if($resp['result']!=1){
            return redirect()->back()->withErrors(['status' => 'Failed to send order to specter system.']);
        }
        $mailfrom = env('MAIL_USERNAME','admin@shop.eanplock.com');
        $mailto = env('MAIL_TO','bilguunerdeneb@gmail.com');
        $order = Order::find($orderid);
        $order->total = ($total*12/100)+$total;
        $order->save();
        $user = Auth::user();
        $branch = Branch::find(request('branch'));
        $data = [];
        $data['branch'] = $branch->name;
        $data['recdate'] = request('orderdate');
        // Mail::send('mail', ['data' => $data], function ($m) use ($user,$orderid,$mailfrom,$mailto) {
        //     $m->from($mailfrom, 'Order - '.$orderid)
        //     ->attachData($this->downloadpdf($orderid), "order_".$orderid.".pdf")
        //     ->to(explode(';',$mailto), $user->name)
        //     ->subject('Order - '.$orderid);
        // });
        Session::forget('cart');
        
        return redirect()->back()->with(['status' => 'Successfully ordered.']);
    }
    }
    public function submitOrder($articleno,$articlename,$priceexvat,$noofitems,$vatpercent){
        $userid = env('API_USERID','278');
        $userkey = env('API_USERKEY','3499d8a4bbff6bc7c9a748570050ea64');
        $sbmid = env('API_SBMID','2521');
        $intkey = env('API_INTKEY','0b7bddee-6d04-4459-acf1-8427a809ef07');
        $custid = env('API_CUSTID','109');
        $url = env('API_URL','https://api.specter.se/');
        $key = md5($intkey.(md5($userkey.$sbmid.$custid)));
        $fullurl = $url.'/putInfo.asp?action=newOrderSubmit&sbmId='.$sbmid.'&useXml=2&apiUserId='.$userid.'&key='.$key.'&customerId='.$custid;
        foreach($articleno as $key => $per){
            $fullurl .= '&articleNo_'.urlencode($key+1).'='.urlencode($per);
        }
        foreach($articlename as $key => $per){
            $fullurl .= '&articleName_'.urlencode($key+1).'='.urlencode($per);
        }
        foreach($priceexvat as $key => $per){
            $fullurl .= '&priceExclVAT_'.urlencode($key+1).'='.urlencode($per);
        }
        foreach($noofitems as $key => $per){
            $fullurl .= '&noOfItems_'.urlencode($key+1).'='.urlencode($per);
        }
        foreach($vatpercent as $key => $per){
            $fullurl .= '&vatPercent_'.urlencode($key+1).'='.urlencode($per);
        }
        
        
        $curl = curl_init();    
        curl_setopt($curl, CURLOPT_URL, $fullurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        
        $con = new \SimpleXMLElement($data);
        
        
        return (array)$con->APIresponse;
        
    }
    public function list(){
        // $asd = $this->downloadpdf(1);
        // header("Content-Type: application/pdf");
        // echo ($asd);
        // exit;
        
        $order = DB::table('orders')->leftjoin('branch','branch.id','orders.branchid')
        ->leftjoin('users','users.id','orders.user');

        
        if(Auth::user()->permissionId!=1){
            $order->where('orders.user','=',Auth::user()->id);
        }

        $order = $order->select('orders.*','users.name as username','branch.name as branchname')
        ->orderByRaw('createddate DESC')
        ->get();
        return view('order.list',compact('order'));
    }
    public function show($id){
        $orderid = $id;
        $order = DB::table('suborders')->leftjoin('products','products.id','suborders.productid')
        ->select('suborders.*','products.name','products.barcode','products.imageurl')->where('suborders.orderid',$id)->get();
        return view('order.show',compact('order','orderid'));
    }
    public function user(){
        return view('order.user');
    }
    public function downloadpdf($id){
        // This  $data array will be passed to our PDF blade
        $order = DB::table('orders')->leftjoin('branch','branch.id','orders.branchid')
        ->leftjoin('users','users.id','orders.user')
        ->select('orders.*','users.name as username','users.email as useremail','branch.name as branchname','branch.location','branch.coordinate','branch.imageurl as branchimage')->where('orders.id',$id)
        ->get();
        
        $suborder = DB::table('suborders')->leftjoin('products','products.id','suborders.productid')
        ->select('suborders.*','products.name','products.barcode','products.imageurl','products.article_number')->where('suborders.orderid',$id)->get();
       $data = [
        'order' => $order,
        'suborder' => $suborder
          ];
    //   print_r($data);exit;
      $pdf = PDF::loadView('pdf2', $data);  
      return $pdf->download('order.pdf');
    }
}
