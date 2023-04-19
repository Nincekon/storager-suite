@extends('admin.admin')

@section('title', $quarter->exists ? "Modifier un quartier" : "Ajouter un quartier" )

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ $quarter->exists ? "Modifier le quartier" : "Ajouter un nouveau quartier" }}
    </h1>

    <a href="{{ route('admin.quarters.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>



<div class="row">
    <div class="offset-3 col-md-6">

        <!-- Form card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Description du quartier
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


                <form method="POST" action="{{ route($quarter->exists ? 'admin.quarters.update' : 'admin.quarters.store', $quarter ) }}" class="user needs-validation" novalidate>

                    @csrf
                    @method($quarter->exists ? 'PUT' : 'POST')

                    <div class="form-group has-validation">
                        <select name="town_id" class="form-control" id="town_id" aria-describedby="town_id" required>
                            <option selected value=""> Choisir une commune </option>
                            @forelse ($towns as $town)
                            <option @selected(old('town_id', $quarter->town_id) == $town->id ) value="{{ $town->id }}"> {{ $town->title }} </option>
                            @empty
                            <option> Aucune commune disponible </option>
                            @endforelse

                        </select>
                        <div class="invalid-tooltip">
                            Veuillez choisir une commune valide !
                        </div>
                        @error('town_id')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="code" required
                            id="code" name="code" min="2" placeholder="Entrez le code ..." value="{{ old('code') ?? $quarter->code }}">
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
                            id="title" name="title" min="5" placeholder="Entrez le nom ..." value="{{ old('title') ?? $quarter->title }}">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn {{ $quarter->exists ? 'btn-warning' : 'btn-primary' }} btn-user btn-block">
                        {{ $quarter->exists ? 'Modifier' : 'Valider' }}
                    </button>
                </form>


            </div>
        </div>

    </div>
</div>

@endsection
