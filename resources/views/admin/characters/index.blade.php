@extends('admin.admin')

@section('title')
    Caractéristiques
@endsection

@section('stylesheets')

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('javascripts')

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

@endsection

@section('container')
<div class="d-flex justify-content-between align-items-center">
    <h1>Les caractéristiques</h1>

    <a href="{{ route('admin.characters.create') }}" class="btn btn-primary">
        Nouvelle caractéristique
    </a>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Liste des caractéristiques
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($characters as $character)
                    <tr>
                        <td> {{ $character->id }} </td>
                        <td> {{ $character->title }} </td>
                        <td>
                            <div class="d-flex w-100 justify-content-end align-items-between">
                                <a class="btn btn-warning" href="{{ route('admin.characters.edit', $character) }}" title="Modifier la ville">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.characters.destroy', $character) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" onclick="confirm('Voulez-vous vraiment supprimer cette caractéristique ?');">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3"> Aucune caractéristique disponible </td>

                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
