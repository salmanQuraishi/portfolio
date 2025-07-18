<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(){
        return view('admin/service');
    }
    public function service(){
        $service = Service::get()->all();
        $data = compact('service');
        return view('admin/viewservice')->with($data);
    }
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'status' => 'required|in:show,hide',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->short_desc = $request->short_desc;
        $service->description = $request->description;
        $service->status = $request->status;

        if($request->image != NULL || $request->image != 0)
        {
            $img_name = 'service'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/service/'), $img_name);
            $service->image = 'dynamic/service/'.$img_name;
        }

        // Save the new service
        $service->save();

        return redirect()->back()->with('message', 'Service Inserted Successfully!');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin/service', compact('service'));
    }
    public function update(Request $request, $id)
    {
        // Find the service by ID
        $service = Service::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
            'status' => 'required|in:show,hide',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);

        // Update the service details
        $service->title = $request->title;
        $service->short_desc = $request->short_desc;
        $service->description = $request->description;
        $service->status = $request->status;

        // Handle image upload if new image is provided
        if($request->image != NULL || $request->image != 0)
        {
            $img_name = 'service'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/service/'), $img_name);
            $service->image = 'dynamic/service/'.$img_name;
        }

        // Save the updated service
        $service->save();

        return redirect()->back()->with('message', 'Service Updated Successfully!');
    }


}
