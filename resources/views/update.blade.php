<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pointerapp.updateUser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <br>
        <div class="card mx-auto" style="width: 64rem;">
            <div class="card-body">
                <div class="alert alert-secondary" role="alert">
                    Modification...
                </div>
                <form method="POST" action="{{ route('user.update', $user->id) }}" onsubmit="return validateForm()">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ $user->date_naissance }}" min="1964-01-01" max="2006-12-31">
                            </div>
                            <div class="mb-3">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select class="form-select" id="sexe" name="sexe">
                                    <option value="">-- Votre sexe --</option>
                                    <option value="Masculin" {{ $user->sexe === 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="Feminin" {{ $user->sexe === 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cni" class="form-label">Carte nationale d'identité</label>
                                <input type="text" class="form-control" id="cni" name="cni" value="{{ $user->cni }}">
                            </div>
                            <div class="mb-3">
                                <label for="heure_debut" class="form-label">Heure début</label>
                                <input type="text" class="form-control" id="heure_debut" name="heure_debut" value="{{ $user->heure_debut }}">
                            </div>
                            <div class="mb-3">
                                <label for="heure_fin" class="form-label">Heure fin</label>
                                <input type="text" class="form-control" id="heure_fin" name="heure_fin" value="{{ $user->heure_fin }}">
                            </div>
                            <div class="mb-3">
                                <label for="cjm" class="form-label">Coût journalier moyen</label>
                                <input type="text" class="form-control" id="cjm" name="cjm" value="{{ $user->cjm }}">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Salarié</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" style="background-color: #2D77CB;">Appliquer</button>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
</body>
</html>

<script src="../assets/js/alert.js"></script>
<script src="../assets/js/clear.js"></script>
<script src="../assets/js/controlForm.js"></script>