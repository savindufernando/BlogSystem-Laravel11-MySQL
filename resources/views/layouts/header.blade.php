<header class="bg-yellow-600 text-white py-4 shadow-md">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold flex items-center space-x-1">
                <span class="bg-white text-yellow-600 px-2 py-1 rounded font-bold">B`</span>
                <span>logzilla</span>
            </span>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('auth.dashboard') }}" class="hover:text-green-300 transition">Home</a>
            <a href="{{ route('posts.index') }}" class="hover:text-green-300 transition">Posts</a>
        </nav>

        <!-- Profile Dropdown -->
        <div class="relative">
            <button id="profileDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                <span>{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown Menu -->
            <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-lg shadow-lg hidden">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block px-4 py-2 hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>
        
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownBtn = document.getElementById("profileDropdownBtn");
        const dropdownMenu = document.getElementById("profileDropdown");

        dropdownBtn.addEventListener("click", function() {
            dropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function(event) {
            if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });
    });
</script>
