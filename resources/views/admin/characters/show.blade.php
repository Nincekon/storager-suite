@extends('admin.admin')

@section('title', "Décrire une caractéristique")

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ "Description de la caractéristique"}}
    </h1>

    <a href="{{ route('admin.characters.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>



        <!-- Form card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    La caractéristique et ses résidences
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


                <div class="row">

                    <div class="col-md-6">

                        <form method="POST" action="{{ route('admin.characters.update', $character ) }}" class="user needs-validation" novalidate>

                            @csrf
                            @method('PUT')

                            <div class="form-group has-validation">
                                <input type="text" class="form-control form-control-user" aria-describedby="validationCharacterTitlePrepend" required
                                    id="validationCharacterTitle" name="title" min="5" placeholder="Entrez le nom ..." value="{{ old('title') ?? $character->title }}">
                                <div class="invalid-tooltip">
                                    Un nom valide doit faire au minimum 5 caractères
                                </div>
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Valider
                            </button>
                        </form>

                    </div>
                    <div class="col-md-6">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Localisation</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($character->residences as $residence)
                                    <tr>
                                        <td> {{ $residence->id }} </td>
                                        <td> {{ $residence->title }} </td>
                                        <td>
                                            {{ $residence->quarter->town->title, $residence->quarter->title }}
                                        </td>
                                        <td>
                                            <div class="d-flex w-100 justify-content-end align-items-between">
                                                <a class="btn btn-warning" href="{{ route('admin.residences.show', $residence) }}" title="Plus de détails">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4"> Aucune caractéristique disponible </td>

                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
