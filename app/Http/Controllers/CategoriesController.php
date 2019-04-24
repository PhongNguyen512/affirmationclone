<?php

namespace App\Http\Controllers;

use App\Category;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_title' => ['required', 'unique:categories', 'max:255'],
        ]);   

        $fileName = 'upload/categories/category'.$request->icon->getClientOriginalName();

        Image::make( $request->file('icon') )->resize(300, 300)->save( public_path($fileName) );

        Category::create([
            'category_title' => $request->category_title,
            'background_color' => $request->background_color,
            'icon' => $fileName,
        ]);
      
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('admin.categories.edit', compact(['categories', 'category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //check empty input
        $request->validate([
            'category_title' => ['required', 'max:255'],
        ]);

        $fileName = 'upload/categories/category'.$request->icon->getClientOriginalName();

        Image::make( $request->file('icon') )->resize(300, 300)->save( public_path($fileName) );

        $category->category_title = $request->category_title;
        $category->background_color = $request->background_color;
        $category->icon = $fileName;
        $category->save();

        return redirect(route('categories.index'));      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //policy
        $this->authorize('deleteCategory', Category::class);

        if( count($category->ItemList) > 0 ){
            $destroyError = new MessageBag();
            $destroyError->add('destroy', 'You can\'t delete this');

            return redirect(route('categories.show', compact('category')))->withErrors($destroyError);
        }

        $category->delete();

        return redirect(route('categories.index'));
    }
}
