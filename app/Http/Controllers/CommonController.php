<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Menu;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Skills;
use App\Models\Testimonial;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\WebSetting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class CommonController extends Controller
{
    public function contactEnquiry(Request $request){
        $validator = Validator::make($request->all(), [
            'rowid' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->serviceid = Crypt::decrypt($request->rowid);
        $contact->message = $request->message;
        $contact->status = "pending";
        $contact->save();

        return response()->json(['message' => 'Your message has been sent successfully!']);
    }
    public function portfolioShow($id)
    {
        $portfolio = Portfolio::with(['category', 'galleries'])->findOrFail($id);

        return response()->json([
            'title' => $portfolio->title,
            'image' => asset($portfolio->image),
            'short_desc' => $portfolio->short_desc,
            'category' => $portfolio->category->title ?? 'Uncategorized',
            'client' => $portfolio->client ?? 'N/A',
            'start_date' => $portfolio->start_date ?? 'N/A',
            'designer' => $portfolio->designer ?? 'N/A',
            'description' => $portfolio->description ?? '',
            'gallery' => $portfolio->galleries->map(function ($gallery) {
                return asset($gallery->image);
            }),
        ]);
    }

}