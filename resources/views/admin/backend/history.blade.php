<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="p-4">
                <div class="container w-75 mb-3">
                    <!-- Tabs button -->
                    <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                       <div class="d-flex gap-3">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="active-resv-tab" data-bs-toggle="pill"
                                data-bs-target="#active-resv" type="button" role="tab" aria-controls="active-resv"
                                aria-selected="true">Active Reservation</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cancelled-resv-tab" data-bs-toggle="pill"
                                data-bs-target="#cancelled-resv" type="button" role="tab"
                                aria-controls="cancelled-resv" aria-selected="false">Cancelled reservation</button>
                        </li>
                       </div>
                        <li>
                            <form action={{route('history.store')}} method="POST">
                                @csrf
                                <button class="btn btn-success" type="submit">Send Today's History</button>
                            </form> 
                        </li>
                    </ul>
                    <!-- Tabs Content -->
                    <h3 class="text-center bg-warning  mt-3 mb-2 w-100">All RESRVATIONS HISTORY</h3>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="active-resv" role="tabpanel"
                            aria-labelledby="active-resv-tab" tabindex="0">
                            <table class="table">
                                <thead class="table-dark">
                                    <th>Reserved By</th>
                                    <th>Reserved Classe</th>
                                    <th>Reservation Start At</th>
                                    <th>Reservation End At</th>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        @if ($reservation->resv_etat == 1)
                                            <tr>
                                                <td>{{ $reservation->user->name }}</td>
                                                <td>{{ $reservation->classe->name }}</td>
                                                <td>{{ $reservation->start }}</td>
                                                <td>{{ $reservation->end }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="cancelled-resv" role="tabpanel"
                            aria-labelledby="cancelled-resv-tab" tabindex="0">
                            <table class="table">
                                <thead class="table-dark">
                                    <th>Reserved By</th>
                                    <th>Reserved Classe</th>
                                    <th>Reservation Start At</th>
                                    <th>Reservation End At</th>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        @if ($reservation->resv_etat == 0)
                                            <tr>
                                                <td>{{ $reservation->user->name }}</td>
                                                <td>{{ $reservation->classe->name }}</td>
                                                <td>{{ $reservation->start }}</td>
                                                <td>{{ $reservation->end }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="tab-pane fade" id="send-history" role="tabpanel"
                            aria-labelledby="send-history-tab" tabindex="0">
                            <p>hELLO WORLD</p>
                        </div> --}}
                    </div>
                </div>


                <!--  /////////////////////////////   -->
            </main>
        </div>
    </body>
</body>

</html>
