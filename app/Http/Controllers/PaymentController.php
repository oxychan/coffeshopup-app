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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::where('id', $id)->first();
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