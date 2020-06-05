<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Personne;
use App\Session;
use App\Subject;
use App\Teacher_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class TeacherSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return FacadesDataTables::of(Teacher_subject::query())->make(true);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $teacher_subject = Teacher_subject::all();
        $session = Session::all(['id', 'session']);
        $students = Personne::whereHas(
            'category', function($q){
                $q->where('name', 'Prof');
            }
        )->get();
        $classe = Classe::all(['id', 'class']);
        $subject = Subject::all(['id', 'name']);

        return view('pages.teacher_subject',['teacher_subjects' => $teacher_subject, 'sessions' => $session, 'classes' => $classe, 'subjects' => $subject, 'teachers' => $students]);
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
        $personne = new Teacher_subject();
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
     * @param  \App\Teacher_subject  $teacher_subject
     * @return \Illuminate\Http\Response
     */
    public function show($teacher_subject_id)
    {
        //
        return response()->json(Teacher_subject::where(['id'=> $teacher_subject_id])->get(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher_subject  $teacher_subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher_subject $teacher_subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher_subject  $teacher_subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $teacher_subject = Teacher_subject::find ( $request->id );
        $teacher_subject->description = $request->description;
        $teacher_subject->is_active = $request->is_active;
        $teacher_subject->save();

        $data = [
            'status' => 200,
            'message' => 'successfully updates'
            ];

            return Redirect::back()->with('message','Operation Successful !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher_subject  $teacher_subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher_subject $teacher_subject)
    {
        //
    }
}
