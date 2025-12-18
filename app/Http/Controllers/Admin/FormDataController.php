<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuisnessMeeting as Meeting;
use App\Models\Contact as ModelsContact;
use App\Models\Contact;
use App\Models\VendorRegistration as VendorReg;
use Illuminate\Http\Request;

class FormDataController extends Controller
{
    public function indexVendors()
    {
        $vendors = VendorReg::latest()->get();

        return view('admin.FormData.vendorReg', compact('vendors'));
    }

    public function indexContacts()
    {
        $contacts = Contact::latest()->get();

        return view('admin.FormData.contactForm', compact('contacts'));
    }

    public function indexMeetings()
    {
        $meetings = Meeting::latest()->get();

        return view('admin.FormData.buisnessmeeting', compact('meetings'));
    }

    public function contact_me(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|number',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $data = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,

        ]);

        if ($data) {
            return redirect()->back()->with('success', 'Thanks For Connecting With Us!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again.');
        }
    }
}
