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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register a new user
                </button>

                <!-- Modal -->
                <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="registerModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action={{ route('add_user.store') }} method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label" required>Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label" required>Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">User type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="user interne">user interne</option>
                                            <option value="user externe">user externe</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role">
                                            Role
                                        </label> <br>
                                        @foreach ($roles as $role)
                                            @if ($role->name !== 'admin' && $role->name !== 'none' && $role->name !== 'user')
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic checkbox toggle button group">
                                                    <input class="btn-check" type="checkbox" name="role[]"
                                                        id="btncheck{{ $loop->iteration }}" value="{{ $role->id }}">
                                                    <label for="btncheck{{ $loop->iteration }}"
                                                        class="btn btn-outline-success">{{ $role->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add a user</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</body>

</html>
