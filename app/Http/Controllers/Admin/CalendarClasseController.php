<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ResvClasse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalendarClasseController extends Controller
{
    //*RETURN VIEW fullcalendar for each class
    public function showcal(Classe $classe)
    {
        $classes = Classe::all();
        //^ $myevents => to make the reservations appear in the calendar after getting them from the database
        $myevents = array();
        $resv_classes = ResvClasse::all();
        foreach ($resv_classes as $resv_classe) {
            //? if resv_classe is canceled => don't show it up in my calendar
            if ($resv_classe->resv_etat == 1 && $resv_classe->classe_id == $classe->id) {
                $myevents[] = [
                    'id' => $resv_classe->id,
                    'title' => $resv_classe->classe->name,
                    'user_name' => $resv_classe->user->name,
                    'start' => $resv_classe->start,
                    'end' => $resv_classe->end,
                    'resv_etat' => $resv_classe->resv_etat
                ];
            }
        }
        return view("admin.backend.calendarClasse", compact("classe", "myevents", "classes"));
    }

    //* Interaction : the function ajax that manages the reservations of classes => stock them in the database
    public function ajax(Request $request): JsonResponse
    {
        $resv_classes = ResvClasse::all();
        switch ($request->type) {
            case 'add':
                $event = ResvClasse::create([
                    'classe_id' => $request->title,
                    'start' => $request->start,
                    'user_id' => auth()->user()->id,
                    'end' => $request->end,
                    'resv_etat' => true
                ]);
                return response()->json($event);
                break;

            case 'delete':
                //! we should not delete it completely => garder l'historique
                $event = $resv_classes->where("id", $request->id)->first();
                $event->resv_etat = false;
                $event->save();
                return response()->json($event);
                break;
            default:
                # code...
                break;
        }
    }
}
