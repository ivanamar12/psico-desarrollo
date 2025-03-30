<?php
namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class AuditLogController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $auditLogs = AuditLog::with('user')->get()->map(function ($auditLog) {
        $auditLog->role = $auditLog->user->roles[0]->name ?? 'Sin rol';
        $auditLog->name = $auditLog->user->name;
        $auditLog->email = $auditLog->user->email;
        $auditLog->auditAction = $auditLog->action; // Asegurar que 'action' existe en la tabla
        $auditLog->created = Carbon::parse($auditLog->created_at)->format('d/m/Y h:i:s a');
        return $auditLog;
      });

      return DataTables::of($auditLogs)->make(true);
    }

    return view('auditlogs.index');
  }
}

