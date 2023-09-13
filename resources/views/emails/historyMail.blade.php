<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <body class="font-sans antialiased">
        <!-- Page Content -->
        <main>
            <table class="table" style="with: 100vw;">
                <thead>
                    <tr style="background-color: black; color: white;">
                        <th style="padding: 5px 10px;">Reserved By</th>
                        <th style="padding: 5px 10px;">Reserved Class</th>
                        <th style="padding: 5px 10px;">Resevation Start At</th>
                        <th style="padding: 5px 10px;">Reservation End At</th>
                        <th style="padding: 5px 10px;">Reservation State</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historyMailData['body'] as $data)
                    @if($data->resv_etat == 1)
                    <tr style="background-color: lightgreen;">
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->classe->name}}</td>
                        <td>{{$data->start}}</td>
                        <td>{{$data->end}}</td>
                        <td>Active</td>
                    </tr>
                    @else
                    <tr style="background-color: red;">
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->classe->name}}</td>
                        <td>{{$data->start}}</td>
                        <td>{{$data->end}}</td>
                        <td>Cancelled</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </main>
    </body>
</body>
