<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Workout;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(
            Workout::where('user_id', '=', Auth::guard('api')->user()->id)
                ->with(['exercises', 'user'])->get()
        );
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workout = new Workout($request->all());
        $workout->user_id = Auth::guard('api')->user()->id;
        if ($workout->save()) {
            $workout->exercises()->sync($request->get('exercises'));
            return response()->json($workout->load('exercises'));
        }
        return response()->json(['code' => 'NOT_OK']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Workout::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $workout = Workout::find($id);
        if ($workout->save($request->all())) {
            $workout->exercises()->sync($request->get('exercises'));
            return response()->json($workout->with('exercises'));
        }
        return response()->json(['code' => 'NOT_OK']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workout = Workout::find($id);
        if ($workout->delete()) {
            return response()->json(['code' => 'OK', 'message' => 'Workout deleted']);
        }
        return response()->json(['code' => 'NOT_OK']);
    }

    /**
     *
     */
    public function destroyAll()
    {

    }
}
