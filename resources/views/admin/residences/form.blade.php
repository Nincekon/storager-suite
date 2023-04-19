@extends('admin.admin')

@section('title', $residence->exists ? "Modifier une résidence" : "Ajouter une résidence" )

@section('stylesheets')

@endsection

@section('javascripts')

@endsection

@section('container')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-2 text-gray-800">
        {{ $residence->exists ? "Modifier la résidence" : "Ajouter une nouvelle résidence" }}
    </h1>

    <a href="{{ route('admin.residences.index') }}" class="btn btn-secondary">
        Retour à la liste
    </a>
</div>

<!-- Form card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Description de la résidence
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

        <form method="POST" action="{{ route($residence->exists ? 'admin.residences.update' : 'admin.residences.store', $residence ) }}" class="user needs-validation" novalidate>

            @csrf
            @method($residence->exists ? 'PUT' : 'POST')

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group has-validation">
                        <select name="user_id" class="form-control" id="user_id" aria-describedby="user_id">
                            <option selected value=""> Choisir un acteur </option>
                            @forelse ($actors as $actor)
                            <option @selected(old('user_id', $residence->user_id) == $actor->id ) value="{{ $actor->id }}"> {{ $actor->name }} </option>
                            @empty
                            <option> Aucun acteur disponible </option>
                            @endforelse

                        </select>
                        <div class="invalid-tooltip">
                            Veuillez choisir un acteur valide !
                        </div>
                        @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <select name="category_id" class="form-control" id="category_id" aria-describedby="category_id" required>
                            <option selected value=""> Choisir une catégorie </option>
                            @forelse ($categories as $category)
                            <option @selected(old('category_id', $residence->category_id) == $category->id ) value="{{ $category->id }}"> {{ $category->name }} </option>
                            @empty
                            <option> Aucune catégorie disponible </option>
                            @endforelse

                        </select>
                        <div class="invalid-tooltip">
                            Veuillez choisir une catégorie valide !
                        </div>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <select name="character_id" class="form-control" id="character_id" aria-describedby="character_id" required>
                            <option selected value=""> Choisir une caractéristique </option>
                            @forelse ($characters as $character)
                            <option @selected(old('character_id', $residence->character_id) == $character->id ) value="{{ $character->id }}"> {{ $character->title }} </option>
                            @empty
                            <option> Aucune caractéristique disponible </option>
                            @endforelse

                        </select>
                        <div class="invalid-tooltip">
                            Veuillez choisir une caractéristique valide !
                        </div>
                        @error('character_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <select name="quarter_id" class="form-control" id="quarter_id" aria-describedby="quarter_id" required>
                            <option selected value=""> Choisir un quartier </option>
                            @forelse ($quarters as $quarter)
                            <option @selected(old('quarter_id', $residence->quarter_id) == $quarter->id ) value="{{ $quarter->id }}"> {{ $quarter->title }} </option>
                            @empty
                            <option> Aucun quartier disponible </option>
                            @endforelse

                        </select>
                        <div class="invalid-tooltip">
                            Veuillez choisir un quartier valide !
                        </div>
                        @error('quarter_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6">

                    <div class="form-group has-validation">
                        <input type="text" class="form-control" aria-describedby="title" required
                            id="title" name="title" min="5" placeholder="Entrez le nom ..." value="{{ old('title') ?? $residence->title }}">
                        <div class="invalid-tooltip">
                            Un nom valide doit faire au minimum 5 caractères
                        </div>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group has-validation">
                                <input type="number" class="form-control" aria-describedby="nb_small_journey" required
                                    id="nb_small_journey" name="nb_small_journey" min="5" placeholder="Jours pour un petit séjour" value="{{ old('nb_small_journey') ?? $residence->nb_small_journey }}">
                                <div class="invalid-tooltip">
                                    Entrez un entier !
                                </div>
                                @error('nb_small_journey')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group has-validation">
                                <input type="number" class="form-control" aria-describedby="nb_long_journey" required
                                    id="nb_long_journey" name="nb_long_journey" min="5" placeholder="Jours pour un long séjour" value="{{ old('nb_long_journey') ?? $residence->nb_long_journey }}">
                                <div class="invalid-tooltip">
                                    Entrez un entier !
                                </div>
                                @error('nb_long_journey')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group has-validation">
                                <input type="number" class="form-control" aria-describedby="price_small_journey" required
                                    id="price_small_journey" name="price_small_journey" placeholder="Prix pour un petit séjour" value="{{ old('price_small_journey') ?? $residence->price_small_journey }}">
                                <div class="invalid-tooltip">
                                    Entrez un entier !
                                </div>
                                @error('price_small_journey')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group has-validation">
                                <input type="number" class="form-control" aria-describedby="price_long_journey" required
                                    id="price_long_journey" name="price_long_journey" placeholder="Prix pour un long séjour" value="{{ old('price_long_journey') ?? $residence->price_long_journey }}">
                                <div class="invalid-tooltip">
                                    Entrez un entier !
                                </div>
                                @error('price_long_journey')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group has-validation">
                                <input type="number" class="form-control" aria-describedby="nb_persons" required
                                    id="nb_persons" name="nb_persons" placeholder="Personnes pour le séjour" value="{{ old('nb_persons') ?? $residence->nb_persons }}">
                                <div class="invalid-tooltip">
                                    Entrez un entier !
                                </div>
                                @error('nb_persons')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group has-validation">
                                <input type="number" class="form-control" aria-describedby="price_caution" required
                                    id="price_caution" name="price_caution" placeholder="Prix de la caution" value="{{ old('price_caution') ?? $residence->price_caution }}">
                                <div class="invalid-tooltip">
                                    Entrez un entier !
                                </div>
                                @error('price_caution')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="custom-control custom-switch">
                        <input type="hidden" name="sold" value="0">
                        <input @checked(old('sold', $residence->sold ?? false)) type="checkbox" name="sold" value="1" class="custom-control-input @error('sold') is-invalid @enderror" id="sold">
                        <label class="custom-control-label" for="sold"> Cette résidence est occupée</label>
                        @error('sold')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>

            </div>

            <button type="submit" class="btn {{ $residence->exists ? 'btn-warning' : 'btn-primary' }} btn-user btn-block">
                {{ $residence->exists ? 'Modifier' : 'Enregistrer et valider' }}
            </button>
        </form>


    </div>
</div>

@endsection
