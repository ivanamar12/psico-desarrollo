<?php

namespace App\Http\Controllers;

use App\Models\SecurityQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\PasswordUpdatedNotification;
use Yajra\DataTables\Facades\DataTables;

class PerfilController extends Controller
{
  // Muestra la vista del perfil del usuario autenticado
  public function index()
  {
    $user = Auth::user();
    $user->securityQuestion;
    $preguntas = SecurityQuestion::all();

    return view('perfil.index', [
      'user' => $user,
      'preguntas' => $preguntas
    ]);
  }

  // Actualiza la información del perfil del usuario autenticado
  public function update(Request $request)
  {
    $user = Auth::user();

    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'password' => 'nullable|min:8|confirmed',
      'security_question_id' => 'required|exists:security_questions,id',
      'security_answer' => 'required|string|max:255',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->security_question_id = $request->security_question_id;
    $user->security_answer = Hash::make($request->security_answer);

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
    return datatables()->of(
      User::select('id', 'name', 'email', 'last_activity')
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
        ';
      })
      ->rawColumns(['estado', 'action'])
      ->make(true);
  }

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
          ';
        })
        ->rawColumns(['estado', 'action'])
        ->make(true);
    }
  }

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

  public function edit($id)
  {
    $usuario = User::find($id);
    if (!$usuario) {
      return response()->json(['error' => 'Usuario no encontrado'], 404);
    }
    return response()->json($usuario);
  }
}
