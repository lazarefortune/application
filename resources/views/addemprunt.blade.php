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

<div class="container col-sm-10">
@include('flash::message')
<div class="col-md-12 order-md-1">
  <form class="needs-validation" method="POST" novalidate>
    {{ csrf_field() }}

    <div class="d-flex justify-content-between">
      <a href="add-client" class="btn btn-primary"><i class="fas fa-chevron-left"></i></i> Ajouter un client</a>
      <a href="mes-clients" class="btn btn-success">Voir la liste des clients <i class="fas fa-chevron-right"></i></a>
    </div>
    <h4 class="mb-3"><b>Ajouter un emprunt</b></h4>


      <?php
      $clients = DB::select('select id,nom from clients where id_utilisateur = ?', [(auth()->user()->id)]);

      ?>

      <script type="text/javascript">
        var countries = [];
      </script>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="myInput">Emprunt fait à : </label>
              @foreach($clients as $client)
              <script type="text/javascript">
    	           countries.push('<?= $client->nom ?>');
              </script>
              <?php  ?>
              @endforeach

                  <input value="{{ old('id_client') }}" name="id_client" class="form-control" id="myInput" type="text" name="myInput" placeholder="Saisir le nom du client...">
                <div class="autocomplete col-sm-6" >
                </div>
                @if($errors->has('id_client'))
                  <div class="alert alert-danger" role="alert">
                    {{ $errors->first('id_client') }}
                  </div>
                @endif



        </div>

        <div class="col-md-6 mb-3">
          <label for="montant">Montant de l'emprunt</label>
          <input type="text" class="form-control" id="montant" placeholder=""  onblur="calcul()" name="montant">
          <div class="invalid-feedback">
            Montant de l'emprunt
          </div>
  				@if($errors->has('montant'))
  					<div class="alert alert-danger" role="alert">
  						{{ $errors->first('montant') }}
  					</div>
  				@endif
        </div>
    </div>
    <div  class="row" >
      <div class="col-md-6 mb-3">
        <label for="taux">Taux d'intérêt</label>
        <select class="custom-select d-block w-100" id="taux"  onblur="calcul()" name="taux_interet">
          <optgroup label="Choisir...">
            <option value="20">20%</option>
            <option value="25">25%</option>
            <option value="30">30%</option>
            <option value="35">35%</option>
            <option value="40">40%</option>
            <option value="45">45%</option>
            <option selected></option>
          </optgroup>
        </select>
        <div class="invalid-feedback">
          Please select a valid ratio.
        </div>
				@if($errors->has('taux_interet'))
					<div class="alert alert-danger" role="alert">
						{{ $errors->first('taux_interet') }}
					</div>
				@endif

      </div>






      <div class="col-md-6 mb-3">
        <label for="total">montant dû</label>
        <input type="text" class="form-control" id="total" placeholder="" disabled>

      </div>

    </div>

      <div class="col-md-6 mb-3">
        <label for="example-date-input">Date de remboursement</label>
        <input class="form-control" type="date"  id="example-date-input" name="date_echeance">
        <div class="invalid-feedback">
          Choisissez une date
        </div>
				@if($errors->has('date_echeance'))
					<div class="alert alert-danger" role="alert">
						{{ $errors->first('date_echeance') }}
					</div>
				@endif
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


    <button class="btn btn-primary btn-lg btn-block" type="submit" name="newclient">Ajouter l'emprunt</button>
  </form>
</div>
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
