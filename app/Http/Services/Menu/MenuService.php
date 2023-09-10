<?php

namespace App\Http\Services\Menu;

use App\Models\Menu; 
use Illuminate\Support\Facades\Session;

class MenuService {

    public function getParent($parent_id = 1) {
        return Menu::where('parent_id', 0)->get();

            // when($parent_id == 0, function($query) use ($parent_id) {
            //     $query->where('parent_id', $parent_id);
            // })
            // ->get();
    }

    public function getAll() {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function getAllForSelect() {
        return Menu::get();
    }

    public function create($request) {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
            ]);
            
            Session::flash('success', 'created successfully');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($menu, $request) : bool {
        if($request->input('parent_id') !== $menu->id) {
            $menu->parent_id = (int) $request->input('parent_id');
        }
        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->save();

        Session::flash('success', 'Successfully updated');
        return true;
    }

    public function destroy($request) {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $request->input('id'))->first();

        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
}