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

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\AuditLog  $auditLog
   * @return \Illuminate\Http\Response
   */
  public function show(AuditLog $auditLog)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\AuditLog  $auditLog
   * @return \Illuminate\Http\Response
   */
  public function edit(AuditLog $auditLog)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\AuditLog  $auditLog
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, AuditLog $auditLog)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\AuditLog  $auditLog
   * @return \Illuminate\Http\Response
   */
  public function destroy(AuditLog $auditLog)
  {
    //
  }
}
