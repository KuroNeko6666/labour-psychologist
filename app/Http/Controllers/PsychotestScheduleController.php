<?php

namespace App\Http\Controllers;

use App\Models\Psychotest;
use App\Models\PsychotestParticipant;
use Illuminate\Http\Request;

class PsychotestScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 'unfinished';
        if(request('status')){
            $status = request('status');
        }

        return view('home.schedule',[
            'title' => 'Labour Psycholog',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
            'status' => $status,
            'data' => Psychotest::latest()->filter(['psychologist' => auth()->user()->id])->filter(['status' => $status])->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.schedule-add',[
            'title' => 'Labour Psycholog',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'psychologist_id' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required|max:255',
            'time' => 'required|max:255',
            'quota' => 'required|max:255',
        ]);

        Psychotest::create($validated);
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function show(Psychotest $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function edit(Psychotest $schedule)
    {
        return view('home.schedule-edit',[
            'title' => 'Labour Psycholog',
            'active' => 'psychotest-schedule',
            'path' => '/psychotest/schedule',
            'data' => $schedule
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Psychotest $schedule)
    {
        $validated = $request->validate([
            'psychologist_id' => 'required|max:255',
            'location' => 'required|max:255',
            'date' => 'required|max:255',
            'time' => 'required|max:255',
            'quota' => 'required|max:255',
            'status' => 'required|max:255|in:unfinished,finished,cancel',
        ]);

        $schedule->update($validated);
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psychotest  $psychotest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psychotest $schedule)
    {
        $participants = PsychotestParticipant::where('psychotest_id', $schedule->id)->get();
        foreach ($participants as $participant) {
            $participant->delete();
        }
        $schedule->delete();
        return redirect()->route('schedule')->with('message', 'Jadwal berhasil dihapus!');
    }
}
