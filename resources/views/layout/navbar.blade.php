<div class="bg-[#0b7f96]">
  <nav class="container mx-auto px-4 py-2 flex items-center justify-between">
    <div class="flex items-center">
      <a href="{{ route('user/index') }}" class="text-lg font-semibold text-white hover:text-blue-200 mr-4">
        KSA Embassy File Solution
      </a>
      <a href="{{ route('user/embassy_list') }}" class="text-lg font-semibold text-white hover:text-blue-200 flex items-center">
        <i class="fas fa-list-alt text-xl mr-2"></i>
        <span class="hidden md:block">Create Embassy List</span>
      </a>
    </div>
    <div class="flex items-center">
      <div class="font-bold text-white text-2xl mr-4">{{ $user->licence_name }} - {{ $user->rl_no }}</div>
      <button class="text-white text-xl p-2 rounded-full hover:bg-gray-800 focus:outline-none focus:bg-gray-800 mr-4" data-bs-target="#user" data-toggle="tooltip" data-placement="bottom" title="Edit Profile" data-bs-toggle="modal">
        <i class="far fa-user"></i>
      </button>
      <button class="text-white text-xl p-2 rounded-full hover:bg-gray-800 focus:outline-none focus:bg-gray-800 mr-4">
        <i class="bi bi-bell"></i>
      </button>
      <button class="text-white text-xl p-2 rounded-full hover:bg-gray-800 focus:outline-none focus:bg-gray-800">
        <a href="{{ route('user/logout') }}">
          <i class="bi bi-box-arrow-left"></i>
        </a>
      </button>
    </div>
  </nav>
</div>

  
