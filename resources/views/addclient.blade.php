@extends('layout')

@section('contenulayout')
<style type="text/css">

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
				<a href="{{ url('/') }}" class="btn btn-primary btn-sm"><i class="fas fa-chevron-left"></i></i> </a>
			</div>


		</div>
	</div>
	<hr>
	@include('flash::message')



	  <form class="needs-validation" method="POST" novalidate>
	    {{ csrf_field() }}
			<div class="ml-auto mr-auto row">
				<h4 class="mb-3"><b>Créer un client</b></h4>
			</div>

	    <div class="row">
	      <div class="col-md-6 mb-3">
	        <label for="firstName">nom</label>
	        <input type="text" value="{{ old('nom') }}" class="form-control" id="firstName" placeholder="" name="nom" value="" minlength="3" required>
	        <div class="invalid-feedback">
	          Entrez le nom.
	        </div>
	      </div>
	      <div class="col-md-6 mb-3">
	        <label for="lastName">prenom</label>
	        <input type="text" value="{{ old('prenom') }}" class="form-control" name="prenom" id="lastName" placeholder="" value="" minlength="3" required>
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
	          <input type="text" value="{{ old('contact_1') }}" class="form-control" id="Contact1" placeholder="" name="contact_1" maxlength="9" minlength="8" required>
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
	          <input type="text" value="{{ old('contact_2') }}" class="form-control" id="Contact2" placeholder="" maxlength="9" minlength="8" name="contact_2">
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


	    <div class="col-md-6 mb-3">
	      <label for="Entreprise">Entreprise</label>
	      <input type="text" value="{{ old('entreprise') }}" class="form-control" id="Entreprise" placeholder="" name="entreprise" minlength="3" required>
	      <div class="invalid-feedback">
	        Entrez l'entreprise du client.
	      </div>
	      @if($errors->has('entreprise'))
	        <div class="alert alert-danger" role="alert">
	          {{ $errors->first('entreprise') }}
	        </div>
	      @endif
	    </div>

	    <div class="col-md-6 mb-3">
	      <label for="fonction">Fonction</label>
	      <input type="text" value="{{ old('fonction') }}" class="form-control" id="fonction" placeholder="" name="fonction">
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

	    <div class="col-md-6 mb-3">
	      <label for="myInput">Recommandé par : </label>
	          @foreach($clients as $client)
	          <script type="text/javascript">
		           countries.push('<?= $client->nom ?>');
	          </script>
	          <?php  ?>
	          @endforeach
	            <div class="autocomplete" >
	              <input value="{{ old('recommand_name') }}" name="recommand_name" class="form-control" id="myInput" type="text" name="myInput" placeholder="Saisir le nom du client...">
	              @if($errors->has('recommand_name'))
	                <div class="alert alert-danger" role="alert">
	                  {{ $errors->first('recommand_name') }}
	                </div>
	              @endif
	            </div>



	    </div>

	    <div class="col-md-6 mb-3">
	      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Statut du client : </label>

	      <div class="btn-group btn-group-toggle" data-toggle="buttons">
	        <label class="btn btn-primary btn-sm active">
	          <input type="radio" name="statut_client" value="0" id="option1" autocomplete="off" checked> Aucun
	        </label>
	        <label class="btn btn-primary btn-sm">
	          <input type="radio" name="statut_client" value="1" id="option2" autocomplete="off"> <i class="far fa-thumbs-up"></i>
	        </label>
	        <label class="btn btn-primary btn-sm">
	          <input type="radio" name="statut_client" value="2" id="option3" autocomplete="off"> <i class="far fa-thumbs-down"></i>
	        </label>
	      </div>

	      @if($errors->has('statut_client'))
	        <div class="alert alert-danger" role="alert">
	          {{ $errors->first('statut_client') }}
	        </div>
	      @endif
	    </div>
			</div>






	    <hr class="mb-4">

	    <h4 class="mb-3"><b>Carte visa</b></h4>
	    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	      Ajouter carte visa
	    </button>
	    <div class="collapse" id="collapseExample">
	      <div class="row" >

	        <div class="col-md-6 mb-3">
	          <label for="banque">Banque</label>
	          <select class="custom-select d-block w-100" id="banque" name="banque" >
	            <optgroup label="Choisir...">
	              <option>BGFI</option>
	              <option>BICIG</option>
	              <option>Orabank</option>
								<option>Finam</option>
	              <option>Finatra</option>
	              <option>U.B.A</option>
	              <option>U.G.B</option>
	              <option selected></option>
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
	          <input type="number" value="{{ old('numero_cart') }}" class="form-control" id="cc-number" placeholder="" name="numero_cart">
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
	          <input type="number" value="{{ old('code_cart') }}" class="form-control" id="cc-expiration" placeholder="" name="code_cart">
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


	    <script type="text/javascript">
	      function calcul(){
	          var montant = Number(document.getElementById("montant").value);

	          var taux = Number(document.getElementById("taux").value);

	          var total = Number((montant + (montant * taux)/100));
	          document.getElementById("total").value = total;
	      }

	      </script>

	    <hr class="mb-4">


	    <button class="btn btn-primary btn-lg btn-block" type="submit" name="newclient">Créer le client</button>

	  </form>
	</div>



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
@endsection
