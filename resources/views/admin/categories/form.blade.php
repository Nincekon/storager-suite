@extends('admin.admin')

@section('title', $category->exists ? "Modifier une catégorie" : "Ajouter une catégorie" )

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ $category->exists ? "Modifier la catégorie" : "Ajouter une nouvelle catégorie" }}
    </h1>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>



<div class="row">
    <div class="offset-3 col-md-6">

        <!-- Form card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Description de la catégorie
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


                <form method="POST" action="{{ route($category->exists ? 'admin.categories.update' : 'admin.categories.store', $category ) }}" class="user needs-validation" novalidate>

                    @csrf
                    @method($category->exists ? 'PUT' : 'POST')

                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="validationCategoryNamePrepend" required
                            id="validationCategoryTitle" name="name" min="5" placeholder="Entrez le nom ..." value="{{ old('name') ?? $category->name }}">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn {{ $category->exists ? 'btn-warning' : 'btn-primary' }} btn-user btn-block">
                        {{ $category->exists ? 'Modifier' : 'Valider' }}
                    </button>
                </form>


            </div>
        </div>

    </div>
</div>

@endsection
