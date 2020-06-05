<?php

namespace App\Http\Controllers;

use App\Teacher_subject;
use App\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return FacadesDataTables::of(Timetable::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $timetable = Timetable::all();
        $teacher_subject = Teacher_subject::all();

        return view('pages.timetable',['timetables' => $timetable,'teacher_subjects' => $teacher_subject ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $personne = new Timetable();
        $personne->fill($request->all());
        $personne->save();
        $data = [
            'status' => 200,
            'message' => 'successfully created',
            'body' => $personne
        ];
        return back()->withStatus(__($data['message']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        return response()->json($timetable, 200);
    }

    public function data()
    {
        return response()->json(Timetable::orderByDesc('id')->paginate(12), 200);
    }
    public function date(Request $request)
    {
        return response()->json(Timetable::orderByDesc('id')->paginate(12), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $timetable = Timetable::find ( $request->id );
        $timetable->teacher_subject_id  = $request->teacher_subject_id ;
        $timetable->day_name = $request->day_name ;
        $timetable->start_time = $request->start_time ;
        $timetable->end_time = $request->end_time ;
        $timetable->room_no = $request->room_no ;
        $timetable->is_active = $request->is_active;
        $timetable->save();

        $data = [
            'status' => 200,
            'message' => 'successfully updates'
            ];

            return Redirect::back()->with('message','Operation Successful !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //
    }
}
