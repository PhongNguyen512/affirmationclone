<?php

namespace App\Http\Controllers;

use App\GroupItem;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class GroupItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $groupItems = GroupItem::all();
        return view('admin.group-items.index', compact('groupItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupItems = GroupItem::all();
        return view('admin.group-items.create', compact('groupItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'group_item_title' => ['required', 'unique:group_items', 'max:255'],
        ]);   

        GroupItem::create($validate);
      
        return redirect(route('groupitems.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupItem  $groupItem
     * @return \Illuminate\Http\Response
     */
    public function show(GroupItem $groupItem)
    {
        return view('admin.group-items.show', compact('groupItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupItem  $groupItem
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupItem $groupItem)
    {
        $groupItems = GroupItem::all();
        return view('admin.group-items.edit', compact(['groupItem', 'groupItems']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupItem  $groupItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupItem $groupItem)
    {
        //check if the update data same with old data?
        if($groupItem->group_item_title == $request->group_item_title)
            return redirect(route('categories.index'));
        else
        {
            //check empty input
            $request->validate([
                'group_item_title' => ['required', 'unique:group_items', 'max:255'],
            ]);

            $groupItem->group_item_title = $request->group_item_title;
            $groupItem->save();

            return redirect(route('groupitems.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupItem  $groupItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupItem $groupItem)
    {
        $this->authorize('deleteGroupItem', GroupItem::class);

        if( count($groupItem->ItemList) > 0 ){
            $destroyError = new MessageBag();
            $destroyError->add('destroy', 'You can\'t delete this');

            return redirect(route('groupitems.show', compact('groupItem')))->withErrors($destroyError);
        }

        $groupItem->delete();

        return redirect(route('groupitems.index'));
    }
}
