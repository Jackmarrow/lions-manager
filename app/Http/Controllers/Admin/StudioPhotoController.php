<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\StudioPhoto;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudioPhotoController extends Controller
{
    //! store Photo
    public function store(Request $request, Studio $studio)
    {
        Request()->validate([
            'photo.*' => 'required|image|mimes:jpeg,png,webp,jpg,gif,avif,svg|max:2048',
        ]);
        $studiophoto =  $request->file('photo');
        $photoNames = [];

        foreach ($studiophoto as $photo) {
            $photoname = date("His") . '.' . $photo->getClientOriginalName();
            $photo->storeAs('public/images/studioPhoto', $photoname);
            $photoNames[] = $photoname;
        }

        
        foreach ($photoNames as $name) {
            $data = [
                'photo' => $name,
                'studio_id' => $studio->id,
            ];
            StudioPhoto::create($data);
        }
        return redirect()->back();
    }
    //! update Photo
    public function update(Request $request, StudioPhoto $studiophoto)
    {
        request()->validate([
            "photo" => "image|mimes:jpeg,png,webp,jpg,gif,avif,svg|max:2048",
        ]);
        if ($request->file('studioPhoto') != null) {
            // delete image from storage
            Storage::disk("public")->delete('/images/studioPhoto/' . $studiophoto->photo);
            $studiophoto->delete();
            // update photo
            $request->file("studioPhoto")->storePublicly('/images/studioPhoto/', 'public');
            $data = [
                "photo" => $request->file("studioPhoto")->hashName(),
            ];

            $studiophoto->update($data);
        } else {
            $studiophoto->save();
        }
        return redirect()->back();
    }

    //! Delete Photo
    public function destroy(StudioPhoto $studiophoto)
    {
        Storage::disk("public")->delete('/images/studioPhoto/' . $studiophoto->photo);
        $studiophoto->delete();
        return redirect()->back();
    }
}
