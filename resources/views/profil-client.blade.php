@extends('layout')

@section('contenulayout')
@if(!empty($client))
<style type="text/css">
    input {
      border: 1px solid transparent;
      background-color: #f1f1f1;
      padding: 10px;
      font-size: 16px;
    }
    .input_style {
      background-color: #f1f1f1;
      width: 100%;
    }
		.autocomplete {
		  /*the container must be positioned relative:*/
		  position: relative;
		  display: inline-block;
		}

		.autocomplete-items {
		  position: absolute;
		  border: 1px solid #d4d4d4;
		  border-bottom: none;
		  border-top: none;
		  z-index: 99;
		  /*position the autocomplete items to be the same width as the container:*/
		  top: 100%;
		  left: 0;
		  right: 0;
		}
		.autocomplete-items div {
		  padding: 10px;
		  cursor: pointer;
		  background-color: #fff;
		  border-bottom: 1px solid #d4d4d4;
		}
		.autocomplete-items div:hover {
		  /*when hovering an item:*/
		  background-color: #e9e9e9;
		}
		.autocomplete-active {
		  /*when navigating through the items using the arrow keys:*/
		  background-color: DodgerBlue !important;
		  color: #ffffff;
		}
	</style>

  <div class="row">
		<div class="col-sm-12">
			<div class="d-flex justify-content-between">
				<a href="{{ url('mes-clients') }}" class="btn btn-primary btn-sm"><i class="fas fa-chevron-left"></i></i> </a>
			</div>


		</div>
	</div>
	<hr>
	@include('flash::message')



  <form class="needs-validation" method="POST" novalidate>
    {{ csrf_field() }}
  <h4 class="mb-3"><b>Profil du client </b></h4>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="firstName">nom</label>
        <input type="text" value="<?= $client[0]->nom  ?>" class="form-control input_style" id="firstName" placeholder="" name="nom" value="" required>
        <div class="invalid-feedback">
          Entrez le nom.
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="lastName">prenom</label>
        <input type="text" value="<?= $client[0]->prenom  ?>" class="form-control input_style" name="prenom" id="lastName" placeholder="" value="<?= $client[0]->nom  ?>" required>
        <div class="invalid-feedback">
          Entrez le prenom.
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="Contact1">Contact 1</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">+241</span>
          </div>
          <input type="text" value="<?= $client[0]->contact_1  ?>" class="form-control input_style" id="Contact1" placeholder="" name="contact_1" required>
          <div class="invalid-feedback" style="width: 100%;">
            Entrez le numéro 1.
          </div>
        </div>
        @if($errors->has('contact_1'))
          <div class="alert alert-danger" role="alert">
            {{ $errors->first('contact_1') }}
          </div>
        @endif

      </div>
      <div class="col-md-6 mb-3">
        <label for="Contact2">Contact 2</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">+241</span>
          </div>
          <input type="text" value="<?= $client[0]->contact_2  ?>" class="form-control input_style" id="Contact2" placeholder="" name="contact_2">
          <div class="invalid-feedback" style="width: 100%;">
            Entrez le numéro 2.
          </div>
          @if($errors->has('contact_2'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('contact_2') }}
            </div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">


    <div class="col-sm-6 mb-3">
      <label for="Entreprise">Entreprise</label>
      <input type="text" value="<?= $client[0]->entreprise  ?>" class="form-control input_style" id="Entreprise" placeholder="" name="entreprise" required>
      <div class="invalid-feedback">
        Entrez l'entreprise du client.
      </div>
      @if($errors->has('entreprise'))
        <div class="alert alert-danger" role="alert">
          {{ $errors->first('entreprise') }}
        </div>
      @endif
    </div>

    <div class="col-sm-6 mb-3">
      <label for="fonction">Fonction</label>
      <input type="text" value="<?= $client[0]->fonction  ?>" class="form-control input_style" id="fonction" placeholder="" name="fonction">
      <div class="invalid-feedback">
        Entrez la fonction du client.
      </div>
      @if($errors->has('fonction'))
        <div class="alert alert-danger" role="alert">
          {{ $errors->first('fonction') }}
        </div>
      @endif
    </div>

    </div>
    <?php
    $clients = DB::select('select id,nom from clients where id_utilisateur = ?', [(auth()->user()->id)]);

    ?>

    <script type="text/javascript">
      var countries = [];
    </script>

    <div class="row">

    <div class="col-sm-6 mb-3">
      <label for="myInput">Recommandé par : </label>
          @foreach($clients as $client_liste)
          <script type="text/javascript">
	           countries.push('<?= $client_liste->nom ?>');
          </script>
          <?php  ?>
          @endforeach
          <?php
          $nom_reco = DB::select('select nom from clients where id = ?', [($client[0]->recommand_name)]);
          ?>
            <div class="autocomplete" >
              <input value="<?php if(!empty($nom_reco)){ echo $nom_reco[0]->nom; }  ?>" name="recommand_name" class="form-control input_style" id="myInput" type="text" name="myInput" placeholder="Saisir le nom du client...">
            </div>


      @if($errors->has('recommand_name'))
        <div class="alert alert-danger" role="alert">
          {{ $errors->first('recommand_name') }}
        </div>
      @endif
    </div>

    <div class="col-md-6 mb-3">
      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Statut du client : </label>

      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary btn-sm <?php if(($client[0]->statut_client)== 0){ echo 'active'; } ?>">
        <input type="radio" name="statut_client" value="0" id="option1" autocomplete="off" <?php if(($client[0]->statut_client)== 'Aucun'){ printf('checked'); } ?>>Aucun
        </label>
        <label class="btn btn-primary btn-sm <?php if(($client[0]->statut_client)== 1){ echo 'active'; } ?>">
          <input type="radio" name="statut_client" value="1" id="option2" autocomplete="off" <?php if(($client[0]->statut_client)== 1){ echo 'checked'; } ?>> <i class="far fa-thumbs-up"></i>
        </label>
        <label class="btn btn-primary btn-sm <?php if(($client[0]->statut_client)== 2){ echo 'active'; } ?>">
          <input type="radio" name="statut_client" value="2" id="option3" autocomplete="off" <?php if(($client[0]->statut_client)== 2){ echo 'checked'; } ?>> <i class="far fa-thumbs-down" ></i>
        </label>
      </div>

      @if($errors->has('statut_client'))
        <div class="alert alert-danger" role="alert">
          {{ $errors->first('statut_client') }}
        </div>
      @endif
    </div>

    </div>







    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Voir les informations de la carte visa
    </button>
    <div class="collapse" id="collapseExample">
      <div class="row" >

        <div class="col-md-6 mb-3">
          <label for="banque">Banque : <b><?= $client[0]->banque  ?></b> </label>
          <select class="custom-select d-block w-100" id="banque" name="banque" >
            <optgroup label="Choisir...">
              <option>BGFI</option>
              <option>BICIG</option>
              <option>Finam</option>
              <option>Finatra</option>
              <option>Orabank</option>
              <option>U.B.A</option>
              <option>U.G.B</option>
              <option selected><?= $client[0]->banque  ?></option>
            </optgroup>
          </select>
          <div class="invalid-feedback">
            Please select a valid Bank.
          </div>
          @if($errors->has('banque'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('banque') }}
            </div>
          @endif
        </div>
        <div class="col-md-6 mb-3">
          <label for="cc-number">Numero de la carte</label>
          <input type="text" value="<?= $client[0]->numero_cart  ?>" class="form-control" id="cc-number" placeholder="" maxlength="9" name="numero_cart">
          <div class="invalid-feedback">
            Credit card number is required
          </div>
          @if($errors->has('numero_cart'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('numero_cart') }}
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="cc-expiration">Code de la carte</label>
          <input type="text" value="<?= $client[0]->code_cart  ?>" class="form-control" id="cc-expiration" maxlength="5" placeholder="" name="code_cart">
          <div class="invalid-feedback">
            Cart code required
          </div>
          @if($errors->has('code_cart'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('code_cart') }}
            </div>
          @endif
        </div>
      </div>
    </div>
    <hr class="mb-4">

    <div class="row">
      <div class="col-sm-6">
        <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-danger btn-lg btn-block" name="button">Supprimer le client</button>
      </div>

      <div class="col-sm-6">
        <button class="btn btn-success btn-lg btn-block" type="submit" name="newclient">Mettre à jour</button>
      </div>

    </div>

    <hr>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle" style="color: red;">Vous êtes sur le point de supprimer le client suivant :</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <div class="modal-body text-center">
            <h3> <b><?= $client[0]->nom, ' ',$client[0]->prenom ?></b></h3>

          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <a href="{{ url('delete-client') }}/<?= $client[0]->id ?>"><button type="button" class="btn btn-danger">Oui supprimer</button></a>

          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function calcul(){
          var montant = Number(document.getElementById("montant").value);

          var taux = Number(document.getElementById("taux").value);

          var total = Number((montant + (montant * taux)/100));
          document.getElementById("total").value = total;
      }

      </script>

    <hr class="mb-4">

  </form>









<script type="text/javascript">
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
'use strict'

window.addEventListener('load', function () {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation')

  // Loop over them and prevent submission
  Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
      if (form.checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
}, false)
}())
</script>

<script type="text/javascript">
	function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}
</script>

 <script>
autocomplete(document.getElementById("myInput"), countries);
</script>
@endif
@endsection
