<?php

namespace App\Http\Controllers;

use App\Events\NewMenuAdded;
use App\Menu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu.index');
    }
    public function get_data()
    {
        return Menu::all();
    }
    public function create()
    {
        return view('menu.create');
    }
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),
                [
                    'nama' => 'required',
                    'deskripsi' => 'required',
                    'harga' => 'required|numeric'
                ],
                [

                ]
            );
            if($validator->fails()){
                return response()->json([
                    'result' => 'fail',
                    'data' => $validator->errors(),
                    'status' => '400'
                ]);
            }
            $menu = new Menu();
            $menu->nama = $request->nama;
            $menu->deskripsi = $request->deskripsi;
            $menu->harga = $request->harga;
            $menu->save();
            broadcast(new NewMenuAdded($menu))->toOthers();
            return response()->json([
                'result' => 'success',
                'data' => $menu,
                'status' => '200'
            ]);

        }catch(Exception $e){
            return response()->json([
                'result' => 'error',
                'data' => $e,
                'status' => '500'
            ]);
        }
    }
    public function show(Menu $menu)
    {

    }
    public function edit(Menu $menu)
    {

    }
    public function update(Request $request, Menu $menu)
    {

    }
    public function destory(Menu $menu)
    {

    }

}
