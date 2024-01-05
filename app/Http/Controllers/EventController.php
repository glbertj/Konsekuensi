<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
Use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Event::all();
        $newData = [];


        foreach ($data as $event) {
            $event = collect($event->toArray());
            $event->put('backgroundColor', $event->get('color'));
            $event->put('borderColor', $event->get('color'));
            unset($event->color);


            $start = Carbon::parse($event->get('start'));
            $end = Carbon::parse($event->get('end'));

            if ($start->greaterThanOrEqualTo($end)) {
                continue;
            }

            $event->put('start', Str::replace('+00:00','+07:00', $start
                // ->setTimezone('Asia/Jakarta')
                ->toIso8601String()));

            $event->put('end', Str::replace('+00:00','+07:00', $end
                // ->setTimezone('Asia/Jakarta')
                ->toIso8601String()));
            // dd($event->end);

            $newData[] = $event;
                        
        }


        // for ($i = 0; $i < count($data); $i++) {
        //     $data[$i]->backgroundColor = $data[$i]->color;
        //     $data[$i]->borderColor = $data[$i]->color;
        //     unset($data[$i]->color);
        //     // dd($data[$i]->start->shiftTimezone('Asia/Jakarta')->toISOString());
        //     $data[$i]->start = $data[$i]->start->shiftTimezone("Asia/Jakarta")->toISOString();
        //     $data[$i]->end = $data[$i]->end->shiftTimezone("Asia/Jakarta")->toISOString();
        // }

        return response()->json($newData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => "required|string",
            'start' => "required|date",
            'end' => "required|date|after:start",
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'color' => "nullable|string"
        ]);

        if ($request->start_time) {
            // buat iso format
            $data['start'] = explode('T', $data['start'])[0] . 'T' . $data['start_time'] . ':00.000Z';
            unset($data['start_time']);
        }

        if ($request->end_time) {
            // buat iso format
            $data['end'] = explode('T', $data['end'])[0] . 'T' . $data['end_time'] . ':00.000Z';
            unset($data['end_time']);
        }

        if (strtotime($data['end']) <= strtotime($data['start'])) {
            return redirect()->back()->with('error', 'End time must be later than start time.');
        }

        Event::create($data);

        return response()->redirectToRoute('calendar');
    }   

    /**
     * Display the specified resource.  
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        if ($request->start_time) {
            $eventId = $event->id;

            Event::destroy($eventId);

            $data = $request->validate([
                'title' => "required|string",
                'start' => "required|date",
                'end' => "required|date|after:start",
                'start_time' => 'nullable',
                'end_time' => 'nullable',
                'color' => "nullable|string"
            ]);

            if ($request->start_time) {
                $data['start'] = explode('T', $data['start'])[0] . 'T' . $data['start_time'] . ':00.000Z';
                unset($data['start_time']);
            }

            if ($request->end_time) {
                $data['end'] = explode('T', $data['end'])[0] . 'T' . $data['end_time'] . ':00.000Z';
                unset($data['end_time']);
            }

            if (strtotime($data['end']) <= strtotime($data['start'])) {
                return redirect()->back()->with('error', 'End time must be later than start time.');
            }

            // Create a new event with the updated data
            Event::create($data);
        }

        return redirect()->route('calendar');
    }

    public function destroy(Event $event)
    {
        try {
            $eventId = $event->id;
            Event::destroy($eventId);

            $event->delete(); // Delete the event
            return response()->json(['message' => 'Event deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete event'], 500);
        }
    }
}
