<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use function Symfony\Component\String\b;

class AdminController extends Controller
{
    public function dashboard(){
        
        return view('admin.index');
    }
   
    public function  allOrders(){
        $orders=Order::all();
        return view('orders.all-orders', compact('orders'));
    }
    
    public function  delivered($id){
        $order=Order::find($id);
        $order->delivery_status = 'delivered';
        $order->payment_status = 'paid';
        $order->save();
        return redirect()->back();

    }
    
    public function printPdf($id){
      
        $order=Order::find($id);
        $pdf = Pdf::loadView('admin.report.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
      
       
    }
}
