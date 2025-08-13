<header class="p-4 flex items-center justify-between" id="hs-header">
  <!-- Left: Search Bar -->
  <div class="flex items-center w-full ml-2 max-w-md">
    <input 
      type="text" 
      placeholder="Search" 
      class="w-full px-4 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400"
    >
  </div>

  <!-- Right: Icons -->
  <div class="flex items-center space-x-4">
    <!-- Notification Icon -->
    <button class="relative p-2 rounded-lg shadow hover:bg-gray-100 focus:outline-none  ml-3" id="notification-button">
        <span class="absolute top-1 right-1 block w-2 h-2 rounded-full bg-red-500"></span>
      <svg xmlns="http://www.w3.org/2000/svg" 
           class="h-6 w-6 text-gray-600" fill="none" 
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" 
              stroke-width="2" 
              d="M15 17h5l-1.405-1.405M19 13V8a7 7 0 10-14 0v5l-1.405 1.405M15 17a3 3 0 01-6 0" />
      </svg>
      <!-- Red dot for new notifications -->
      
    </button>
{{-- Profile Name --}}
<div class="flex items-center space-x-2">
      <p class="mr-3 ml-3">Bhavishya</p>
    </div>
    <!-- Profile Image -->
    <div class="flex items-center space-x-2">
      <img src="https://via.placeholder.com/40" 
           alt="Profile" 
           class="w-10 h-10 rounded-lg border border-gray-300 mr-2">
    </div>
  </div>
</header>
