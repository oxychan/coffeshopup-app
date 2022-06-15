<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Menu::where('id', 'like', '%'.request('search').'%')
                    ->orwhere('name', 'like', '%'.request('search').'%')
                    ->orwhere('price', 'like', '%'.request('search').'%')
                    ->orwhere('stock', 'like', '%'.request('search').'%')
                    ->paginate(5);
            return view('employee.staff-dapur.menu.index', ['paginate'=>$paginate]);
        }
        else {
            $menu = Menu::all();
            $paginate = Menu::orderBy('id', 'asc')->paginate(5);
            return view('employee.staff-dapur.menu.index', ['menu'=>$menu,'paginate'=>$paginate]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.staff-dapur.menu.create');
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
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        } else {
            $image_name = NULL;
        }
        
        $menu = new Menu;
        $menu->name = $request->get('name'); 
        $menu->price = $request->get('price'); 
        $menu->stock = $request->get('stock'); 
        $menu->menu_photo_path = $image_name;
        $menu->save();

        return redirect()->route('menu.index')
        ->with('success', 'Menu Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('employee.staff-dapur.menu.detail', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('employee.staff-dapur.menu.edit', compact('menu'));
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
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $menu = Menu::where('id', $id)->first();
        $menu->name = $request->get('name');
        $menu->price = $request->get('price');
        $menu->stock = $request->get('stock');
        $menu->save();
        
        if ($request->file('image')) {
            if ($menu->menu_photo_path && file_exists(storage_path('app/public/'.$menu->menu_photo_path))) {
                Storage::delete('public/'.$menu->menu_photo_path);
            } 
            $image_name = $request->file('image')->store('images', 'public');
        } else {
            $image_name = $menu->menu_photo_path;
        }
        $menu->menu_photo_path = $image_name;
        $menu->save();
        
        return redirect()->route('menu.index')
        ->with('success', 'Menu Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::where('id', $id)->delete();
        
        return redirect()->route('menu.index')
        ->with('success', 'Menu Deleted Successfully'); 
    }

    public function getBeverageData(Request $request)
    {
        if( $request->ajax() ) 
        {
            if ($request->get('query') != '') {
                $menus = Menu::where('type', 'beverage')
                    ->where('name', 'like', '%' . $request->get('query') .'%')
                    ->orWhere('type', 'like', '%' . $request->get('query') . '%')
                    ->get();
                return response()->json([
                    'menus'=>$menus,
                ]);
            } else {
                $menus = Menu::where('type', 'beverage')->get();
                return response()->json([
                    'menus'=>$menus,
                ]);
            }

        } 
       
    }

    public function getFoodData(Request $request)
    {
        if( $request->ajax() )
        {
            if ($request->get('query') != '') {
                $menus = Menu::where('type', 'food')
                    ->where('name', 'like', '%' . $request->get('query') .'%')
                    ->orWhere('type', 'like', '%' . $request->get('query') . '%')
                    ->get();
                return response()->json([
                    'menus'=>$menus,
                ]);
            } else {
                $menus = Menu::where('type', 'food')->get();
                return response()->json([
                    'menus'=>$menus,
                ]);
            }
        }
    }

}