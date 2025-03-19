<footer class="bg-gray-900 text-white py-6 mt-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
        
        <!-- About Section -->
        <div>
            <h3 class="text-lg font-semibold">About Us</h3>
            <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold flex items-center space-x-1">
                <span class="bg-white text-yellow-600 px-2 py-1 rounded font-bold">B`</span>
                <span>logzilla</span>
            </span>
        </div>
            <p class="text-gray-400 mt-2">is a platform to share and discover amazing content. Stay updated with our latest posts and insights.</p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-semibold">Quick Links</h3>
            <ul class="mt-2 space-y-2">
                <li><a href="{{ route('auth.dashboard') }}" class="hover:text-gray-400">Dashboard</a></li>
                <li><a href="{{ route('posts.index') }}" class="hover:text-gray-400">Posts</a></li>
                <li><a href="#" class="hover:text-gray-400">Contact</a></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div>
            <h3 class="text-lg font-semibold">Follow Us</h3>
            <div class="flex justify-center md:justify-start space-x-4 mt-2">
                <a href="#" class="hover:text-blue-400"><i class="fab fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-sky-400"><i class="fab fa-twitter text-xl"></i></a>
                <a href="#" class="hover:text-pink-400"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-red-400"><i class="fab fa-youtube text-xl"></i></a>
            </div>
        </div>

    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-700 mt-6 text-center pt-4">
        <p class="text-gray-400">&copy; 2025 Logzilla. All rights reserved.</p>
    </div>
</footer>

<!-- FontAwesome for Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
