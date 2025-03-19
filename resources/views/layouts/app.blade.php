<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - MyApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @include('layouts.header')  <!-- Include header -->

    <div class="container mx-auto p-6">
        @yield('content')  <!-- Content section from child views -->
    </div>

    @include('layouts.footer')  <!-- Include footer -->

</body>
</html>
