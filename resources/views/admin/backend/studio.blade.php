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
                {{-- <h1 class="text-black">Studios</h1> --}}
                {{-- CREATE --}}
                <div class=" container w-75">
                    <h3 class=" text-center bg-warning  mt-3 mb-2 w-100">All STUDIOS</h3>

                </div>

                {{-- CREATE ----------------------------------------------------------------------------------------------------------------- --}}
                <!-- Button trigger modal -->
                <div class=" container w-75 text-center">
                    <button type="button" class="btn btn-dark w-100 text-center" data-bs-toggle="modal"
                        data-bs-target="#createstudio">
                        + STUDIO
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="createstudio" tabindex="-1" aria-labelledby="createstudio"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title fs-5" id="createstudio">Create</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- form --}}
                                <form action={{ route('studios.store') }} method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 ">
                                        <label for="name">name</label>
                                        <input class="form-control " type="text" name="name" id="name"
                                            required>
                                    </div>
                                    <div class="modal-footer mt-5">
                                        <button class="btn btn-success mt-1" type="submit">Create</button>
                                    </div>
                                </form>
                                {{-- form end --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- table ---------------------------------------------------------------------------------------------------- --}}
                <table class="table w-75 container mt-3">
                    <thead class="tb_photo">
                        <tr>
                            <th scope="col">IMAGE</th>
                            <th scope="col">NAME</th>
                            <th scope="col">ADD</th>
                            <th scope="col">UPDATE</th>
                            <th scope="col">DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studios as $studio)
                            <tr valign="middle">
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info text-light" data-bs-toggle="modal"
                                        data-bs-target="#carouselshow{{$studio->id}}">
                                        Show Photos
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="carouselshow{{$studio->id}}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="carouselshow{{$studio->id}}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="carouselshowLabel">Studios</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- -------------------------------------------------- TABLE PHOTOOOO --------------------------- --}}
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>PHOTO</th>
                                                                <th>UPDATE</th>
                                                                <th>DELETE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($studio->studio_photos as $studiophoto)
                                                                <tr valign="middle">
                                                                    <td>
                                                                        <div class="">
                                                                            <img height="150"
                                                                                src="{{ asset('storage/images/studioPhoto/' . $studiophoto->photo) }}"
                                                                                class="d-block w-50 container"
                                                                                alt="">
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <form
                                                                            action={{ route('studiophoto.destroy', $studiophoto->id) }}
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-danger w-100"
                                                                                type="submit">Delete</button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action={{ route('studiophoto.update', $studiophoto->id) }}
                                                                            method="POST"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="d-flex">
                                                                                <input class="form-control"
                                                                                    type="file" name="photo"
                                                                                    id="photo"
                                                                                    value={{ old('photo', $studiophoto->photo) }}
                                                                                    required>
                                                                                <button type="submit"
                                                                                    class="btn btn-warning w-25">Update</button>
                                                                            </div>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                </td>
                                <td>{{ $studio->name }}</td>
                                {{-- ------------------------ add photo ------------------------------------------------------------------------------------------------------------------- --}}
                                <td>

                                    <form action={{ route('studiophoto.store', $studio->id) }} method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success w-50" data-bs-toggle="modal"
                                            data-bs-target="#addphoto{{ $studio->id }}">
                                            + Photo
                                        </button>

                                        <!------------------------------------------------------- Modal -------------------------------------------------------------------------->
                                        <div class="modal fade" id="addphoto{{ $studio->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="addphoto{{ $studio->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="addphoto{{ $studio->id }}Label">add photo
                                                        </h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3 ">
                                                            <label for="photo" class="form-label">Photo</label>
                                                            <input type="file" name="photo[]" id="photo"
                                                                class="form-control" multiple required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="btn btn-primary">Add Photos</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    {{-- ------------------------------------------------------ edit ------------------------------------------------------------ --}}
                                </td>
                                <td>

                                    <!-- Button trigger modal UPDATE -->
                                    <button type="button" class="btn btn-warning w-50 text-light"
                                        data-bs-toggle="modal" data-bs-target="#editstudio{{ $studio->id }}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editstudio{{ $studio->id }}" tabindex="-1"
                                        aria-labelledby="editstudio{{ $studio->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="editstudio{{ $studio->id }}Label">Update
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action={{ route('studios.update', $studio->id) }}
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3 ">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input class="form-control" type="text" name="name"
                                                                id="name" value={{ old('name', $studio->name) }}
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

                                {{-- <td> --}}
                                {{-- --------------------------------------- DELETE Photo ---------------------------------------------------- --}}

                                <!-- Button trigger modal -->
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#dltphoto{{ $studio->id }}">
                            Delete Photo
                        </button> --}}

                                <!-- Modal -->
                                {{-- <div class="modal fade" id="dltphoto{{ $studio->id }}" tabindex="-1"
                            aria-labelledby="dltphoto{{ $studio->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="dltphoto{{ $studio->id }}Label">Delete Photo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body"> --}}
                                {{-- ----------------------------------------------- CAROUSEL DELETE PHOTO-------------------------------------------------- --}}

                                {{-- <div id="carousel{{$studio->id}}delete" class="carousel slide">
                                            <div class="carousel-inner"> 
                                        @foreach ($studio->studio_photos as $studiophoto)
                                                
                                                <div class="carousel-item active">
                                                    <img height="200" src="{{ asset("storage/images/studioPhoto/".$studiophoto->photo) }}" class="d-block w-100" alt="">
                                                    <div class="carousel-caption d-none d-md-block">
                                                            <form action={{route("studiophoto.destroy",$studiophoto->id)}} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method("DELETE")
                                                                <button class="btn btn-danger" type="submit">Delete</button>
                                                            </form>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev " type="button" data-bs-target="#carousel{{$studio->id}}delete" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$studio->id}}delete" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td> --}}
                                <td>
                                    <form action={{ route('studios.destroy', $studio->id) }} method="POST">
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
