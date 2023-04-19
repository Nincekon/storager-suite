@extends('admin.admin')

@section('title', $actor->exists ? "Modifier une résidence" : "Ajouter une résidence" )

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ $actor->exists ? "Modifier la résidence" : "Ajouter une nouvelle résidence" }}
    </h1>

    <a href="{{ route('admin.actors.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>


<div class="row">

    <div class="col-md-6">

        <!-- Form card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Description de l'acteur
                </h6>
            </div>
            <div class="card-body">

                @if (session()->has('success'))
                <div class="alert alert-success" role="alert">

                    <strong> Bravo !! </strong> {{ session('success') }}
                </div>
                @endif

                @if (session()->has('failure'))
                <div class="alert alert-success" role="alert">

                    <strong> Ooohps !! </strong> {{ session('failure') }}
                </div>
                @endif

                @if (!$errors->isEmpty())
                <div class="alert alert-danger" role="alert">

                    @foreach ($errors->all() as $message)
                        {{ $message }}
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route($actor->exists ? 'admin.actors.update' : 'admin.actors.store', $actor ) }}" class="user needs-validation" novalidate>

                    @csrf
                    @method($actor->exists ? 'PUT' : 'POST')


                    <div class="form-group has-validation">
                        <select name="role_id" class="form-control" id="role_id" aria-describedby="role_id" required>
                            <option selected value=""> Choisir un rôle </option>
                            @forelse ($role as $role)
                            <option  value="{{ $role->id }}"> {{ $role->title }} </option>
                            @empty
                            <option> Aucun rôle disponible </option>
                            @endforelse

                        </select>
                        <div class="invalid-tooltip">
                            Veuillez choisir un rôle valide !
                        </div>
                        @error('role_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="title" required
                            id="title" name="title" min="5" placeholder="Entrez le nom ..." value="{{ old('title') ?? $actor->title }}">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn {{ $actor->exists ? 'btn-warning' : 'btn-primary' }} btn-user btn-block">
                        {{ $actor->exists ? 'Modifier' : 'Enregistrer et valider' }}
                    </button>
                </form>


            </div>
        </div>

    </div>
</div>

@endsection
