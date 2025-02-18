<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class AuditLogController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $auditLogs = AuditLog::with('user')->get()->map(function ($auditLog) {
      $auditLog->role = $auditLog->user->roles[0]->name;
      $auditLog->name = $auditLog->user->name;
      $auditLog->email = $auditLog->user->email;
      $auditLog->auditAction = $auditLog->action;
      $auditLog->created = Carbon::parse($auditLog->created_at)->format('d/m/Y h:i:s a');
      return $auditLog;
    });

    if ($request->ajax()) {
      return DataTables::of($auditLogs)
        ->addColumn('action', function ($auditLog) {
          $acciones = '<button type="button" name="delete" id="' . $auditLog->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';

          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('auditlogs.index', [
      'auditLogs' => $auditLogs,
    ]);
  }


}
