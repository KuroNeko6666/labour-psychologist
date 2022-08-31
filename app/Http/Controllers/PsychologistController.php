<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePsychologistRequest;
use App\Http\Requests\UpdatePsychologistRequest;
use App\Models\Psychologist;

class PsychologistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.psychologist',[
            'title' => 'Labour Psycholog',
            'active' => 'master-psychologist',
            'path' => '/master/psychologist',
            'data' => Psychologist::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.psychologist-add',[
            'title' => 'Labour Psycholog',
            'active' => 'master-psychologist',
            'path' => '/master/psychologist',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePsychologistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePsychologistRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:dns|unique:psychologists',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Psychologist::create($validated);
        return redirect()->route('psichologist')->with('message', 'Psikolog berhasil ditambahkan!');
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
    public function edit(Psychologist $psychologist)
    {
        return view('home.psychologist-edit',[
            'title' => 'Labour Psycholog',
            'active' => 'master-psychologist',
            'path' => '/master/psychologist',
            'data' => $psychologist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePsychologistRequest  $request
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePsychologistRequest $request, Psychologist $psychologist)
    {
        $validated;
        if ($request->email == $psychologist->email){
            $validated = $request->validate([
                'name' => 'required|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|email:dns|unique:psychologists',
            ]);
        }

        $psychologist->update($validated);
        return redirect()->route('psychologist')->with('message', 'Psikolog berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psychologist $psychologist)
    {
        $psychologist->delete();
        return redirect()->route('psychologist')->with('message', 'Psikolog berhasil dihapus!');
    }
}
