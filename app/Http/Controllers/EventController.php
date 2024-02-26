<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function agendamentos()
    {
        $agendamentos = Event::paginate(10);
        return view('admin.agendamentos.index', compact('agendamentos'));

    }

    public function show($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    public function store(Request $request)
    {

        $event = new Event;
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        return response()->json($event);
    }



    public function update(Request $request, $id)
    {

        $event = Event::find($id);
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }

}
