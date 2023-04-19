@extends('admin.admin')

@section('title', $city->exists ? "Modifier une ville" : "Ajouter une ville" )

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ $city->exists ? "Modifier la ville" : "Ajouter une nouvelle ville" }}
    </h1>

    <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>



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

                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>

                    <strong> Bravo !! </strong> {{ session('success') }}
                </div>
                @endif

                @if (session()->has('failure'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>

                    <strong> Ooohps !! </strong> {{ session('failure') }}
                </div>
                @endif


                <form method="POST" action="{{ route($city->exists ? 'admin.cities.update' : 'admin.cities.store', $city ) }}" class="user needs-validation" novalidate>

                    @csrf
                    @method($city->exists ? 'PUT' : 'POST')

                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="validationCityNamePrepend" required
                            id="validationCityTitle" name="name" min="5" placeholder="Entrez le nom ..." value="{{ old('name') ?? $city->name }}">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn {{ $city->exists ? 'btn-warning' : 'btn-primary' }} btn-user btn-block">
                        {{ $city->exists ? 'Modifier' : 'Valider' }}
                    </button>
                </form>


            </div>
        </div>

    </div>
</div>

@endsection
