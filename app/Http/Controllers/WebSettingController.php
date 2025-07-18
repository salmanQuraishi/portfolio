<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\WebSetting;
use App\Models\Profile;

class WebSettingController extends Controller
{
    public function setting(){
        $setting = WebSetting::find(['id'=>1]);
        $data = compact('setting');
        return view('admin/websetting')->with($data);
    }
    public function update_setting(Request $request){
        $request->validate([
            'title' => 'required',
            'email' => 'email|required',
            'phone' => 'digits:10',
            'preloader' => 'string|required|min:6|max:15',
            'address' => 'required'
        ]);
        $websetting = WebSetting::find(1);
        if($request['logo'] != NULL || $request['logo'] != 0)
        {
            $img_name = 'logo'.time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('dynamic/logos/'), $img_name);
            $websetting->logo = 'dynamic/logos/'.$img_name;
        }
        if($request->favicon != NULL || $request->favicon != 0)
        {
            $img_name2 = 'favicon'.time().'.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('dynamic/favicon/'), $img_name2);
            $websetting->favicon = 'dynamic/favicon/'.$img_name2;
        }
        if($request['logo_dark'] != NULL || $request['logo_dark'] != 0)
        {
            $img_name = 'logo'.time().'.'.$request->logo_dark->getClientOriginalExtension();
            $request->logo_dark->move(public_path('dynamic/logos/'), $img_name);
            $websetting->logo_dark = 'dynamic/logos/'.$img_name;
        }
        if($request->favicon_dark != NULL || $request->favicon_dark != 0)
        {
            $img_name2 = 'favicon'.time().'.'.$request->favicon_dark->getClientOriginalExtension();
            $request->favicon_dark->move(public_path('dynamic/favicon/'), $img_name2);
            $websetting->favicon_dark = 'dynamic/favicon/'.$img_name2;
        }
        $websetting->title = $request['title'];
        $websetting->email = $request['email'];
        $websetting->phone = $request['phone'];
        $websetting->preloader = $request['preloader'];
        $websetting->address = $request['address'];
        $websetting->save();
        return redirect()->back()->with('message', 'WebSetting Update Successfully!');
    }
    public function profile(){
        $profile = Profile::find(['id'=>1]);
        $data = compact('profile');
        return view('admin/profile')->with($data);
    }
    public function updateprofile(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'greeting' => 'required|string|max:255',
            'description' => 'nullable|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|mimes:pdf|max:10240',
            'experience' => 'nullable|string',
            'project' => 'nullable|string',
            'client' => 'nullable|string',
            'support_hours' => 'nullable|string',
            'links' => 'nullable|array',
            'links.*' => 'nullable|url'
        ]);

        // Find the profile (assumes there's a profile with id 1)
        $profile = Profile::find(1);

        // Update profile fields
        $profile->title = $request->input('title');
        $profile->heading = $request->input('heading');
        $profile->greeting = $request->input('greeting');
        $profile->description = $request->input('description');
        $profile->experience = $request->input('experience');
        $profile->project = $request->input('project');
        $profile->client = $request->input('client');
        $profile->support_hours = $request->input('support_hours');

        if($request['profile'] != NULL || $request['profile'] != 0)
        {
            $img_name = 'profile'.time().'.'.$request->profile->getClientOriginalExtension();
            $request->profile->move(public_path('dynamic/profile/'), $img_name);
            $profile->profile = 'dynamic/profile/'.$img_name;
        }

        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            // Generate a unique file name based on the current time and original extension
            $cvFile = 'cv' . time() . '.' . $request->file('cv')->getClientOriginalExtension();
        
            // Move the uploaded file to the desired folder
            $request->file('cv')->move(public_path('dynamic/cv/'), $cvFile);
        
            // Store the relative path in the database
            $profile->cv = 'dynamic/cv/' . $cvFile;
        }

        $profile->links = json_encode($request->links, JSON_UNESCAPED_SLASHES);
        
        // Save the profile
        $profile->save();

        // Redirect back with a success message
        return redirect()->route('admin/profile')->with('success', 'Profile updated successfully.');
    }
    

}
