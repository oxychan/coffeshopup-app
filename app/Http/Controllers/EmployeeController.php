<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
            $employee = Employee::with('user')->get();
            $paginate = Employee::orderBy('id', 'asc')->paginate(5);
            return view('admin.employee.index', ['employee'=>$employee,'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view('admin.employee.create', ['user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'sex' => 'required',
        ]);
        
        $employee = new Employee;
        $employee->date_of_birth = $request->get('date_of_birth'); 
        $employee->address = $request->get('address'); 
        $employee->phone = $request->get('phone'); 
        $employee->sex = $request->get('sex'); 
        
        $user = new User;
        $user->id = $request->get('user');
        
        $employee->user()->associate($user);
        $employee->save();

        return redirect()->route('employee.index')
        ->with('success', 'Employee Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function show($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('admin.employee.detail', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('admin.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'sex' => 'required',
        ]);
        
        $employee = Employee::where('id', $id)->first();
        $employee->user_id = $request->get('user_id'); 
        $employee->date_of_birth = $request->get('date_of_birth'); 
        $employee->address = $request->get('address'); 
        $employee->phone = $request->get('phone'); 
        $employee->sex = $request->get('sex'); 
        $employee->save();
        
        return redirect()->route('employee.index')
        ->with('success', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        
        return redirect()->route('employee.index')
        ->with('success', 'Employee Deleted Successfully'); 
    }
}