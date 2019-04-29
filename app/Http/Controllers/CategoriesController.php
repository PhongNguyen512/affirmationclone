<?php

namespace App\Http\Controllers;

use App\Category;
use App\Affirmation;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_title' => ['required', 'unique:categories', 'max:255'],
        ]);   

        Category::create([
            'category_title' => $request->category_title,
        ]);
      
        return redirect(route('categories.index'));
    }

    public function show(Category $category){
        return view('admin.categories.show', compact('category') );
    }

    public function edit(Category $category)
    {
        $aff = Affirmation::all();
        $categories = Category::all();

        return view('admin.categories.edit', compact(['category', 'categories', 'aff']) );
    }

    public function update(Request $request, Category $category)
    {
        //str -> arr
        $inputArray = explode(',', $request->affirmationSelection);

        //check empty input
        $request->validate([
            'category_title' => ['required', 'max:255'],
        ]);

        foreach ($category->AffList()->get() as $c) {
            if(!in_array($c->id, $inputArray))
                $category->AffList()->detach($c);           
        }

        foreach ($inputArray as $i) {
            if(!$category->AffList()->get()->contains('id', $i))
               $category->AffList()->attach(Affirmation::find($i));
        }

        $category->category_title = $request->category_title;
        $category->save();

        return redirect(route('categories.show', compact('category')));      
    }
}
