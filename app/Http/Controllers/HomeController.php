<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psychotest;
use App\Models\PsychotestParticipant;

class HomeController extends Controller
{
    public function index(){
        $id = auth()->user()->id;
        return view('home.index', [
            'active' => 'dashboard',
            'title' => 'Labour | Psikotest',
            'schedule_finished' => Psychotest::latest()->filter(['psychologist' => $id,'status' => 'finished'])->get(),
            'schedule_unfinished' => Psychotest::latest()->filter(['psychologist' => $id,'status' => 'unfinished'])->get(),
            'schedule_cancel' => Psychotest::latest()->filter(['psychologist' => $id,'status' => 'cancel'])->get(),
            'participant' => PsychotestParticipant::latest()->filter(['psychologist' => $id,'status' => 'unfinished'])->get()
        ]);
    }
}
