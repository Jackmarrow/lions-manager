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
            <main class="p-5">
                <!-- Button trigger register Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register a new user
                </button>

                <!-- Register body content -->
                <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="registerModalLabel">Register a user</h1>
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
                <!-- End of registeration -->

                <!-- Table of Users -->
                <table class="table mt-5">
                    <thead>
                        <tr class="table-dark">
                            <td>Name</td>
                            <td>Email</td>
                            <td>User Type</td>
                            <td>Role</td>
                            <td>Delete</td>
                            <td>Update</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr valign='middle'>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        {{$role->name}}
                                    @endforeach
                                </td>
                                <td>
                                    <form action={{ route('user.destroy', $user->id) }} method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"> Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updateUserModal{{$user->id}}">
                                        Update
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="updateUserModal{{$user->id}}" tabindex="-1"
                                        aria-labelledby="updateUserModal{{$user->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update User Info</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action={{route('user.update',$user->id)}} method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" name="name" id="name" class="form-control" value={{$user->name}}>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="text" name="email" id="email" class="form-control" value={{$user->email}}>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="type" class="form-label">User Type</label>
                                                            <select name="type" id="type" class="form-control" selected={{$user->type}}>
                                                                <option value="user interne">user interne</option>
                                                                <option value="user externe">user externe</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update User</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </main>
        </div>
    </body>
</body>

</html>
