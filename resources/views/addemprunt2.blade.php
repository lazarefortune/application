@extends('layout')

@section('contenulayout')




<div class="row">
  <div class="col-sm-12">
    <div class="d-flex justify-content-between">
      <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fas fa-chevron-left"></i></i> </a>
    </div>
  </div>
</div>
  <hr>
  @include('flash::message')





  <form class="needs-validation" method="POST" novalidate>
    {{ csrf_field() }}


    <h5 class="mb-3">Ajouter un emprunt à : <b>{{ $nom_complet_client }}</b></h5>


      <div class="row">


        <div class="col-md-6 mb-3">
          <label for="montant">Montant de l'emprunt</label>
          <input type="text" class="form-control" id="montant" placeholder=""  onblur="calcul()" name="montant" required>
          <div class="invalid-feedback">
            Definissez un montant
          </div>
  				@if($errors->has('montant'))
  					<div class="alert alert-danger" role="alert">
  						{{ $errors->first('montant') }}
  					</div>
  				@endif
        </div>

				<div class="col-md-6 mb-3">
	        <label for="taux">Taux d'intérêt</label>
	        <select class="custom-select d-block w-100" id="taux"  onblur="calcul()" name="taux_interet" required>
	          	<option value="">Choisir...</option>
	            <option value="20">20%</option>
	            <option value="25">25%</option>
	            <option value="30">30%</option>
	            <option value="35">35%</option>
	            <option value="40">40%</option>
	            <option value="45">45%</option>


	        </select>
	        <div class="invalid-feedback">
	          Choisissez un taux d'intérêt
	        </div>
					@if($errors->has('taux_interet'))
						<div class="alert alert-danger" role="alert">
							{{ $errors->first('taux_interet') }}
						</div>
					@endif

	      </div>



    </div>
    <div  class="row" >

      <div class="col-md-6 mb-3">
        <label for="total">montant dû</label>
        <input type="text" class="form-control" id="total" placeholder="" disabled>

      </div>

			<div class="col-md-6 mb-3">
        <label for="example-date-input">Date de remboursement</label>
        <input class="form-control" type="date"  id="example-date-input" name="date_echeance" required>
        <div class="invalid-feedback">
          Choisissez une date
        </div>
				@if($errors->has('date_echeance'))
					<div class="alert alert-danger" role="alert">
						{{ $errors->first('date_echeance') }}
					</div>
				@endif
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


    <div class="row">
      <div class="col-sm-12">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="newclient">Ajouter l'emprunt</button>
      </div>

    </div>

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





@endsection
