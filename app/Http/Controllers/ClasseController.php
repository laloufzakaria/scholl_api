<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Yajra\DataTables\Facades\DataTables as FacadesDataTables;


class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return FacadesDataTables::of(Classe::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classe = Classe::all();
        return view('pages.classe',['classe'=>$classe]);
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
        $category = new Classe();
        $category->fill($request->all());
        $category->save();
        $data = [
            'status' => 200,
            'message' => 'successfully created',
            'body' => $category
        ];
        return back()->withStatus(__($data['message']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function show($class_id)
    {
        //
        return response()->json(Classe::where(['id'=> $class_id])->get(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function edit(Classe $classe)
    {
        //
        if (request()->ajax()) {
            $data = Classe::findOrFail($classe->id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $classe)
    {
        //
        $category = Classe::find ( $request->id );
        $category->class = $request->class;
        $category->is_active = $request->is_active;
        $category->save();

        $data = [
            'status' => 200,
            'message' => 'successfully updates'
            ];

            return Redirect::back()->with('message','Operation Successful !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        //
    }
}
