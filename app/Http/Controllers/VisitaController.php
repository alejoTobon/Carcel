<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VisitaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $visitas = Visita::paginate();

        return view('visita.index', compact('visitas'))
            ->with('i', ($request->input('page', 1) - 1) * $visitas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $visita = new Visita();

        return view('visita.create', compact('visita'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitaRequest $request): RedirectResponse
    {
        $input = $request->validated();

        // Verificar si la fecha y hora de inicio es menor a la actual
        $fecha_hora_inicio = Carbon::parse($input['fecha_hora_inicio']);
        $fecha_hora_fin = Carbon::parse($input['fecha_hora_fin']);
        if ($fecha_hora_inicio->isPast()) {
            throw ValidationException::withMessages(['fecha_hora_inicio' => 'La fecha y hora de inicio no puede ser menor a la actual.']);
        }

        // Verificar si la visita es el domingo y está entre las 14:00 y 17:00
        if ($fecha_hora_inicio->dayOfWeek !== Carbon::SUNDAY) {
            throw ValidationException::withMessages(['fecha_hora_inicio' => 'Las visitas solo pueden ser registradas los domingos.']);
        }

        if ($fecha_hora_inicio->format('H:i') < '14:00' || $fecha_hora_fin->format('H:i') > '17:00') {
            throw ValidationException::withMessages(['fecha_hora_inicio' => 'Las visitas solo pueden ser registradas entre las 14:00 y 17:00.']);
        }

        // Verificar si ya existe una visita con el mismo prisionero en la misma fecha y hora
        $conflictingVisit = Visita::where('prisionero_id', $input['prisionero_id'])
            ->where(function ($query) use ($input) {
                $query->where('fecha_hora_inicio', '<=', $input['fecha_hora_fin'])
                      ->where('fecha_hora_fin', '>=', $input['fecha_hora_inicio']);
            })
            ->first();

        if ($conflictingVisit) {
            throw ValidationException::withMessages(['conflicting_visit' => 'Ya existe una visita programada para el mismo prisionero en el mismo rango de tiempo.']);
        }

        Visita::create($input);

        return Redirect::route('visitas.index')
            ->with('success', 'Visita creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $visita = Visita::find($id);

        return view('visita.show', compact('visita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $visita = Visita::find($id);

        return view('visita.edit', compact('visita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitaRequest $request, Visita $visita): RedirectResponse
    {
        $input = $request->validated();

        // Verificar si la fecha y hora de inicio es menor a la actual
        $fecha_hora_inicio = Carbon::parse($input['fecha_hora_inicio']);
        $fecha_hora_fin = Carbon::parse($input['fecha_hora_fin']);
        if ($fecha_hora_inicio->isPast()) {
            throw ValidationException::withMessages(['fecha_hora_inicio' => 'La fecha y hora de inicio no puede ser menor a la actual.']);
        }

        // Verificar si la visita es el domingo y está entre las 14:00 y 17:00
        if ($fecha_hora_inicio->dayOfWeek !== Carbon::SUNDAY) {
            throw ValidationException::withMessages(['fecha_hora_inicio' => 'Las visitas solo pueden ser registradas los domingos.']);
        }

        if ($fecha_hora_inicio->format('H:i') < '14:00' || $fecha_hora_fin->format('H:i') > '17:00') {
            throw ValidationException::withMessages(['fecha_hora_inicio' => 'Las visitas solo pueden ser registradas entre las 14:00 y 17:00.']);
        }

        // Verificar si ya existe una visita con el mismo prisionero en la misma fecha y hora
        $conflictingVisit = Visita::where('prisionero_id', $input['prisionero_id'])
            ->where('id', '!=', $visita->id)
            ->where(function ($query) use ($input) {
                $query->where('fecha_hora_inicio', '<=', $input['fecha_hora_fin'])
                      ->where('fecha_hora_fin', '>=', $input['fecha_hora_inicio']);
            })
            ->first();

        if ($conflictingVisit) {
            throw ValidationException::withMessages(['conflicting_visit' => 'Ya existe una visita programada para el mismo prisionero en el mismo rango de tiempo.']);
        }

        $visita->update($input);

        return Redirect::route('visitas.index')
            ->with('success', 'Visita actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Visita::find($id)->delete();

        return Redirect::route('visitas.index')
            ->with('success', 'Visita eliminada exitosamente.');
    }
}
