<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pointerapp.seeUser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ \Carbon\Carbon::now()->format('l, d/m/Y') }}
                </h2>
            </x-slot>
            <br>
            <div class="card mx-auto" style="width: 42rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                            @if($arrivals->first() && $arrivals->first()->user)
                                {{ $arrivals->first()->user->first_name }} {{ $arrivals->first()->user->name }}
                            @else
                                Aucun pointage...
                            @endif
                            </th>
                            <th scope="col">H. Arrivée</th>
                            <th scope="col">H. Départ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arrivals as $key => $arrival)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($arrival->heure_arrivee)->translatedFormat('l, d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($arrival->heure_arrivee)->format('H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($departs[$key]->heure_depart)->format('H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $arrivals->links() }}
            </div>       
    </x-app-layout>
</body>
</html>