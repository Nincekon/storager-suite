@extends('admin.admin')

@section('title')
    Acteurs
@endsection

@section('container')
<div class="d-flex justify-content-between align-items-center">
    <h1>Les acteurs</h1>

    <a href="{{ route('admin.actors.create') }}" class="btn btn-primary">
        Nouvel acteur
    </a>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Liste des acteurs
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
                        <th>Username</th>
                        <th>Nom complet</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nom complet</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($actors as $actor)
                    <tr>
                        <td> {{ $actor->id }} </td>
                        <td> {{ $actor->name }} </td>
                        <td> {{ $actor->fullname ?? 'Aucun' }} </td>
                        <td>
                            @forelse ($actor->roles as $role)
                                <span class="badge bg-secondary">{{ $role->title }}</span>*
                            @empty
                                Aucun
                            @endforelse
                        </td>
                        <td>
                            <div class="d-flex w-100 justify-content-end align-items-between">
                                <a class="btn btn-warning" href="{{ route('admin.actors.edit', $actor) }}" title="Modifier l'acteur'">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.actors.destroy', $actor) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" onclick="confirm('Voulez-vous vraiment supprimer cet acteur ?');">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3"> Aucune acteur disponible </td>

                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
