<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\PasswordUpdatedNotification;
use DataTables;

class PerfilController extends Controller
{
    // Muestra la vista del perfil del usuario autenticado
    public function index()
    {
        return view('perfil.index', ['user' => Auth::user()]);
    }

    // Actualiza la información del perfil del usuario autenticado
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'pregunta_seguridad' => 'required|string|max:255',
            'respuesta_seguridad' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->pregunta_seguridad = $request->pregunta_seguridad;
        $user->respuesta_seguridad = $request->respuesta_seguridad;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);

            // Notificar al administrador sobre el cambio de contraseña
            $admin = User::role('admin')->first();
            if ($admin) {
                $admin->notify(new PasswordUpdatedNotification($user));
            }
        }

        // Después de actualizar, marcar como no primera vez
        if ($user->primera_vez) {
            $user->primera_vez = false;
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'Perfil actualizado correctamente']);
    }


    public function list()
{
    return datatables()->of(User::select('id', 'name', 'email', 'last_activity')
        ->with('roles')
    )
    ->addColumn('estado', function ($usuario) {
        if (!$usuario->last_activity) {
            return '<span class="text-danger">●</span>'; // Rojo si no tiene actividad registrada
        }
        // Si la diferencia en minutos es menor a 10, lo consideramos activo
        return now()->diffInMinutes($usuario->last_activity) < 10
            ? '<span class="text-success">●</span>' // Verde si está activo
            : '<span class="text-danger">●</span>'; // Rojo si no está activo
    })
    ->addColumn('role', function ($user) {
        return $user->roles->pluck('name')->implode(', ');
    })
    ->addColumn('action', function ($usuario) {
        return '
            <button class="btn btn-info btn-raised btn-xs ver-usuario" data-id="' . $usuario->id . '">
                <i class="zmdi zmdi-eye"></i>
            </button>
            <button class="delete btn btn-danger btn-raised btn-xs eliminar-usuario" data-id="' . $usuario->id . '" data-toggle="modal" data-target="#confirmarEliminar">
                <i class="zmdi zmdi-delete"></i>
            </button>
        ';
    })
    ->rawColumns(['estado', 'action'])
    ->make(true);
}

    

    // Obtiene la lista de usuarios excluyendo al administrador
    public function getUsuarios(Request $request)
    {
        if ($request->ajax()) {
            $usuarios = User::where('role', '!=', 'admin')
                ->select('id', 'name', 'email', 'role', 'last_activity')
                ->get();

            return DataTables::of($usuarios)
                ->addColumn('estado', function ($usuario) {
                    if (!$usuario->last_activity) {
                        return '<span class="text-danger">●</span>'; // Rojo si no tiene actividad registrada
                    }
                    $estado = now()->diffInMinutes($usuario->last_activity) < 10
                        ? '<span class="text-success">●</span>'
                        : '<span class="text-danger">●</span>';
                    return $estado;
                })
                ->addColumn('action', function ($usuario) {
                    return '
                        <button class="btn btn-info btn-xs ver-usuario" data-id="' . $usuario->id . '">
                            <i class="zmdi zmdi-eye"></i>
                        </button>
                        <button class="btn btn-danger btn-xs eliminar-usuario" data-id="' . $usuario->id . '" data-toggle="modal" data-target="#confirmarEliminar">
                            <i class="zmdi zmdi-delete"></i>
                        </button>

                    ';
                })
                ->rawColumns(['estado', 'action'])
                ->make(true);
        }
    }

    // Muestra los detalles de un usuario en el modal de visualización
    public function show($id)
{
    $usuario = User::with('roles')->find($id); // Carga el rol con `with()`
    
    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    return response()->json([
        'id' => $usuario->id,
        'nombre' => $usuario->name,
        'email' => $usuario->email,
        'rol' => $usuario->roles->pluck('name') // Extrae solo el nombre del rol
    ]);
}


    // Obtiene la información de un usuario para edición
    public function edit($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario);
    }

    public function destroy($id)
{
    $usuario = User::find($id);
    
    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // No permitir que un usuario se elimine a sí mismo
    if (Auth::id() == $usuario->id) {
        return response()->json(['error' => 'No puedes eliminar tu propia cuenta'], 403);
    }

    $usuario->delete();

    return response()->json(['success' => 'Usuario eliminado correctamente']);
}

}
