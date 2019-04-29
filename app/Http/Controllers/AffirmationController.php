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
        $request->validate([
            'aff_content' => ['required'],
        ]);   

        $inputArray = explode(',', $request->categorySelection) ;

        foreach ($aff->CatList()->get() as $a) {
            if(!in_array($a->id, $inputArray))
                $aff->CatList()->detach($a);           
        }

        foreach ($inputArray as $i) {
            if(!$aff->CatList()->get()->contains('id', $i))
               $aff->CatList()->attach(Category::find($i));
        }

        $aff->aff_content = $request->aff_content;
        $aff->save();
            
        return redirect(route('affirmations.show', ['aff' => $aff->id]));
    }
}
