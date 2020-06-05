<?php

namespace App\Http\Controllers;

use App\Category;
use App\Classe;
use App\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;


class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return FacadesDataTables::of(Personne::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $personne = Personne::all();
        $categorie = Category::all(['id', 'name']);
        $classe = Classe::all(['id', 'class']);

        return view('pages.personne', ['personnes' => $personne, 'categories' => $categorie, 'classes' => $classe]);
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
        $personne = new Personne();
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
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function show($teacher_id)
    {
        //
        return response()->json(Personne::where(['id'=> $teacher_id])->get(), 200);
    }



    public function personneogin(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $userRecord = Personne::where($loginData)->first();
        if (!Personne::where($loginData)->first()) {

            return response()->json([
                'success' => false,
                'message' => 'Faild'
            ]);
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Success'
            ]);
        }
        
    }
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);


        if (!Auth::attempt($loginData)) {
            return response()->json([
                'success' => false,
                'message' => 'Faild'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Success'
            ]);
        }
    }

    public function logout(Request $res)
    {
        if (Auth::personnes()) {
            $user = Auth::personnes()->token();
            $user->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function edit(Personne $personne)
    {
        //
        if (request()->ajax()) {
            $data = Personne::findOrFail($personne->id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $personne = Personne::find($request->id);
        $personne->firstname = $request->firstname;
        $personne->lastname = $request->lastname;
        $personne->email = $request->email;
        $personne->is_active = $request->is_active;
        $personne->save();

        $data = [
            'status' => 200,
            'message' => 'successfully updates'
        ];

        return Redirect::back()->with('message', 'Operation Successful !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personne $personne)
    {
        //
    }
}
