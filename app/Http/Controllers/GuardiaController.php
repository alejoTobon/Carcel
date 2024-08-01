<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GuardiaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            return Redirect::route('guardias.create')
                ->withErrors(['numero_identificacion' => 'Ya existe un guardia con este número de identificación.']);
        }

        // Generar un correo único
        $email = $this->generateUniqueEmail();
        $password = $this->generatePassword();  // Genera una contraseña aleatoria

        // Crear el usuario en la tabla users
        $user = User::create([
            'name' => $request->input('nombre_completo'),
            'email' => $email,
            'password' => Hash::make($password),  // Encriptar la contraseña
            'rol' => 'guardia',  // Asigna el rol correspondiente
            'estado' => 'Activo',  // Por defecto, está activo
        ]);

        // Crear el guardia
        $guardia = Guardia::create($request->validated() + ['user_id' => $user->id]);

        // Redirigir con un mensaje que incluya las credenciales
        return Redirect::route('guardias.index')
            ->with('success', 'Guardia creado exitosamente. Correo: ' . $email . ' Contraseña: ' . $password);
    }

    /**
     * Genera un correo único para el nuevo usuario.
     *
     * @return string
     */
    private function generateUniqueEmail(): string
    {
        do {
            $email = 'guardia_' . uniqid() . '@example.com';
        } while (User::where('email', $email)->exists());

        return $email;
    }

    /**
     * Genera una contraseña aleatoria.
     *
     * @return string
     */
    private function generatePassword(): string
    {
        return Str::random(12);  // Genera una contraseña aleatoria de 12 caracteres
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

    public function toggleStatus($id): RedirectResponse
    {
        // Encuentra el guardia por ID
        $guardia = Guardia::findOrFail($id);
    
        // Alterna el estado entre Activo e Inactivo
        $guardia->estado = ($guardia->estado === 'Activo') ? 'Inactivo' : 'Activo';
    
        // Guarda los cambios
        $guardia->save();
    
        // Redirige con un mensaje de éxito
        return Redirect::route('guardias.index')
            ->with('success', 'Estado del guardia actualizado exitosamente.');
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
