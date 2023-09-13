<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    //*index 
    public function index()
    {
        $tools = Tool::all();
        return view("admin.backend.tool", compact("tools"));
    }

    //*store
    public function store(Request $request)
    {
        Request()->validate([
            'name' => ["required"],
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif,avif,svg|max:2048',
            'etat' => ["required"],
            'stock' => ["required", "integer"],
        ]);
        $imageName = date("His") . $request->file("image")->getClientOriginalName();
        $request->file("image")->storeAs('public/images/tools/', $imageName);
        $data = [
            'name' => $request->name,
            'image' => $imageName,
            'etat' => $request->etat,
            'stock' => $request->stock,
        ];
        Tool::create($data);
        return redirect()->route("tools.index");
    }

    //*UpDate
    public function update(Request $request, Tool $tool)
    {
        request()->validate([
            'name' => ["required"],
            'etat' => ["required"],
            'stock' => ["required", "integer"],
        ]);
        $data = [
            'name' => $request->name,
            'etat' => $request->etat,
            'stock' => $request->stock,
        ];
        $tool->update($data);
        return redirect()->route('tools.index');
    }
    // *delete
    public function destroy(Tool $tool)
    {
       if($tool){
        $tool->delete();
        Storage::delete('public/images/tools/'.$tool->image);
        return redirect()->back();
       }
    }

    //* ETAT TOOL
    public function edittool($toolId)
    {
        $tool = Tool::find($toolId);

        if ($tool) {
            if ($tool->etat) {
                $tool->etat = 0;
            } else {
                $tool->etat = 1;
            }
            $tool->save();
        }
        return back();
    }
}
