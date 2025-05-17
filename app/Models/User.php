<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements BannableInterface
{
  use HasRoles, HasApiTokens, HasFactory, Notifiable, Bannable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'last_activity',
    'security_question_id',
    'security_answer',
    'primera_vez',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get Security Question for the User
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function securityQuestion(): BelongsTo
  {
    return $this->belongsTo(SecurityQuestion::class);
  }

  public function setSecurityAnswerAttribute($value)
  {
    $this->attributes['security_answer'] = Hash::make($value);
  }

  /**
   * Get all of the auditLogs for the User
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function auditLogs(): HasMany
  {
    return $this->hasMany(AuditLog::class);
  }

  public function aplicacionPruebas()
  {
    return $this->hasMany(AplicacionPrueba::class);
  }
}
