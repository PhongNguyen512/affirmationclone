<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\GroupItem;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Intervention\Image\ImageManagerStatic as Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
    
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $groupItems = GroupItem::all();

        return view('admin.items.create', compact(['categories', 'groupItems']) );
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
            'item_title' => ['required', 'unique:items', 'max:255'],
            'item_content' => ['required'],
        ]);   

        $fileName = 'upload/items/item'.$request->icon->getClientOriginalName();

        Image::make( $request->file('icon') )->resize(300, 300)->save( public_path($fileName) );

        Item::create( [
            'item_title' => $request->item_title,
            'item_content' => $request->item_content,
            'background_color' => $request->background_color,
            'icon' => $fileName,
            'category_id' => $request->categorySelection,
            'group_item_id' => $request->groupItemSelection,
        ]);
      
        return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $categories = Category::all();
        $groupItems = GroupItem::all();

        return view('admin.items.show', compact(['item', 'categories', 'groupItems']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $groupItems = GroupItem::all();

        return view('admin.items.edit', compact(['categories', 'groupItems', 'item']) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_title' => ['required', 'max:255'],
            'item_content' => ['required'],
        ]);   

        $fileName = 'upload/items/item'.$request->icon->getClientOriginalName();

        Image::make( $request->file('icon') )->resize(300, 300)->save( public_path($fileName) );

        $item->item_title = $request->item_title;
        $item->item_content = $request->item_content;
        $item->background_color = $request->background_color;
        $item->icon = $fileName;
        $item->category_id = $request->categorySelection;
        $item->group_item_id = $request->groupItemSelection;
        $item->save();
            
        return redirect(route('items.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {        
        //policy
        $this->authorize('deleteItem', Item::class);

        if( count($item->SubItemList) > 0 ){
            $destroyError = new MessageBag();
            $destroyError->add('destroy', 'You can\'t delete this');

            return redirect(route('items.show', compact('item')))->withErrors($destroyError);
        }

        $item->delete();

        return redirect(route('items.index'));
    }
}
