<?php

namespace App\Http\Controllers;

use App\Models\Psychologist;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.profile',[
            'title' => 'Labour Psycholog',
            'active' => 'profile',
            'path' => '/profile',
            'data' => auth()->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function show(Psychologist $psychologist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function edit(Psychologist $profile)
    {
        return view('home.profile-edit',[
            'title' => 'Labour Psycholog',
            'active' => 'profile',
            'path' => '/profile',
            'data' => $profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Psychologist $profile)
    {
        $validated;
        if ($request->email == $profile->email){
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|email:dns|unique:psychologists',
            ]);
        }

        $profile->update($validated);
        return redirect()->route('profile')->with('message', 'Psikolog berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psychologist $psychologist)
    {
        //
    }
}
