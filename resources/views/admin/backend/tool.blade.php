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
                {{-- CREATE --}}
                <div class=" container w-75">
                    <h3 class=" text-center bg-warning  mt-3 mb-2 w-100">LIST TOOLS</h3>
                </div>


                <!-- Button trigger modal -->
                <div class=" container w-75 mb-4">
                    <button type="button" class="btn btn-dark  w-100 text-center" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        + NEW TOOLS
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- form --}}
                                <form action={{ route('tools.store') }} method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 ">
                                        <label for="name">name</label>
                                        <input class="form-control  " type="text" name="name" id="name"
                                            required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">image</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            required>
                                    </div>
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">Etat</label>
                                        <input type="text" name="etat" id="etat" class="form-control"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control"
                                            required>
                                    </div>
                                    <div class="modal-footer mt-5">
                                        <button class="btn btn-success mt-1" type="submit">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABLE ------------------------------------------------------------- --}}
                <table class="table w-75 container">
                    <thead>
                        <tr>
                            <th scope="col">IMAGE</th>
                            <th scope="col">NAME</th>
                            <th scope="col">STATE</th>
                            <th scope="col">STOCK</th>
                            <th scope="col">UPDATE</th>
                            <th scope="col">DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tools as $tool)
                            <tr valign="middle">
                                <td><img src={{ asset('/storage/images/tools/'.$tool->image) }} alt=""
                                        width="50" height="50"></td>
                                <td class="w-25">{{ $tool->name }}</td>
                                <td>
                                    <a href="tool/{{ $tool->id }}"
                                        class="btn btn btn-{{ $tool->etat ? 'success' : 'danger' }} w-50">
                                        {{ $tool->etat ? 'Good' : 'Bad' }}
                                    </a>
                                </td>
                                <td class="fs-5">{{ $tool->stock }}</td>
                                <td>
                                    <!-- Button trigger modal UPDATE -->
                                    <button type="button" class="btn  btn-info                    w-50 text-white "
                                        data-bs-toggle="modal" data-bs-target="#edittool{{ $tool->id }}">
                                        edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edittool{{ $tool->id }}" tabindex="-1"
                                        aria-labelledby="edittool{{ $tool->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="edittool{{ $tool->id }}Label">
                                                        update</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action={{ route('tools.update', $tool->id) }} method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3 ">
                                                            <label for="name" class="form-label">name</label>
                                                            <input class="form-control" type="text" name="name"
                                                                id="name" value={{ old('name', $tool->name) }}
                                                                required>
                                                        </div>

                                                        <div class="mb-3 ">
                                                            <label for="etat" class="form-label">Etat</label>
                                                            <input class="form-control" type="text" name="etat"
                                                                id="etat" value={{ old('etat', $tool->etat) }}
                                                                required>
                                                        </div>

                                                        <div class="mb-3 ">
                                                            <label for="stock" class="form-label">stock</label>
                                                            <input class="form-control" type="number" name="stock"
                                                                id="stock" value={{ old('stock', $tool->stock) }}
                                                                required>
                                                        </div>

                                                        <div class="modal-footer mt-5 ">
                                                            <button type="submit"
                                                                class="btn btn-success">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <form action={{ route('tools.destroy', $tool->id) }} method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-50">Delete</button>
                                    </form>
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
