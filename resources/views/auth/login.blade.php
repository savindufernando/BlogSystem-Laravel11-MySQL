<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

        <!-- Error message if email is unverified -->
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4" id="error-message" style="display:none;" aria-live="assertive">
            Please verify your email first.
        </div>

        <form action="/login" method="POST" id="login-form">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded" required autocomplete="email">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded" required autocomplete="current-password">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Login</button>
        </form>

        <p class="mt-4 text-center text-gray-600">Don't have an account? <a href="/register" class="text-blue-500">Register</a></p>
    </div>

    <script>
        // Show error if the email is not verified
        window.onload = function() {
            if (window.location.search.includes("unverified=true")) {
                document.getElementById('error-message').style.display = 'block';
            }
        }
    </script>

</body>
</html>
