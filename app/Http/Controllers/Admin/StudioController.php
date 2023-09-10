<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\StudioPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    //^index 
    public function index()
    {
        $studios = Studio::all();
        $studio_photos = StudioPhoto::all();
        return view("admin.backend.studio", compact("studios", "studio_photos"));
    }

    //^store
    public function store(Request $request)
    {
        Request()->validate([
            'name' => ["required"],
        ]);
        $data = [
            'name' => $request->name,
        ];
        Studio::create($data);
        return redirect()->route("studio.index");
    }

    //^update
    public function update(Request $request, Studio $studio)
    {
        request()->validate([
            'name' => ["required"],
        ]);
        $data = [
            'name' => $request->name,
        ];
        $studio->update($data);
        return redirect()->back();
    }

    //^delete
    public function destroy(Studio $studio)
    {
        $studioPhotos = StudioPhoto::where("studio_id", $studio->id)->get();
        foreach ($studioPhotos as $studioPhoto) {
            Storage::disk("public")->delete('/images/studioPhoto/' . $studioPhoto->photo);
        }
        $studio->delete();
        return redirect()->back();
    }
}
