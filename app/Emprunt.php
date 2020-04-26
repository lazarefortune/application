<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
/**
 *
 */

class Emprunt extends Model implements Authenticatable
{
  use BasicAuthenticatable;

  protected $fillable = ['id_client','montant','taux_interet','date_emprunt','date_echeance','statut_emprunt']; //les colonnes autorisées

  public function getRememberTokenName()
  {
    return '';
  }
}












 ?>
