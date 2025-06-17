<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SecurityQuestion extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['question'];

  /**
   * Get Security Question for the User
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }
}
