<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GuardiaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class GuardiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $guardias = Guardia::paginate();

        return view('guardia.index', compact('guardias'))
            ->with('i', ($request->input('page', 1) - 1) * $guardias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $guardia = new Guardia();

        return view('guardia.create', compact('guardia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardiaRequest $request): RedirectResponse
    {
        // Verificar si ya existe un guardia con el mismo numero_identificacion
        $exists = Guardia::where('numero_identificacion', $request->input('numero_identificacion'))->first();

        if ($exists) {
            throw ValidationException::withMessages(['numero_identificacion' => 'Ya existe un guardia con este número de identificación.']);
        }

        Guardia::create($request->validated());

        return Redirect::route('guardias.index')
            ->with('success', 'Guardia creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $guardia = Guardia::find($id);

        return view('guardia.show', compact('guardia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $guardia = Guardia::find($id);

        return view('guardia.edit', compact('guardia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuardiaRequest $request, Guardia $guardia): RedirectResponse
    {
        $guardia->update($request->validated());

        return Redirect::route('guardias.index')
            ->with('success', 'Guardia actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Guardia::find($id)->delete();

        return Redirect::route('guardias.index')
            ->with('success', 'Guardia eliminado exitosamente');
    }
}
