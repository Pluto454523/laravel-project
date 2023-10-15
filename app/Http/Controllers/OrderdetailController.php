<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class OrderdetailController extends Controller
{
    public function viewDetail($id) {
        $order = Order::find($id);
        $detail = Order_detail::where('order_id', 'like' , '%'.$order->id.'%')->get();
        
        $detail_product = array();
        
        foreach($detail as $c){
            $id = $c->product->id;
            $name = $c->product->name;
            $price = $c->product->price;
            $qty = $c->qty;
            
            $detail_product[$id] = array(
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'qty' => $qty
            );
        }
        // return compact('detail_product');
        return view('order/detail', compact('order', 'detail_product'));
        
    }

    function update($id , $status){
        $order = Order::find($id);
        $order->status = $status;
        $order->save();

        // return compact('order');
        return redirect('/order');
    }


   


   
    
}