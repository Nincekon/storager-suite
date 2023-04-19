@extends('admin.admin')

@section('title')
    Résidences
@endsection

@section('container')
<div class="d-flex justify-content-between align-items-center">
    <h1>Les résidences</h1>

    <a href="{{ route('admin.residences.create') }}" class="btn btn-primary">
        Nouvelle résidence
    </a>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Liste des residences
        </h6>
    </div>
    <div class="card-body">

        @if (session()->has('success'))
        <div class="alert alert-success role="alert">

            <strong> Bravo !! </strong> {{ session('success') }}
        </div>
        @endif

        @if (session()->has('failure'))
        <div class="alert alert-success" role="alert">

            <strong> Ooohps !! </strong> {{ session('failure') }}
        </div>
        @endif


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Localisation</th>
                        <th>Géré par</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Localisation</th>
                        <th>Géré par</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($residences as $residence)
                    <tr>
                        <td> {{ $residence->id }} </td>
                        <td> {{ $residence->title }} </td>
                        <td> {{ $residence->quarter->town->title }} - {{ $residence->quarter->title }} </td>
                        <td> {{ $residence->user->fullname ?? 'Aucun' }} </td>
                        <td>
                            <div class="d-flex w-100 justify-content-end align-items-between">
                                <a class="btn btn-warning" href="{{ route('admin.residences.edit', $residence) }}" title="Modifier la ville">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.residences.destroy', $residence) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" onclick="confirm('Voulez-vous vraiment supprimer cette residence ?');">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3"> Aucune résidence disponible </td>

                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
