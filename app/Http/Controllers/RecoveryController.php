<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Secretaria; // Asegúrate de importar tus modelos
use App\Models\Especialista; // Asegúrate de importar tus modelos
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Role as EnumRole; // Para usar tus ENUMs

class RecoveryController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Correo no encontrado'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'question' => $user->security_question
        ]);
    }

    public function validateAnswer(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if ($user && Hash::check($request->answer, $user->security_answer)) {
            // Determinar rol original
            $rolOriginal = $this->determinarRolOriginal($user->email);
            
            // Desbloquear usuario
            $user->update(['failed_attempts' => 0]);
            $user->removeRole(EnumRole::BLOQUEADO->value);
            
            // Restaurar rol original si no lo tiene
            if ($rolOriginal && !$user->hasRole($rolOriginal)) {
                $user->assignRole($rolOriginal);
            }
            
            // Generar token para resetear contraseña
            $token = Str::random(60);
            $user->forceFill(['remember_token' => $token])->save();
            
            return response()->json([
                'success' => true,
                'token' => $token
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Respuesta incorrecta'
        ]);
    }

    // Método para determinar el rol original
    protected function determinarRolOriginal($email)
    {
        if (Especialista::where('email', $email)->exists()) {
            return EnumRole::ESPECIALISTA->value;
        } elseif (Secretaria::where('email', $email)->exists()) {
            return EnumRole::SECRETARIA->value;
        }
        
        return null; // O un rol por defecto si es necesario
    }

    public function showResetForm(Request $request)
    {
        $token = $request->token;
        $user = User::where('remember_token', $token)->firstOrFail();
        
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $user->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);
        
        $user = User::where('remember_token', $request->token)->first();
        
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => null,
                'primera_vez' => true // Asumo que quieres redirigir a perfil
            ]);
            
            // Autenticar
            auth()->login($user);
            
            // Redirigir a perfil (como mencionaste)
            return redirect('/perfil')->with([
                'success' => 'Contraseña actualizada correctamente'
            ]);
        }
        
        return back()->withErrors(['email' => 'Token inválido']);
    }
}