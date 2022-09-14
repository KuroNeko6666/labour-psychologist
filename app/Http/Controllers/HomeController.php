<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psychotest;
use App\Models\Jadwal;
use App\Models\JadwalsUser;
use App\Models\PsychotestParticipant;

class HomeController extends Controller
{
    public function index(){
        $id = auth()->user()->id;
        return view('home.index', [
            'active' => 'dashboard',
            'title' => 'Labour | Psikotest',
            'jadwal' => Jadwal::latest()->filter(['id' => $id])->get(),
            'participant' => JadwalsUser::latest()->filter(['psychologist' => $id,'status' => 'unfinished'])->get()
        ]);
    }
}
