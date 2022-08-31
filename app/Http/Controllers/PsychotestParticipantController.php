<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePsychotestParticipantRequest;
use App\Http\Requests\UpdatePsychotestParticipantRequest;
use App\Models\PsychotestParticipant;
use App\Models\Psychotest;
use App\Models\User;

class PsychotestParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.participant',[
            'title' => 'Labour Psycholog',
            'active' => 'psychotest-participant',
            'path' => '/psychotest/participant',
            'data' => PsychotestParticipant::latest()->filter(request(['search', 'psychotest_id']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.participant-add',[
            'title' => 'Labour Psycholog',
            'active' => 'psychotest-participant',
            'path' => '/psychotest/participant',
            'user' => User::all(),
            'psychotest' => Psychotest::latest()->filter(['psychologist' => auth()->user()->id])->filter(['status' => 'unfinished'])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePsychotestParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePsychotestParticipantRequest $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'psychotest_id' => 'required'
        ]);

        $user = User::find($validated['user_id']);
        $psychotest = Psychotest::find($validated['psychotest_id']);
        $participants = PsychotestParticipant::where('user_id', $validated['user_id'])->get();
        $psychotests = PsychotestParticipant::where('psychotest_id', $validated['psychotest_id'])->get();
        $exist = false;

        if($participants){
            foreach ($participants as $key) {
                if($key->psychotest_id == $validated['psychotest_id']){
                    $exist = true;
                }
            }

            if($exist) {
                return redirect()->back()->with('error', 'User sudah terdaftar dalam jadwal tersebut');
            }
        }

        if($psychotest){
            if($psychotest->quota <= $psychotests->count()){
                return redirect()->back()->with('error', 'Kuota sudah penuh, silahkan ubah jadwal');
            }
            if($psychotest->status == 'cancel' || $psychotest->status == 'finished'){
                return redirect()->back()->with('error', 'Sesi pendaftaran jadwal tersebut telah ditutup atau dibatalkan');
            }
        }


        if($user && $psychotest){
            PsychotestParticipant::create($validated);
            if($request->psychotest){
                return redirect('psychotest/participant?psychotest_id='.$request->psychotest)->with('message', 'peserta berhasil ditambahkan!');
            }
            return redirect()->route('participant')->with('message', 'peserta berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'User atau Psychotest tidak ditemukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(PsychotestParticipant $psychotestParticipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function edit(PsychotestParticipant $participant)
    {
        return view('home.participant-edit',[
            'title' => 'Labour Psycholog',
            'active' => 'psychotest-participant',
            'path' => '/psychotest/participant',
            'data' => $participant,
            'user' => User::all(),
            'psychotest' => Psychotest::latest()->filter(['psychologist' => auth()->user()->id])->filter(['status' => 'unfinished'])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePsychotestParticipantRequest  $request
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePsychotestParticipantRequest $request, PsychotestParticipant $participant)
    {
        $validated;
        $psychotest;
        $user = User::find($request['user_id']);
        $psychotest = Psychotest::find($request['psychotest_id']);
        $participants = PsychotestParticipant::where('user_id', $request['user_id'])->get();
        $psychotests = PsychotestParticipant::where('psychotest_id', $request['psychotest_id'])->get();
        $exist = false;

        $same_user = $request->user_id == $participant->user_id;
        $same_psychotest = $request->psychotest_id == $participant->psychotest_id;

        if($same_psychotest && $same_user){
            $validated = $request->validate([
                'user_id' => 'required',
                'psychotest_id' => 'required'
            ]);

            $participant->update($validated);
            if($request->psychotest){
                return redirect('psychotest/participant?psychotest_id='.$request->psychotest)->with('message', 'peserta berhasil diubah!');
            }
            return redirect()->route('participant')->with('message', 'peserta berhasil diubah!');

        } else {
            $validated = $request->validate([
                'user_id' => 'required',
                'psychotest_id' => 'required'
            ]);
        }


            if($participants){
                foreach ($participants as $key) {
                    if($key->psychotest_id == $validated['psychotest_id']){
                        $exist = true;
                    }
                }
            }

        if($exist) {
            return redirect()->back()->with('error', 'User sudah terdaftar dalam jadwal tersebut');
        }

        if($psychotest){
            if($psychotest->status == 'cancel' || $psychotest->status == 'finished'){
                return redirect()->back()->with('error', 'Sesi pendaftaran jadwal tersebut telah ditutup atau dibatalkan');
            }
        }

        if($user && $psychotest){
            $participant->update($validated);
            if($request->psychotest){
                return redirect('psychotest/participant?psychotest_id='.$request->psychotest)->with('message', 'peserta berhasil diubah!');
            }
            return redirect()->route('participant')->with('message', 'peserta berhasil diubah!');
        }

        return redirect()->back()->with('error', 'User atau Psychotest tidak ditemukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PsychotestParticipant  $psychotestParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(PsychotestParticipant $participant)
    {
        $participant->delete();
        return redirect()->route('participant')->with('message', 'peserta berhasil dihapus!');
    }
}
