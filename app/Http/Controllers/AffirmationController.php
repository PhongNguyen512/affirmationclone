<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Affirmation;
use App\Category;

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

    public function edit(Affirmation $aff)
    {
        $categories = Category::all();

        return view('admin.affirmations.edit', compact(['categories', 'aff']) );
    }

    public function update(Request $request, Affirmation $aff)
    {
        dd($aff->categorySelection);
        $request->validate([
            'aff_content' => ['required'],
        ]);   

        $aff->aff_content = $request->aff_content;
            #detach / attach code
        $aff->save();
            
        return redirect(route('affirmations.index'));
    }
}
