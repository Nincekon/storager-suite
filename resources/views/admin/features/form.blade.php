@extends('admin.admin')

@section('title', $feature->exists ? "Modifier une commodité" : "Ajouter une commodité" )

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ $feature->exists ? "Modifier la commodité" : "Ajouter une nouvelle commodité" }}
    </h1>

    <a href="{{ route('admin.features.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>



<div class="row">
    <div class="offset-3 col-md-6">

        <!-- Form card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Description de la commodité
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


                <form method="POST" action="{{ route($feature->exists ? 'admin.features.update' : 'admin.features.store', $feature ) }}" class="user needs-validation" novalidate>

                    @csrf
                    @method($feature->exists ? 'PUT' : 'POST')

                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="title" required
                            id="title" name="title" min="5" placeholder="Entrez le nom ..." value="{{ old('title') ?? $feature->title }}">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn {{ $feature->exists ? 'btn-warning' : 'btn-primary' }} btn-user btn-block">
                        {{ $feature->exists ? 'Modifier' : 'Valider' }}
                    </button>
                </form>


            </div>
        </div>

    </div>
</div>

@endsection
