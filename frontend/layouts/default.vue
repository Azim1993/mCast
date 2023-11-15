<template>
<div class="bg-light min-h-screen">
    <nav class="bg-white p-4 drop-shadow">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex justify-start">
                <div class="text-2xl font-bold text-secondary">M-Cast</div>
                <div class="relative ml-10">
                <!-- Search Icon -->
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10a7 7 0 111-13 7 7 0 01-1 13zM2 7a10 10 0 113 7.7 10 10 0 01-3-7.7z"></path>
                </svg>

                <!-- Search Input -->
                <input type="text" placeholder="Search" class="w-80 h-10 pl-10 pr-4 rounded-lg border border-gray-300 focus:outline-none focus:border-secondary-light">

                <!-- Clear Search Button (Optional) -->
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            </div>
            
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-4 flex">

        <!-- Sidebar -->
        <div class="w-1/4 p-4">
            <!-- User Profile -->
            <div class="bg-white p-4 mb-4 rounded shadow">
                <!-- User Avatar -->
                <div class="w-12 h-12 bg-gray-300 rounded-full mb-2"></div>
                <!-- User Info -->
                <div class="font-bold text-lg">John Doe</div>
                <div class="text-gray-600">@johndoe</div>
            </div>

            <!-- Trending Topics or Other Sidebar Content -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-bold mb-4">Trending</h2>
                <!-- Trending Topics List -->
                <ul>
                    <li class="mb-2"><a href="#" class="text-blue-500">#TailwindCSS</a></li>
                    <li class="mb-2"><a href="#" class="text-blue-500">#WebDevelopment</a></li>
                    <!-- Add more trending topics -->
                </ul>
            </div>
        </div>

        <!-- Tweet Feed -->
        <div class="w-1/2 p-4 bg-white rounded shadow">
            <!-- Create a Tweet -->
            <div class="mb-4">
                <textarea class="w-full p-2 border border-gray-300 rounded" placeholder="What's happening?"></textarea>
                <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-2">Tweet</button>
            </div>

            <!-- Display Tweets -->
            <!-- Example Tweet -->
            <div class="border-b border-gray-300 pb-4 mb-4">
                <!-- User Avatar -->
                <div class="w-10 h-10 bg-gray-300 rounded-full mb-2"></div>
                <!-- Tweet Content -->
                <div>
                    <div class="font-bold">John Doe</div>
                    <div class="text-gray-600">@johndoe - 2h ago</div>
                    <div class="mt-2">This is an example tweet. #TailwindCSS #TwitterClone</div>
                </div>
            </div>

            <!-- More Tweets... -->

        </div>

        <!-- Additional Sidebar or Other Content -->
        <div class="w-1/4 p-4">
            <!-- Additional Content -->
        </div>

    </div>
</div>
</template>