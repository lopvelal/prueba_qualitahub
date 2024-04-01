<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alumno\StoreRequest;
use App\Http\Requests\Alumno\UpdateRequest;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Alumno::with('escuela:id,nombre')->paginate(10);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return Alumno::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return $alumno;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Alumno $alumno)
    {
        return $alumno->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $nombre = "{$alumno->nombre} {$alumno->apellidos} ";
        $alumno->delete();
        return response()->json("$nombre eliminado", 200);
    }
}
