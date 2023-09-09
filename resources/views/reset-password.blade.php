<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Reset password</h1>
    <form action={{ route('reset-password.update') }} method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control">
        </div>
        <div>
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <button type="submit">Updat Password</button>
    </form>
</body>

</html>
