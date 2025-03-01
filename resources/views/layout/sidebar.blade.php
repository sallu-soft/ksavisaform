<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 md:w-[240px] w-[200px] xl:w-[280px] h-full bg-gray-50 text-gray-700 p-4 transition-transform transform  xl:translate-x-0 z-50 shadow-lg overflow-y-auto">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-end ">
        
        <i class="bi bi-x cursor-pointer text-xl p-2.5 md:hidden" onclick="toggleSidebar()"></i>
    </div>
    {{-- <div class="my-2 bg-gray-600 h-[1px]"></div> --}}

    <!-- Logo -->
    <a href="{{ route('user/index') }}" class="flex items-center p-3 block">
        <img src="{{ asset('./assets/images/logo.png') }}" width="100px" height="100" class="w-[200px] h-auto object-contain" />
    </a>
    <hr class="my-4"/>

    

    <!-- Menu Items -->
    <ul class="mt-4">
        <li><button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="flex w-full items-center p-2 hover:bg-gray-300 rounded-md"><i class="bi bi-person-plus-fill mr-2"></i> Add Candidate</button></li>
        <li><button data-bs-toggle="modal" data-bs-target="#agentModal" type="button" class="flex w-full items-center p-2 hover:bg-gray-300 rounded-md"><i class="bi bi-person-fill mr-2"></i> Add Agent</button></li>
        <li><a href="{{ route('user/embassy_list') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md"><i class="bi bi-folder-fill mr-2"></i> Create Embassy List</a></li>
        
        <!-- Dropdown Menu -->
        <li class="relative">
            <button id="dropdownToggle" class="w-full flex items-center p-2 hover:bg-gray-300 rounded-md">
                <i class="bi bi-gear-fill mr-2"></i> Reports
                <i class="bi bi-chevron-down ml-auto transition-transform" id="arrow"></i>
            </button>
            <ul id="dropdownMenuReport" class="hidden ml-6 mt-2 bg-gray-200 rounded-md overflow-hidden">
                <li><a href="{{ route('user/embassy_report') }}" class="block p-2 hover:bg-gray-300">Embassy Report</a></li>
                <li><a href="{{ route('agents') }}" class="block p-2 hover:bg-gray-300">Agents List</a></li>
                <li><a href="{{ route('agent_candidate') }}"  class="block p-2 hover:bg-gray-300">Passenger Summary</a></li>
               
            </ul>
        </li>
        <li class="relative">
            <button id="dropdownToggleManpower" class="w-full flex items-center p-2 hover:bg-gray-300 rounded-md">
                <i class="bi bi-gear-fill mr-2"></i> Manpower Forms
                <i class="bi bi-chevron-down ml-auto transition-transform" id="arrow-manpower"></i>
            </button>
            <ul id="dropdownMenuManpower" class="hidden ml-6 mt-2 bg-gray-200 rounded-md overflow-hidden">
                <li><a href="{{ route('note-sheet') }}" class="block p-2 hover:bg-gray-300">Note Sheet</a></li>
    <li><a href="{{ route('putup-list') }}" class="block p-2 hover:bg-gray-300">Putup List</a></li>
    <li><a href="{{ route('contract') }}" class="block p-2 hover:bg-gray-300">Contract</a></li>
    <li><a href="{{ route('stemp_paper') }}" class="block p-2 hover:bg-gray-300">Stamp Paper</a></li>
    <li><a href="{{ route('application') }}" class="block p-2 hover:bg-gray-300">Application</a></li>
               
            </ul>
        </li>
    </ul>
</div>

<!-- Hamburger Button (For Mobile) -->
<button id="menuBtn" class="fixed top-4 left-4 z-50 bg-[#0b7f96] text-white p-2 rounded-md md:hidden">
    <i class="bi bi-list text-2xl"></i>
</button>

<!-- Overlay (For closing sidebar when clicking outside) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden xl:hidden"></div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const rightbar = document.getElementById("rightbar");
        const overlay = document.getElementById("overlay");
        
        sidebar.classList.toggle("-translate-x-full");
        rightbar.classList.toggle("!m-0");
        // overlay.classList.toggle("hidden");
    }

    // Event Listeners
    document.getElementById("menuBtn").addEventListener("click", toggleSidebar);
    document.getElementById("overlay").addEventListener("click", toggleSidebar);

    // Dropdown Toggle
    document.getElementById("dropdownToggle").addEventListener("click", function(event) {
        const dropdownMenuReport = document.getElementById("dropdownMenuReport");
        const arrow = document.getElementById("arrow");

        dropdownMenuReport.classList.toggle("hidden");
        arrow.classList.toggle("rotate-180");

        event.stopPropagation(); // Prevents dropdown from closing when clicking inside
    });
    document.getElementById("dropdownToggleManpower").addEventListener("click", function(event) {
        const dropdownMenuManpower = document.getElementById("dropdownMenuManpower");
        const arrow = document.getElementById("arrow-manpower");

        dropdownMenuManpower.classList.toggle("hidden");
        arrow.classList.toggle("rotate-180");

        event.stopPropagation(); // Prevents dropdown from closing when clicking inside
    });

    // Close Dropdown when clicking outside
    document.addEventListener("click", function(event) {
        const dropdownMenuReport = document.getElementById("dropdownMenuReport");
        const dropdownToggleReport = document.getElementById("dropdownToggleReport");

        // Ensure elements exist before using 'contains'
        if (!dropdownToggleReport || !dropdownMenuReport) return;

        if (!dropdownToggleReport.contains(event.target) && !dropdownMenuReport.contains(event.target)) {
            dropdownMenuReport.classList.add("hidden");
            const arrow = document.getElementById("arrow");
            if (arrow) {
                arrow.classList.remove("rotate-180");
            }
        }
    }); 

    document.addEventListener("click", function(event) {
        const dropdownMenuManpower = document.getElementById("dropdownMenuManpower");
        const dropdownToggleManpower = document.getElementById("dropdownToggleManpower");

        if (!dropdownToggleManpower.contains(event.target) && !dropdownMenuManpower.contains(event.target)) {
            dropdownMenuManpower.classList.add("hidden");
            document.getElementById("arrow-manpower").classList.remove("rotate-180");
        }
    });
</script>


<!-- Main Content -->
{{-- <div class="flex-1 p-5">
    <button id="toggleBtn" class="md:hidden bg-gray-800 text-white p-2 rounded">☰</button>
</div> --}}


     




{{-- <script>
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleBtn");
  
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-full");
    });
  </script> --}}
  