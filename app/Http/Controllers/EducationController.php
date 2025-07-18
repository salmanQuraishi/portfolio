<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;

class EducationController extends Controller
{
    public function index(){
        return view('admin/education');
    }
    public function view(){
        $alleducation = Education::get()->all();
        $data = compact('alleducation');
        return view('admin/vieweducation')->with($data);
    }
    public function store(Request $request){

        $request->validate([
            'title' => 'required|max:50',
            'university' => 'required|min:5|max:50',
            'year' => 'required',
            'status' => 'required|in:show,hide',
        ]);
        
        $education = new Education();
        $education->title = $request->title;
        $education->university = $request->university;
        $education->year = $request->year;
        $education->status = $request->status;

        $education->save();

        return redirect()->back()->with('message', 'education Create Successfully!');
    }
    public function edit($id)
    {
        $education = Education::findOrFail($id);
        $alleducation = Education::get()->all();
        return view('admin/education', compact('education','alleducation'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'university' => 'required|min:5|max:50',
            'year' => 'required',
            'status' => 'required|in:show,hide',
        ]);

        $education = Education::findOrFail($id);
        $education->title = $request->title;
        $education->university = $request->university;
        $education->year = $request->year;
        $education->status = $request->status;

        $education->save();

        return redirect()->back()->with('message', 'education updated Successfully!');
    }
}
