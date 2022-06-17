<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Payment::where('id', 'like', '%'.request('search').'%')
                    ->orwhere('employee_id', 'like', '%'.request('search').'%')
                    ->orwhere('order_id', 'like', '%'.request('search').'%')
                    ->orwhere('payment', 'like', '%'.request('search').'%')
                    ->orwhere('change', 'like', '%'.request('search').'%')
                    ->paginate(5);
            return view('employee.kasir.payment.index', ['paginate'=>$paginate]);
        }
        $payment = Payment::with('order')->get();
        // $order = Order::with('orderDetail')->get();
        $paginate = Payment::orderBy('id', 'asc')->paginate(5);
        return view('employee.kasir.payment.index', ['payment'=>$payment,'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = Order::all();
        return view('employee.kasir.payment.create', ['order'=>$order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'order' => 'required',
            'payment' => 'required',
            'change' => 'required',
        ]);
        
        $payment = new Payment;
        $payment->employee_id = $request->get('employee_id');
        $payment->payment = $request->get('payment'); 
        $payment->change = $request->get('change');

        $order = new Order;
        $order->id = $request->get('order');
        
        $payment->order()->associate($order);
        $payment->save();
        
        return redirect()->route('payment.index')
        ->with('success', 'Payment Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::with('order')->where('id', $id)->first();
        // $orders = $payment->order->orderDetail;
        // dd($orders);

        return view('employee.kasir.payment.detail', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}