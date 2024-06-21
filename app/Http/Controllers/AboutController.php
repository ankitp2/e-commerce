<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Address;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=About::all();
        return view('admin.adminabout',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=new About();
        $data->about=$request->about;
        $data->save();
        return redirect()->back()->with('success','About section updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        $data=About::all();
        return view('about',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        //
    }
}
