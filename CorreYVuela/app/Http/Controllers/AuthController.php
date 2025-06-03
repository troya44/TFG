<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\UsuarioRegistrado;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    private function calcularCategoria($fechaNacimiento)
    {
        $edad = \Carbon\Carbon::parse($fechaNacimiento)->age;

        if ($edad >= 15 && $edad <= 16) {
            return 'Cadete';
        } elseif ($edad >= 17 && $edad <= 18) {
            return 'Juvenil';
        } elseif ($edad >= 19 && $edad <= 23) {
            return 'Sub-23';
        } elseif ($edad >= 24 && $edad <= 30) {
            return 'Elite';
        } elseif ($edad >= 31 && $edad <= 40) {
            return 'Master 30';
        } elseif ($edad >= 41 && $edad <= 50) {
            return 'Master 40';
        } elseif ($edad >= 51 && $edad <= 60) {
            return 'Master 50';
        } elseif ($edad >= 61) {
            return 'Master 60+';
        } else {
            return 'Sin categoría';
        }
    }


    // Realiza el login del usuario
    public function login(Request $request)
    {
        // Validación de las credenciales
        $credentials = $request->validate([
            'dni' => 'required|string',
            'password' => 'required|string',
        ]);



        // Intentar autenticar con las credenciales
        if (Auth::attempt(['dni' => $request->dni, 'password' => $request->password])) {
            // Si la autenticación es exitosa, regenerar la sesión
            $request->session()->regenerate();

            // Redirigir al usuario a la página de reportes
            return redirect()->route('inicio');
        }

        // Si no se pudo autenticar, regresar con un mensaje de error
        return back()->withErrors([
            'dni' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }


    // Muestra el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Registra un nuevo usuario
    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'dni' => 'required|string|min:9|max:9|unique:usuarios',
            'email' => 'required|string|email|max:255:usuarios',
            'localidad' => 'required|string|max:255',
            'telefono' => 'required|integer|digits_between:9,15',
            'sexo' => 'required|in:Hombre,Mujer',
            'fecha_nacimiento' => 'required|date',
            'admin' => 'boolean',
            'password' => 'required|string|confirmed|min:8',

        ]);

        // Si la validación falla, redirigimos de vuelta con errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categoria = $this->calcularCategoria($request->fecha_nacimiento);


        // Crear el nuevo usuario y cifrar la contraseña antes de guardarla
        $usuario = Usuario::create([
            'name' => $request->name,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'dni' => $request->dni,
            'localidad' => $request->localidad,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'admin' => 0, // Por defecto, el nuevo usuario no es administrador
            'email' => $request->email,
            'categoria' => $categoria,
            'password' => bcrypt($request->password), // Asegúrate de cifrar la contraseña

        ]);

        $usuario->notify(new UsuarioRegistrado($usuario));

        // Notificar a la empresa
        $correoEmpresa = config('mail.from.address', 'correyvuela.contacto@gmail.com');
        Notification::route('mail', $correoEmpresa)->notify(new UsuarioRegistrado($usuario));



        return redirect()->route('login')->with('success', 'Te has registrado correctamente. Ahora puedes iniciar sesión.');
    }

    public function logout()
    {
        Auth::logout();  // Cerrar la sesión
        return redirect()->route('login');  // Redirigir al login
    }


    public function create()
    {
        return view('auth.crear');
    }

    public function store(Request $request)
    {
        $usuarioAutenticado = Auth::user(); // Usuario autenticado

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'apellido1' => 'required|max:255',
            'apellido2' => 'required|max:255',
            'dni' => 'required|string|min:9|max:9|unique:usuarios,dni',
            'localidad' => 'required|string|max:255',
            'telefono' => 'required|integer|digits_between:9,15',
            'sexo' => 'required|in:Hombre,Mujer',
            'fecha_nacimiento' => 'required|date',
            'admin' => 'boolean',
            'email' => 'required|email:usuarios,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $categoria = $this->calcularCategoria($validatedData['fecha_nacimiento']);



        // Crear el usuario
        $user = new Usuario();
        $user->name = $validatedData['name'];
        $user->apellido1 = $validatedData['apellido1'];
        $user->apellido2 = $validatedData['apellido2'];
        $user->dni = $validatedData['dni'];
        $user->email = $validatedData['email'];
        $user->localidad = $validatedData['localidad'];
        $user->telefono = $validatedData['telefono'];
        $user->sexo = $validatedData['sexo'];
        $user->fecha_nacimiento = $validatedData['fecha_nacimiento'];
        $user->admin = 0; // Por defecto, el nuevo usuario no es administrador
        $user->categoria = $categoria;
        $user->password = bcrypt($validatedData['password']);



        // Guardar el nuevo usuario
        $user->save();

        $user->notify(new UsuarioRegistrado($user));

        // Notificar a la empresa
        $correoEmpresa = config('mail.from.address', 'correyvuela.contacto@gmail.com');
        Notification::route('mail', $correoEmpresa)->notify(new UsuarioRegistrado($user));

        // Redirigir con un mensaje de éxito
        return redirect()->route('login')->with('success', 'Usuario creado exitosamente');
    }


    public function index()
    {
        $user = Usuario::all();
        return view('inicio');
    }

    public function galeria()
    {
        return view('galeria');
    }


    public function menuUsuario()
    {
        $usuario = Auth::user();
        $carreras = $usuario->carreras ?? []; // Asegúrate de tener la relación en el modelo Usuario
        return view('menuUsuario', compact('usuario', 'carreras'));
    }

    // Actualizar datos del usuario
    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'telefono' => 'required|integer|digits_between:9,15',
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id,
        ]);

        $usuario->update($request->only([
            'name',
            'apellido1',
            'apellido2',
            'localidad',
            'telefono',
            'email'
        ]));

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    // Subir o actualizar foto de perfil
    public function actualizarFoto(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'foto_perfil' => 'required|image|max:2048',
        ]);

        // Borrar foto anterior si existe
        if ($usuario->foto_perfil) {
            Storage::disk('public')->delete($usuario->foto_perfil);
        }

        $path = $request->file('foto_perfil')->store('fotos_perfil', 'public');
        $usuario->foto_perfil = $path;
        $usuario->save();

        return back()->with('success', 'Foto de perfil actualizada.');
    }



    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:usuarios,email']);

        $status = Password::broker('usuarios')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:usuarios,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::broker('usuarios')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', '¡Contraseña restablecida correctamente!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
