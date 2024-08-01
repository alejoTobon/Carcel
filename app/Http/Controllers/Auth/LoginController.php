<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Guardia;  // Importa el modelo Guardia
use Illuminate\Support\Facades\Auth;  // Importa el facade Auth
use App\Models\User;  // Importa el modelo User

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override the credentials method to add custom logic for checking inactive status.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Autenticación de usuario basada en la tabla users
        $user = User::where('email', $credentials['email'])->first();

        // Verifica si el usuario es un guardia y si está activo
        if ($user) {
            $guardia = Guardia::find($user->guardia_id);

            if ($guardia && $guardia->estado !== 'Activo') {
                throw ValidationException::withMessages([
                    'email' => ['Cuenta inactiva.']
                ]);
            }
        }

        return $credentials;
    }

    /**
     * Override the attemptLogin method to use custom credentials logic.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Intenta iniciar sesión con las credenciales
        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    /**
     * Handle a login failure.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return back()->withErrors([
            $this->username() => trans('auth.failed'),
        ])->withInput($request->only($this->username(), 'remember'));
    }
}
