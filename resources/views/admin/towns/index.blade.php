@extends('admin.admin')

@section('title')
    Communes
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
    <h1>Les communes</h1>

    <a href="{{ route('admin.towns.create') }}" class="btn btn-primary">
        Nouvelle commune
    </a>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Liste des communes
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($towns as $town)
                    <tr>
                        <td> {{ $town->code }} </td>
                        <td> {{ $town->title }}, {{ $town->city->name }} </td>
                        <td>
                            <div class="d-flex w-100 justify-content-end align-items-between">
                                <a class="btn btn-warning" href="{{ route('admin.towns.edit', $town) }}" title="Modifier la commune">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.towns.destroy', $town) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" onclick="confirm('Voulez-vous vraiment supprimer cette commune ?');">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3"> Aucune commune disponible </td>

                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
