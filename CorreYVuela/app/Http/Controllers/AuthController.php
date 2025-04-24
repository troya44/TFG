<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\WelcomeEmail;
use App\Mail\NewUserNotification;
use App\Models\Dispositivo;

use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
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
            'password' => bcrypt($request->password), // Asegúrate de cifrar la contraseña
            
        ]);

        
    

    
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
    $user->password = bcrypt($validatedData['password']);

    

    // Guardar el nuevo usuario
    $user->save();

    // Redirigir con un mensaje de éxito
    return redirect()->route('login')->with('success', 'Usuario creado exitosamente');
}


public function index()
{
    $user = Usuario::all();
    return view('inicio');
}

}