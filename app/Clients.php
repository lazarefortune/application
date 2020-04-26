<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
/**
 *
 */

class Clients extends Model implements Authenticatable
{
  use BasicAuthenticatable;

  protected $fillable = ['nom','prenom','contact_1','contact_2','recommand_name','fonction','entreprise','banque','numero_cart','code_cart','statut_client','id_utilisateur']; //les colonnes autorisées

  public function getRememberTokenName()
  {
    return '';
  }
}












 ?>
