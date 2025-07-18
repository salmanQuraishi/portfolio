<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index(){
        return view('admin/experience');
    }
    public function view(){
        $allexperience = Experience::get()->all();
        $data = compact('allexperience');
        return view('admin/viewexperience')->with($data);
    }
    public function store(Request $request){

        $request->validate([
            'title' => 'required|min:10|max:50',
            'company' => 'required|min:5|max:50',
            'year' => 'required',
            'status' => 'required|in:show,hide',
        ]);
        
        $experience = new Experience();
        $experience->title = $request->title;
        $experience->company = $request->company;
        $experience->year = $request->year;
        $experience->status = $request->status;

        $experience->save();

        return redirect()->back()->with('message', 'Experience Create Successfully!');
    }
    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        $allexperience = Experience::get()->all();
        return view('admin/experience', compact('experience','allexperience'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:10|max:50',
            'company' => 'required|min:5|max:50',
            'year' => 'required',
            'status' => 'required|in:show,hide',
        ]);

        $experience = Experience::findOrFail($id);
        $experience->title = $request->title;
        $experience->company = $request->company;
        $experience->year = $request->year;
        $experience->status = $request->status;

        $experience->save();

        return redirect()->back()->with('message', 'Experience updated Successfully!');
    }
}
