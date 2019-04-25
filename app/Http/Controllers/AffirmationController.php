<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Affirmation;

class AffirmationController extends Controller
{
    public function index()
    {
        $affirmation = Affirmation::all();
    
        return view('admin.affirmations.index', compact('affirmation'));
    }

    public function show(Affirmation $aff){
        return view('admin.affirmations.show', compact('aff') );
    }
}
