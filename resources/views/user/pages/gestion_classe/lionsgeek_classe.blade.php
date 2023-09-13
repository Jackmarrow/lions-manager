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
            <main class="py-4">
                <!-- Salle Tabs -->
                <ul class="nav nav-pills mb-3 justify-content-center gap-3" id="pills-tab" role="tablist">
                    @foreach ($classes as $class)
                        <li class="nav-item" role="presentation">
                            @if ($class->id == 1)
                                <button class="nav-link active" id="class{{ $class->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#class{{ $class->id }}" type="button" role="tab"
                                    aria-controls="class{{ $class->id }}"
                                    aria-selected="true">{{ $class->name }}</button>
                            @else
                                <button class="nav-link" id="class{{ $class->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#class{{ $class->id }}" type="button" role="tab"
                                    aria-controls="class{{ $class->id }}"
                                    aria-selected="true">{{ $class->name }}</button>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach ($classes as $class)
                        <div class="tab-pane fade @if ($loop->first) show active @endif" id="class{{ $class->id }}"
                            role="tabpanel" aria-labelledby="class{{ $class->id }}-tab" tabindex="0">
                            <div id="carouselExample{{ $class->id }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @foreach ($class->photos as $key => $photo)
                                        <div class="carousel-item @if ($key === 0) active @endif">
                                            <img src="{{ asset('/storage/images/classePhotos/' . $photo->name) }}"
                                                class="d-block w-100" alt="...">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExample{{ $class->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExample{{ $class->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </main>
        </div>
    </body>
</body>

</html>
