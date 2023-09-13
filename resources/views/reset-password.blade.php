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
            <!-- Page Content -->
            <main class="p-5">
                <div class="w-25 rounded-3 shadow bg-white p-4 position-absolute top-50 start-50 translate-middle">
                    <h2 class="mb-3">Reset password</h2>
                    <form action={{ route('reset-password.update') }} method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                        </div>
                        @if (session('error'))
                            <div class="text-danger my-2">
                                {{ session('error') }}
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Updat Password</button>
                    </form>
                </div>
            </main>
    </body>
</body>

</html>



