<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactEnquiryController extends Controller
{
    public function list($type)
    {

        $enquiry = ($type === 'all') 
            ? Contact::with('service')->get() 
            : Contact::with('service')->where('status', $type)->get();

            // dd($enquiry);

        return view('admin.view-enquery', compact('enquiry'));
    }
    public function updateStatus(Request $request, $id)
    {
        $enquiry = Contact::findOrFail($id);
        $enquiry->status = $request->status;
        $enquiry->save();

        return response()->json(['success' => true]);
    }

}