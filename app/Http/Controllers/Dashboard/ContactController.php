<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('main.contacts');
        $contacts = Contact::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('subject', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(10);
        return view('dashboard.contacts.index', compact('title', 'contacts'));
    }

    public function show(Contact $contact)
    {
        $title = trans('main.contacts');
        return view('dashboard.contacts.show', compact('title', 'contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        toastr()->success(trans('main.data_deleted_successfully'));
        return redirect()->back();
    }
}
