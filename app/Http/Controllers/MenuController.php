<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{   
    public function add_menu(){
        return view('admin/add-menu');
    }
    public function insert_menu(Request $request){
        $request->validate([
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_status' => 'required|in:show,hide'
        ]);
        $menu = new Menu;
        $menu->menu_name = $request['menu_name'];
        $menu->menu_link = $request['menu_link'];
        $menu->menu_status = $request['menu_status'];
        $menu->save();
        return redirect('admin/add/menu')->with('message','Menu Added Successfull!');
    }
    public function select_menu(){
        $menu = Menu::all();
        $data = compact('menu');
        return view('admin/view-menu')->with($data);
    }
    public function edit_menu($id){
        $menu = Menu::find($id);
        if(is_null($menu)){
            return redirect('/admin/view-menu');
        }else{
            $data = compact('menu');
            return view('admin/update-menu')->with($data);
        }
    }
    public function update_menu($id,Request $request){
        $menu = Menu::find($id);
        $request->validate([
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_status' => 'required|in:show,hide'
        ]);
        $menu->menu_name = $request['menu_name'];
        $menu->menu_link = $request['menu_link'];
        $menu->menu_status = $request['menu_status'];
        $menu->save();
        return redirect('/admin/menu');
    }
    public function delete_menu($id){
        $menu = Menu::find($id);
        if(!is_null($menu)){
            $menu->delete();
        }
        return redirect('/admin/view-menu');
    }
}
