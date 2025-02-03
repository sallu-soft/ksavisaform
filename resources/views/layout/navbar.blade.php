<div class="bg-[#0b7f96]">
  <nav class="w-[90%] mx-auto py-2 flex items-center justify-between">
    <div class="flex items-center">
      <a href="{{ route('user/index') }}" class="text-lg font-semibold bg-white rounded-lg p-2 hover:text-blue-200 mr-4">
        <img src="{{ asset('./assets/images/logo.png') }}" width="100px" id="up" height="100" class="w-[200px] h-auto object-contain" />
      </a>
      <a href="{{ route('user/embassy_list') }}" class="text-lg font-semibold text-white hover:text-blue-200 mr-4 flex items-center">
        <i class="fas fa-list-alt text-xl mr-2"></i>
        <span class="hidden md:block">Create Embassy List</span>
      </a>
      {{-- <a href="{{ route('user/embassy_report') }}" class="text-lg font-semibold text-white hover:text-blue-200 flex items-center">
        <i class="fas fa-list-alt text-xl mr-2"></i>
        <span class="hidden md:block">Embassy Report</span>
      </a> --}}
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

  
