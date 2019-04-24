<?php

namespace App\Http\Controllers;

use App\SubItem;
use App\Item;
use Illuminate\Http\Request;

class SubItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subItems = SubItem::all();
    
        return view('admin.sub-items.index', compact('subItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();

        return view('admin.sub-items.create', compact('items'));
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
            'sub_item_title' => ['required', 'unique:sub_items', 'max:255'],
            'sub_item_content' => ['required'],
            'itemSelection' => ['required'],
        ]);   

        SubItem::create( [
            'sub_item_title' => $request->sub_item_title,
            'sub_item_content' => $request->sub_item_content,
            'item_id' => $request->itemSelection,
        ]);
      
        return redirect(route('subitems.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubItem  $subItem
     * @return \Illuminate\Http\Response
     */
    public function show(SubItem $subItem)
    {
        $items = Item::all();
    
        return view('admin.sub-items.show', compact(['subItem', 'items']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubItem  $subItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SubItem $subItem)
    {
        $items = Item::all();

        return view('admin.sub-items.edit', compact(['subItem', 'items']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubItem  $subItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubItem $subItem)
    {
        $request->validate([
            'sub_item_title' => ['required', 'max:255'],
            'sub_item_content' => ['required'],
            'itemSelection' => ['required'],
        ]);   

        $subItem->sub_item_title = $request->sub_item_title;
        $subItem->sub_item_content = $request->sub_item_content;
        $subItem->item_id = $request->itemSelection;
        $subItem->save();
            
        return redirect(route('subitems.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubItem  $subItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubItem $subItem)
    {
        //policy
        $this->authorize('deleteSubItem', SubItem::class);

        $subItem->delete();

        return redirect(route('subitems.index'));
    }
}
