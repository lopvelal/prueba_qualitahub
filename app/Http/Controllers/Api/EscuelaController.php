<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Escuela\StoreRequest;
use App\Http\Requests\Escuela\UpdateRequest;
use App\Models\Escuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Escuela::paginate(5);
        return $data;
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAll()
    {
        $data = Escuela::all();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        // Verificar y procesar el archivo de logotipo si se ha subido
        if ($request->hasFile('logotipo') && $request->file('logotipo')->isValid()) {
            $filename = 'logotipo-' . time() . '.' . $request->file('logotipo')->extension();
            // Guardar el archivo en el disco público y obtener la ruta
            $path = $request->file('logotipo')->storeAs('logos', $filename, 'public');

            // Añadir la ruta del logotipo a los datos que serán actualizados
            $data['logotipo'] = "/storage/$path";
        }
        $data = Escuela::create($data);
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(Escuela $escuela)
    {
        return $escuela;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Escuela $escuela)
    {
        $data = $request->validated();

        // Verificar y procesar el archivo de logotipo si se ha subido
        if ($request->hasFile('logotipo') && $request->file('logotipo')->isValid()) {
            $filename = 'logotipo-' . time() . '.' . $request->file('logotipo')->extension();
            // Guardar el archivo en el disco público y obtener la ruta
            $path = $request->file('logotipo')->storeAs('logos', $filename, 'public');

            // Añadir la ruta del logotipo a los datos que serán actualizados
            $data['logotipo'] = "/storage/$path";
        }
        $escuela->update($data);
        return $escuela;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Escuela $escuela)
    {
        $nombre = "{$escuela->nombre} ";
        $escuela->delete();
        return response()->json("$nombre eliminada", 200);
    }
}
