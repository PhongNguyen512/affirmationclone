<?php

namespace App\Http\Controllers;

use App\Category;
use App\Affirmation;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\MessageBag;
use Intervention\Image\ImageManagerStatic as Image;

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
        //check empty input
        $request->validate([
            'category_title' => ['required', 'max:255'],
        ]);

        $category->category_title = $request->category_title;
        $category->save();

        return redirect(route('categories.index'));      
    }
}
