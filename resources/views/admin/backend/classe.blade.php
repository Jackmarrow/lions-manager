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
                {{-- <h1 class="text-center">Classes</h1>

                <form action="{{ route('classe.store') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <div>
                            <label for="name" class="mb-2 fw-bold">Add class name</label>
                            <input type="text" name="name" id="name" class="form-control mb-2"
                                placeholder="Enter class name" required>
                            <button class="btn btn-primary btn-block" type="submit">Add new class</button>
                        </div>
                    </div>
                </form> --}}
                {{-- CREATE --}}
                <div class=" container w-75">
                    <h3 class=" text-center bg-warning  mt-3 mb-2 w-100">Classes</h3>
                </div>


                <!-- Button trigger modal -->
                <div class=" container w-75 text-center">

                    <button type="button" class="btn btn-dark w-100 text-center" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        + Classe
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
                                <form action={{route('classe.store')}} method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name">name</label>
                                        <input type="text" name="name" id="name" class="form-control"
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

                <table class="table w-75 container mt-3">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Images</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $classe)
                            <tr>
                                <td>{{ $classe->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#photoModal{{ $classe->id }}">View
                                        Photos</button>

                                    <!-- Photo Modal -->
                                    <div class="modal fade" id="photoModal{{ $classe->id }}" tabindex="-1"
                                        aria-labelledby="photoModalLabel{{ $classe->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="photoModalLabel{{ $classe->id }}">Photos
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>PHOTO</th>
                                                                <th>DELETE</th>
                                                                <th>UPDATE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($classe->photos as $photo)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ asset('/storage/images/classePhotos/' . $photo->name) }}"
                                                                            target="_blank">
                                                                            <img src="{{ asset('/storage/images/classePhotos/' . $photo->name) }}"
                                                                                alt="{{ $photo->name }}"
                                                                                class="img-fluid mb-2" width="200">
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('classe.destroy.photo', ['classe' => $classe->id, 'photo' => $photo->id]) }}"
                                                                            method="POST" class="mb-3">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-danger"
                                                                                onclick="return confirm('Are you sure?')">Delete</button>
                                                                        </form>

                                                                    </td>
                                                                    <td>
                                                                        <!-- Form for updating the image -->
                                                                        <form
                                                                            action="{{ route('classe.update.photo', ['classe' => $classe->id, 'photo' => $photo->id]) }}"
                                                                            method="POST"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="mb-3">
                                                                                <label for="update_image"
                                                                                    class="form-label">Update
                                                                                    Image</label>
                                                                                <div class="input-group">
                                                                                    <input type="file"
                                                                                        name="update_image"
                                                                                        id="update_image"
                                                                                        class="form-control"
                                                                                        accept="image/jpeg, image/png, image/gif, image/webp"
                                                                                        required>
                                                                                    <button class="btn btn-primary"
                                                                                        type="submit">Update
                                                                                        img</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $classe->id }}">Edit</button>
                                </td>
                                <td>
                                    <form action="{{ route('classe.destroy', ['id' => $classe->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#uploadModal{{ $classe->id }}">Upload
                                        Images</button>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $classe->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $classe->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editModalLabel{{ $classe->id }}">Edit
                                                Class</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- modifier the form action and method -->
                                            <form action="{{ route('classe.update', ['id' => $classe->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div>
                                                    <label for="edit_name">Edit class name</label>
                                                    <input type="text" name="edit_name" id="edit_name"
                                                        value="{{ $classe->name }}" required>
                                                </div>
                                                <button class="btn btn-info" type="submit">Update
                                                    Class</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Modal -->
                            <div class="modal fade" id="uploadModal{{ $classe->id }}" tabindex="-1"
                                aria-labelledby="uploadModalLabel{{ $classe->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="uploadModalLabel{{ $classe->id }}">
                                                Upload Images
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!--my form for uploading images -->
                                            <form action="{{ route('upload.images', ['id' => $classe->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="images" class="form-label">Select
                                                        Images (JPG, PNG,
                                                        GIF, WebP, max 2048KB)</label>
                                                    <input type="file" name="images[]" id="images"
                                                        class="form-control"
                                                        accept="image/jpeg, image/png, image/gif, image/webp" multiple
                                                        required>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Upload</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </body>
</body>

</html>
