<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skills;

class SkillsController extends Controller
{
    public function index(){
        return view('admin/skills');
    }
    public function view(){
        $allskills = Skills::get()->all();
        $data = compact('allskills');
        return view('admin/viewskills')->with($data);
    }
    public function store(Request $request){

        $request->validate([
            'title' => 'required',
            'percent' => 'required|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:show,hide',
        ]);
        
        $skills = new Skills();
        $skills->title = $request->title;
        $skills->percent = $request->percent;
        $skills->percent = $request->percent;
        if($request->image != NULL || $request->image != 0)
        {
            $img_name2 = 'skills'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/skills/'), $img_name2);
            $skills->image = 'dynamic/skills/'.$img_name2;
        }
        $skills->status = $request->status;

        $skills->save();

        return redirect()->back()->with('message', 'Skills Create Successfully!');
    }
    public function edit($id)
    {
        $skills = Skills::findOrFail($id);
        return view('admin/skills', compact('skills'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'percent' => 'required|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        $Skills = Skills::findOrFail($id);
        $Skills->title = $request->title;
        $Skills->percent = $request->percent;
        $Skills->percent = $request->percent;
        if($request->image != NULL || $request->image != 0)
        {
            $img_name2 = 'skills'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/skills/'), $img_name2);
            $Skills->image = 'dynamic/skills/'.$img_name2;
        }
        $Skills->status = $request->status;

        $Skills->save();

        return redirect()->back()->with('message', 'Skills updated Successfully!');
    }
}
