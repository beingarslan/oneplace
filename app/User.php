<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'userid', 'deleted', 'status'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function userRole()
  {
      return $this->hasOne(UserRole::class, 'userid', 'id');
  }
  public function universityInformation()
  {
      return $this->hasOne(UniversityInformation::class, 'userid', 'id');
  }
  public function universitySocial()
  {
      return $this->hasMany(UniversitySocial::class, 'userid', 'id');
  }
  public function department()
  {
      return $this->hasMany(Department::class, 'userid', 'id');
  }
  public function eligibility()
  {
      return $this->hasMany(Eligibility::class, 'userid', 'id');
  }
  public function logs()
  {
      return $this->hasMany(Logs::class, 'userid', 'id');
  }
  public function program()
  {
      return $this->hasMany(Program::class, 'userid', 'id');
  }
  public function universityAnnouncement()
  {
      return $this->hasMany(UniversityAnnouncement::class, 'userid', 'id');
  }
  public function universityAddmission()
  {
      return $this->hasMany(UniversityAddmission::class, 'userid', 'id');
  }

  public function userDetail()
  {
      return $this->hasMany(UserDetail::class, 'userid', 'id');
  }
  public function appliedAdmission()
  {
      return $this->hasMany(AppliedAdmission::class, 'userid', 'id');
  }
}
