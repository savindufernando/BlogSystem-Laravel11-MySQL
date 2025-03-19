@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800">Welcome, {{ Auth::user()->name }} 👋</h1>

        </div>

        <div class="text-lg text-gray-700 mb-6">
            <p>Manage posts easily from your dashboard.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-8">
            <!-- <div class="bg-blue-500 text-white p-8 rounded-xl shadow-md text-center hover:shadow-lg transform hover:scale-105 transition-all">
                <h2 class="font-bold text-2xl mb-2">My Profile</h2>
                <p>Update your personal details.</p>
                <a href="/profile" class="mt-4 inline-block bg-white text-blue-500 py-2 px-4 rounded-lg font-semibold">Go to Profile</a>
            </div> -->

            <div class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white p-8 rounded-xl shadow-md text-center hover:shadow-lg transform hover:scale-105 transition-all animate-background">
                    <h2 class="font-bold text-2xl mb-2">My Posts</h2>
                    <p>View and manage your blog posts.</p>
                    <a href="/posts" class="mt-4 inline-block bg-white text-green-500 py-2 px-4 rounded-lg font-semibold">View Posts</a>
                </div>


            <!-- <div class="bg-yellow-500 text-white p-8 rounded-xl shadow-md text-center hover:shadow-lg transform hover:scale-105 transition-all">
                <h2 class="font-bold text-2xl mb-2">Settings</h2>
                <p>Customize your account settings.</p>
                <a href="/settings" class="mt-4 inline-block bg-white text-yellow-500 py-2 px-4 rounded-lg font-semibold">Account Settings</a>
            </div> -->
        </div>
    </div>
@endsection