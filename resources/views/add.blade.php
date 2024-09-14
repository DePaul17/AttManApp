<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pointerapp.addUser</title>
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

        @if(session('success'))
            <script>alert("{{ session('success') }}");</script>
        @endif

        @if(session('error'))
            <script>alert("{{ session('error') }}");</script>
        @endif

        <div class="card mx-auto" style="width: 64rem;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouvel utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.store') }}" onsubmit="return validateForm()">
                    @csrf
                    <div class="row">
                        <!-- Colonne de gauche -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" min="1964-01-01" max="2006-12-31">
                            </div>
                            <div class="mb-3">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select class="form-select" id="sexe" name="sexe">
                                    <option value="">-- Votre sexe --</option>
                                    <option value="Masculin">Masculin</option>
                                    <option value="Féminin">Féminin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cni" class="form-label">Carte nationale d'identité</label>
                                <input type="text" class="form-control" id="cni" name="cni">
                            </div>
                            
                            <label for="phone">Téléphone</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">+33</span>
                                <input type="text" class="form-control" id="phone" name="phone" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3">
                                <label for="heure_debut" class="form-label">Heure début</label>
                                <input type="text" class="form-control" id="heure_debut" name="heure_debut">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="heure_fin" class="form-label">Heure fin</label>
                                <input type="text" class="form-control" id="heure_fin" name="heure_fin">
                            </div>
                            <div class="mb-3">
                                <label for="cjm" class="form-label">Coût journalier moyen</label>
                                <input type="text" class="form-control" id="cjm" name="cjm">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmation du mot de passe</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="">-- Donner un rôle à l'utilisateur --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Salarié</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <button type="button" id="clear" class="btn btn-secondary w-100" style="background-color: #878B91;">Nettoyer</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #2D77CB;">Ajouter un utilisateur</button>
                    </div>
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