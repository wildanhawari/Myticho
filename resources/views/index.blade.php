<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mythico Jewelry</title>
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
  <!-- Navbar -->
  <header class="w-full bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">
      <!-- Brand -->
      <h1 class="text-2xl font-bold text-gray-900">Mythico</h1>

      <!-- Menu Button (Mobile) -->
      <button id="menu-button" class="md:hidden text-gray-600 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Links (Desktop) -->
      <nav id="menu" class="hidden md:flex space-x-4 text-gray-600">
        <a href="#" class="hover:text-gray-900">Home</a>
        <a href="#" class="hover:text-gray-900">Collection</a>
        <a href="#" class="hover:text-gray-900">About Us</a>
        <a href="#" class="hover:text-gray-900">Contact</a>
      </nav>
    </div>

    <!-- Dropdown Menu (Mobile) -->
    <div id="dropdown-menu" class="hidden md:hidden bg-white shadow-md transition-all duration-700">
      <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900">Home</a>
      <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900">Collection</a>
      <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900">About Us</a>
      <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900">Contact</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="w-full bg-gray-100 py-20">
    <div class="container mx-auto text-center px-6">
      <h2 class="text-4xl font-bold text-gray-900 mb-4">Timeless Elegance</h2>
      <p class="text-lg text-gray-600 mb-6">
        Discover handcrafted jewelry that tells your story.
      </p>
      <a href="#" class="px-6 py-3 bg-gray-800 text-white rounded-md shadow hover:bg-gray-900">
        Shop Now
      </a>
    </div>
  </section>

  <!-- Featured Collection -->
  <section class="w-full py-16">
    <div class="container mx-auto">
      <h3 class="text-2xl font-semibold text-gray-900 text-center mb-6">Our Collection</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6">
        <!-- Item 1 -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
          <img src="https://via.placeholder.com/150" alt="Jewelry 1" class="w-40 h-40 mx-auto mb-4">
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Golden Ring</h4>
          <p class="text-gray-600">$120</p>
        </div>
        <!-- Item 2 -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
          <img src="https://via.placeholder.com/150" alt="Jewelry 2" class="w-40 h-40 mx-auto mb-4">
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Elegant Necklace</h4>
          <p class="text-gray-600">$250</p>
        </div>
        <!-- Item 3 -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
          <img src="https://via.placeholder.com/150" alt="Jewelry 3" class="w-40 h-40 mx-auto mb-4">
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Silver Bracelet</h4>
          <p class="text-gray-600">$90</p>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="w-full bg-gray-100 py-16">
    <div class="container mx-auto text-center px-6">
      <h3 class="text-2xl font-semibold text-gray-900 mb-4">About Mythico</h3>
      <p class="text-gray-600 max-w-2xl mx-auto">
        At Mythico, we believe that every piece of jewelry should carry meaning and timeless beauty. 
        Our designs are inspired by the harmony of nature and crafted with precision.
      </p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="w-full bg-gray-800 text-gray-400 py-6">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Mythico. All rights reserved.</p>
    </div>
  </footer>

  <script>
    // Responsive Navbar Toggle
    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    menuButton.addEventListener('click', () => {
      dropdownMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
