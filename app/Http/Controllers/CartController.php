<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; //ต้องมี
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    public function viewCart()
    {
        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }
        return view('cart/index', compact('cart_items'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }

        $qty = 0;
        if (array_key_exists($product->id, $cart_items)) {
            $qty = $cart_items[$product->id]['qty'];
        }

        $cart_items[$product['id']] = array(
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'image_url' => $product->image_url,
            'qty' => $qty + 1,
        );
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }
    public function deleteCart($id)
    {
        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }
        unset($cart_items[$id]);
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }
    public function updateCart($id, $qty)
    {
        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }
        $cart_items[$id]['qty'] = $qty;
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }
    public function checkout()
    {
        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }
        return view('cart/checkout', compact('cart_items'));
    }

    public function complete(Request $request)
    { //อย่าลืม use Request ด้วย
        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }
        $cust_name = $request->cust_name;
        $cust_email = $request->cust_email;
        $po_date = date("Y-m-d H:i:s");

        
        // สุ่มค่า PO
        // $randNum = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
        // $po_no = 'PO'.date("Ymd").$randNum;
        // Session::put('po_no', $po_no);

        // ค่า PO แบบบวกเพิ่ม รีเซ็ตตามวัน
        $po_no = 'PO'.date("Ymd");
        $order = Order::where('ref_id', 'like' , '%'.$po_no.'%')->get();
        $order_count = $order->count();
        $po_no = $po_no.($order_count+1);
        Session::put('po_no', $po_no);
        
        $total_amount = 0;
        foreach ($cart_items as $c) {
            $total_amount += $c['price'] * $c['qty'];
        }
        $html_output = view(
            'cart/complete',
            compact(
                'cart_items',
                'cust_name',
                'cust_email',
                'po_no',
                'po_date',
                'total_amount'
            )
        )->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output('output.pdf', 'I');
        return $resp->withHeader("Content-type", "application/pdf");

        // return view(
        //     'cart/complete',
        //     compact(
        //         'cart_items',
        //         'cust_name',
        //         'cust_email',
        //         'po_no',
        //         'po_date',
        //         'total_amount'
        //     )
        // );
    }

    public function finish_order()
    {
        $cart_items = Session::get('cart_items');
        if (is_null($cart_items)) {
            $cart_items = array();
        }
        Session::remove('cart_items');
        Session::remove('po_no');
        return redirect('/home');
    }
}