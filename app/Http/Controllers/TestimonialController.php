<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index(){
        return view('admin/testimonial');
    }
    public function view(){
        $allTestimonial = Testimonial::get()->all();
        $data = compact('allTestimonial');
        return view('admin/viewtestimonial')->with($data);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:show,hide',
        ]);
    
        $Testimonial = new Testimonial();
        $Testimonial->title = $request->title;
        $Testimonial->short_desc = $request->short_desc;
        $Testimonial->description = $request->description;
        if ($request->hasFile('image')) {
            $img_name = 'testimonial' . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/testimonial/'), $img_name);
            $Testimonial->image = 'dynamic/testimonial/' . $img_name;
        }
        if ($request->hasFile('logo')) {
            $img_name2 = 'testimoniallogo' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('dynamic/testimonial/'), $img_name2);
            $Testimonial->logo = 'dynamic/testimonial/' . $img_name2;
        }
        $Testimonial->status = $request->status;
        $Testimonial->save();
        return redirect()->back()->with('message', 'Testimonial Created Successfully!');
    }
    
    public function edit($id)
    {
        $Testimonial = Testimonial::findOrFail($id);
        return view('admin/testimonial', compact('Testimonial'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:show,hide',
        ]);
        $Testimonial = Testimonial::findOrFail($id);
        $Testimonial->title = $request->title;
        $Testimonial->short_desc = $request->short_desc;
        $Testimonial->description = $request->description;
        if ($request->hasFile('image')) {
            $img_name = 'testimonial' . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/testimonial/'), $img_name);
            $Testimonial->image = 'dynamic/testimonial/' . $img_name;
        }
        if ($request->hasFile('logo')) {
            $img_name2 = 'testimoniallogo' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('dynamic/testimonial/'), $img_name2);
            $Testimonial->logo = 'dynamic/testimonial/' . $img_name2;
        }
        $Testimonial->status = $request->status;
        $Testimonial->save();
        return redirect()->back()->with('message', 'Testimonial updated Successfully!');
    }
}