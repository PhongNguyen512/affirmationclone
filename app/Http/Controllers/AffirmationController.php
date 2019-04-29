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

        //str -> arr
        $inputArray = explode(',', $request->categorySelection) ;

        //Check what database have with the input value
        //If the item in database have can't be found in the input value
        //That item will be detach
        foreach ($aff->CatList()->get() as $a) {
            if(!in_array($a->id, $inputArray))
                $aff->CatList()->detach($a);           
        }

        //Check not exist item from input value to database
        //Add all different items from input value
        foreach ($inputArray as $i) {
            if(!$aff->CatList()->get()->contains('id', $i))
               $aff->CatList()->attach(Category::find($i));
        }

        $aff->aff_content = $request->aff_content;
        $aff->save();
            
        return redirect(route('affirmations.show', ['aff' => $aff->id]));
    }
}
