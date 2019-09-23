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
        foreach(Session::get('cart') as $id => $item){
            $total += $item['quantity']*$item['inprice'];
            $suborder = new Suborder();
            $suborder->orderid = $orderid;
            $suborder->productid = $item['id'];
            $suborder->quantity = $item['quantity'];
            $suborder->price = $item['inprice'];
            $suborder->createddate = date('Y-m-d');
            $suborder->save();
        }
        $order = Order::find($orderid);
        $order->total = ($total*12/100)+$total;
        $order->save();
        $user = Auth::user();
        $branch = Branch::find(request('branch'));
        $data = [];
        $data['branch'] = $branch->name;
        $data['recdate'] = request('orderdate');
        Mail::send('mail', ['data' => $data], function ($m) use ($user,$orderid) {
            $m->from('bilguunerdeneb@gmail.com', 'Order - '.$orderid)
            ->attachData($this->downloadpdf($orderid), "order_".$orderid.".pdf")
            ->to('bilguunerdeneb@gmail.com', $user->name)
            ->subject('Order - '.$orderid);
        });
        Session::forget('cart');
        return redirect()->back()->with(['status' => 'Successfully ordered.']);
    }
    }
    public function list(){
        // $asd = $this->downloadpdf(1);
        // header("Content-Type: application/pdf");
        // echo ($asd);
        // exit;
        
        $order = DB::table('orders')->leftjoin('branch','branch.id','orders.branchid')
        ->leftjoin('users','users.id','orders.user')
        ->select('orders.*','users.name as username','branch.name as branchname')
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
