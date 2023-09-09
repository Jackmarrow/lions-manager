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
            <main>
               <h1>You are in the user page</h1>
               @foreach ($users as $user)
                 @foreach ($user->roles as $role)
                   <p>{{$role}}</p>  
                 @endforeach  
               @endforeach
               @role('user')
                <p>Yes i'm normal user</p>
               @endrole
            </main>
        </div>
    </body>
</body>
</html>