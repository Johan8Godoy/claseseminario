<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::all(); /* select * from alumnos */
        //dd($alumnos);
        return view('alumnos.index', compact('alumnos')); /*carga la vista hacia el usuarios con datos de los alumnos */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'edad' => 'required|integer|min:1|max:150',
        ]);

        Alumno::create([
            'nombre' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'edad' => $request->edad,
        ]);

        return redirect()->route('alumnos.index')
                         ->with('success', 'Agregado correctamente.');


    }

    /**
     * Display the specified resource.
     */
    public function show(alumno $alumno)
    {
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumno = Alumno::findOrFail($id);
    // Validar los datos, asegurando que el email sea único, excepto para el alumno actual
    $request->validate([
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required|email|unique:alumnos,email,' . $alumno->id,
        'edad' => 'required|integer',
    ]);
    // Actualizar los datos del alumno
    $alumno->update($request->all());
    // Redireccionar con mensaje de éxito
    return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno aleminado correctamente.');


    }
}
