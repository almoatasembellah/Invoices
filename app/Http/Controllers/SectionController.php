<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        $input = $request->all();

        $validated = $request->validated();

            Section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'created_by' => (Auth::user()->name),
            ]);

            session()->flash('Add','Section created successfully');
            return redirect('/sections');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request,[
            'section_name' => 'required|max:255|unique:sections,section_name'
        ], [
            'name.required' => 'the name is required',
            'name.regex' => 'That is not a valid name',
            'name.unique' => 'The name is already taken'
        ]);

        $section = Section::find($id);

        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('Update', 'successfully been updated');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete','Section deleted successfully');
        return redirect('/sections');
    }
}
