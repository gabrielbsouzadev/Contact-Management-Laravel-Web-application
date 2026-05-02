<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('contact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation Logic
        $request->validate([
            'name' => [
                'required', 
                'string', 
                'min:5', 
                'max:255', 
                // Blocks numbers, special chars, and double spaces. Supports accents.
                'regex:/^[a-zA-ZÀ-ÿ]+(?: [a-zA-ZÀ-ÿ]+)*$/'
            ],
            'contact' => ['required', 'digits:9'],
            'email' => ['required', 'email', 'unique:contacts,email'],
        ], [
            'name.regex' => 'The name cannot contain numbers or special characters.',
            'contact.digits' => 'The contact must be exactly 9 digits.',
        ]);

        // 2. Create the Contact
        Contact::create($request->only(['name', 'contact', 'email']));

        // 3. Redirect back with success message
        return redirect()->back()->with('success', 'Contact created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
