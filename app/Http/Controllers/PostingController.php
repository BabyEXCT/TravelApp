<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    // Display the form for creating a new posting
    public function create()
    {
        return view('Admin.posting.create');
    }

    // Store a newly created posting in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new posting
        Posting::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // Fetch all postings to display in the view
        $postings = Posting::all();

        // Return the view with the postings and a success message
        return view('Admin.posting.index', [
            'postings' => $postings,
            'success' => 'Posting created successfully!'
        ]);
    }

    // Display all postings on the user or home screen
    public function index()
    {
        $postings = Posting::all();
        return view('Admin.posting.index', compact('postings'));
    }

    // Show the details of a single posting
    public function show($id)
    {
        $posting = Posting::findOrFail($id);
        return view('postings.show', compact('posting'));
    }

    // Display the form for editing an existing posting
    public function edit($id)
    {
        $posting = Posting::findOrFail($id);
        return view('postings.edit', compact('posting'));
    }

    // Update an existing posting
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $posting = Posting::findOrFail($id);
        $posting->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('Admin.posting.index')->with('success', 'Posting updated successfully!');
    }

    // Delete a posting
    public function destroy($id)
    {
        $posting = Posting::findOrFail($id);
        $posting->delete();

        return redirect()->route('home')->with('success', 'Posting deleted successfully!');
    }
}
