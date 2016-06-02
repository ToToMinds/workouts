<?php

namespace App\Http\Controllers\Api;

use App\Exercise;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Validator;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Exercise::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:exercises,name'
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 'NOT_OK', 'message' => 'Exercise already exists']);
        }
        $exercise = new Exercise($request->all());
        if ($request->hasFile('image')) {
            $exercise->image_path = $this->getImagePath($request->file('image'));
        }
        if ($exercise->save()) {
            return response()->json($exercise);
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
        return response()->json(Exercise::find($id));
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
        $exercise = Exercise::find($id);
        if (!$exercise) {
            return response()->json(['code' => 'NOT_OK', 'message' => 'Exercise does not exists']);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'unique:exercises,name,' . $id
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 'NOT_OK', 'message' => 'Exercise name already exists']);
        }
        if ($exercise->save($request->all())) {
            return response()->json($exercise);
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
        $exercise = Exercise::find($id);
        if (!$exercise) {
            return response()->json(['code' => 'NOT_OK', 'message' => 'Exercises does not exists']);
        }
        $filePath = public_path('/uploads/exercises/' . $exercise->image_path);
        if (file_exists($filePath) && !is_dir($filePath)) {
            if (unlink($filePath) === false) {
                return response()->json(['code' => 'NOT_OK', 'message' => 'Exercises not deleted. Something went wrong.']);
            }
        }
        if ($exercise->delete()) {
            return response()->json(['code' => 'OK', 'message' => 'Exercise deleted']);
        }
        return response()->json(['code' => 'NOT_OK']);
    }

    public function destroyAll()
    {

    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    private function getImagePath(UploadedFile $uploadedFile)
    {
        $filename = md5($uploadedFile->getClientOriginalName()) . time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move(public_path('/uploads/exercises/'), $filename);
        return $filename;
    }
}
