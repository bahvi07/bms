<header class="p-4 flex items-center justify-between" id="hs-header">
  <!-- Mobile Menu Button -->
<button 
    id="mobile-menu-button"
    class="md:hidden p-2 text-gray-600 hover:bg-gray-200 rounded-lg focus:outline-none">
    <!-- Hamburger Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

  <!-- Left: Search Bar -->
  <div class="flex items-center w-full ml-4 max-w-md">
    <input 
      type="text" 
      placeholder="Search" 
      class="w-full md:w-lg px-4 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400"
    >
  </div>

  <!-- Right: Icons -->
  <div class="flex items-center space-x-4">
    <!-- Notification Icon -->
    <button class="relative p-2 rounded-lg shadow hover:bg-gray-100 focus:outline-none  ml-6 mr-3" id="notification-button">
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

    <!-- Profile Image -->
    <div class="flex items-center space-x-2">
      <img src="https://via.placeholder.com/40" 
           alt="Profile" 
           class="w-10 h-10 rounded-lg border border-gray-300 mr-5">
    </div>
  </div>
</header>
