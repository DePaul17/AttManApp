<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- link css --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Style Auth -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                @if(auth()->check())
                    @if(auth()->user()->sexe === 'Masculin')
                        <p>Bonjour, Monsieur {{ auth()->user()->name }}</p>
                    @elseif(auth()->user()->sexe === 'Féminin')
                        <p>Bonjour, Madame {{ auth()->user()->name }}</p>
                    @endif
                @endif
            </h2>
        </x-slot>

        <!-- Happy birthday -->
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if ($birthdayMessage)
                    <div id="happy_birthday" class="alert alert-warning auto-dismiss" role="alert">
                        🎉 {{ $birthdayMessage }} 🎉
                    </div>
                @endif
            </div>
        </div>

        <!-- Success -->
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(Session::has('success'))
                    <div id="message" class="alert alert-success auto-dismiss" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Error -->
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(Session::has('error'))
                    <div id="message" class="alert alert-danger auto-dismiss" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Si le role est 1 l'utilisateur est admin et si le role, salarié-->
        @if(auth()->user()->role == 1)
            <div class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="d-flex justify-content-end">
                        <a href="/addnewuser" class="btn btn-primary" style="background-color: #2D77CB;">Ajouter un utilisateur</a>
                    </div>
                    <br>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="alert alert-secondary" role="alert">
                                Liste des Admins
                            </div>
                            <!-- Tableau admin -->
                            <!-- Tableau pour les utilisateurs avec le rôle 1 -->
                            <div class="users-table-admin">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Prénom</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Téléphone</th>
                                            <th scope="col">CNI</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usersRole1 as $user)
                                        <tr>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->cni }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-info">
                                                    <i class="fas fa-eye text-white"></i>
                                                </a>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-edit text-white"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" style="background-color: #C64B30;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Affichage des liens de pagination pour les utilisateurs avec le rôle 1 -->
                                {{ $usersRole1->links() }}
                            </div>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100"> 
                            <div class="alert alert-secondary" role="alert">
                                Liste des Salariés
                            </div>   
                            <!-- Tableau pour les utilisateurs avec le rôle 2 -->
                            <div class="users-table-salariés">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Prénom</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Téléphone</th>
                                            <th scope="col">CNI</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usersRole2 as $user)
                                        <tr>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->cni }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-info">
                                                    <i class="fas fa-eye text-white"></i>
                                                </a>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-edit text-white"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" style="background-color: #C64B30;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('users.present', ['id' => $user->id]) }}" class="btn btn-success" style="display: inline;">Arr.- Dep.</a>
                                                @if ($user->etat_comptes == 1)
                                                    <!-- Stop si etat_comptes est égal à 1 -->
                                                    <form action="{{ route('stop.account', $user->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-danger" style="background-color: #C64B30;">
                                                            <i class="fas fa-stop"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Play si etat_comptes n'est pas égal à 1 -->
                                                    <form action="{{ route('play.account', $user->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-primary" style="background-color: #538DCF ;">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Affichage des liens de pagination pour les utilisateurs avec le rôle 2 -->
                                {{ $usersRole2->links() }}
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->role == 2)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <table class="table">
                                <thead>
                                    <th> {{ now()->formatLocalized('%A %d/%m/%Y') }} </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if(auth()->check())
                                                @if(auth()->user()->sexe === 'Masculin')
                                                    <p>Bonjour et Bienvenue, M. {{ auth()->user()->name }}</p>
                                                @elseif(auth()->user()->sexe === 'Féminin')
                                                    <p>Bonjour et Bienvenue, Mme {{ auth()->user()->name }}</p>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('arrival') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                <input type="hidden" name="date" value="{{ now()->toDateString() }}">
                                                <button type="submit" id="arrival-button" class="btn btn-success" style="background-color: #4BB26F;">Arrivée</button>
                                            </form>

                                            <form action="{{ route('depart') }}" method="POST"  style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                <input type="hidden" name="date" value="{{ now()->toDateString() }}">
                                                <button type="submit" id="arrival-button" class="btn btn-danger" style="background-color: #C64B30;">Départ</button>
                                            </form>
                                        </td>
                                    </tr>     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>
</body>
<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <p>Copyright © 2024 PresnaTech. - wingroup, Ltd. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>
</html>
<script src="../assets/js/alert.js"></script>
<script src="../assets/js/clear.js"></script>
<script src="../assets/js/validationForm.js"></script>
<script src="{{ asset('js/arrival.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#arrival-button').click(function(e){
            e.preventDefault();
            $(this).prop('disabled', true);
            // Envoyer le formulaire après le traitement ci-dessus
            $(this).closest('form').submit();
        });
    });
</script>