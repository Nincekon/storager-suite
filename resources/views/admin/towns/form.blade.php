@extends('admin.admin')

@section('title', $town->exists ? "Modifier une commune" : "Ajouter une commune" )

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ $town->exists ? "Modifier la commune" : "Ajouter une nouvelle commune" }}
    </h1>

    <a href="{{ route('admin.towns.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>



<div class="row">
    <div class="offset-3 col-md-6">

        <!-- Form card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Description de la commune
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


                <form method="POST" action="{{ route($town->exists ? 'admin.towns.update' : 'admin.towns.store', $town ) }}" class="user needs-validation" novalidate>

                    @csrf
                    @method($town->exists ? 'PUT' : 'POST')

                    <div class="form-group has-validation">
                        <select name="city_id" class="form-control" id="city_id" aria-describedby="city_id" required>
                            <option selected value=""> Choisir une ville </option>
                            @forelse ($cities as $city)
                            <option @selected(old('city_id', $town->city_id) == $city->id ) value="{{ $city->id }}"> {{ $city->name }} </option>
                            @empty
                            <option> Aucune ville disponible </option>
                            @endforelse

                        </select>
                        <div class="invalid-tooltip">
                            Veuillez choisir une ville valide !
                        </div>
                        @error('city_id')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="code" required
                            id="code" name="code" min="2" placeholder="Entrez le code ..." value="{{ old('code') ?? $town->code }}">
                        <div class="invalid-tooltip">
                            Un code valide doit faire au minimum 2 caractères
                        </div>
                        @error('code')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="title" required
                            id="title" name="title" min="5" placeholder="Entrez le nom ..." value="{{ old('title') ?? $town->title }}">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn {{ $town->exists ? 'btn-warning' : 'btn-primary' }} btn-user btn-block">
                        {{ $town->exists ? 'Modifier' : 'Valider' }}
                    </button>
                </form>


            </div>
        </div>

    </div>
</div>

@endsection
