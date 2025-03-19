<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Error Messages (if any) -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" id="register-form">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border rounded" required value="{{ old('name') }}">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded" required value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Register</button>
        </form>

        <p class="mt-4 text-center text-gray-600">Already have an account? <a href="/login" class="text-blue-500">Login</a></p>

        <!-- Verification Reminder -->
        <div class="mt-4 text-center text-gray-600" id="verification-message" style="display:none;">
            <p class="text-red-500">Please verify your email before logging in.</p>
        </div>
    </div>

    <script>
        // Show verification reminder after successful registration
        window.onload = function() {
            @if(session('success'))
                document.getElementById('verification-message').style.display = 'block';
            @endif
        }
    </script>

</body>
</html>
