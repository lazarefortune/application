<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
/**
 *
 */

class Utilisateurs extends Model implements Authenticatable
{
  use BasicAuthenticatable;

  protected $fillable = ['name','email','password']; //les colonnes autorisées

  public function getRememberTokenName()
  {
    return '';
  }
}












 ?>
