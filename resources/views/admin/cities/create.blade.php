@extends('admin.admin')

@section('title')
    Ajouter une ville
@endsection

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ajouter une nouvelle ville</h1>


<div class="row">
    <div class="offset-3 col-md-6">

        <!-- Form card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Description de la ville
                </h6>
            </div>
            <div class="card-body">


                <form method="POST" action="{{ route('admin.cities.store') }}" class="user needs-validation" novalidate>

                    @csrf

                    <div class="form-group has-validation">
                        <input type="text" class="form-control form-control-user" aria-describedby="validationCityNamePrepend" required
                            id="validationCityTitle" name="name" placeholder="Entrez le nom ...">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Valider
                    </button>
                </form>


            </div>
        </div>

    </div>
</div>

@endsection
