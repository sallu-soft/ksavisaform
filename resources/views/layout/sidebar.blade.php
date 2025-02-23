<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 w-[280px] h-full bg-gray-50 text-gray-700 p-4 transition-transform transform -translate-x-full xl:translate-x-0 z-50 shadow-lg overflow-y-auto">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-end ">
        
        <i class="bi bi-x cursor-pointer text-xl p-2.5 xl:hidden" onclick="toggleSidebar()"></i>
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
            <ul id="dropdownMenu" class="hidden ml-6 mt-2 bg-gray-200 rounded-md overflow-hidden">
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
<button id="menuBtn" class="fixed top-4 left-4 z-50 bg-[#0b7f96] text-white p-2 rounded-md xl:hidden">
    <i class="bi bi-list text-2xl"></i>
</button>

<!-- Overlay (For closing sidebar when clicking outside) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden xl:hidden"></div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        
        sidebar.classList.toggle("-translate-x-full");
        overlay.classList.toggle("hidden");
    }

    // Event Listeners
    document.getElementById("menuBtn").addEventListener("click", toggleSidebar);
    document.getElementById("overlay").addEventListener("click", toggleSidebar);

    // Dropdown Toggle
    document.getElementById("dropdownToggle").addEventListener("click", function(event) {
        const dropdownMenu = document.getElementById("dropdownMenu");
        const arrow = document.getElementById("arrow");

        dropdownMenu.classList.toggle("hidden");
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
        const dropdownMenu = document.getElementById("dropdownMenu");
        const dropdownToggle = document.getElementById("dropdownToggle");

        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add("hidden");
            document.getElementById("arrow").classList.remove("rotate-180");
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


        {{-- user modal --}}
        <div class="modal fade" id="user" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog max-w-[900px]">
                <div class="modal-content max-w-[900px]">
                    <div class="modal-header  bg-[#275E8B]">
                        <h5 class="modal-title text-white font-semibold" id="exampleModalLabel">Update User</h5>
                        <button type="button"
                            class="btn-close bg-red-800 flex justify-center bg-red-600 !bg-red-600  items-center font-bold text-white !text-white p-2"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0 bg-[#f2f9fc]">
                        {{-- <div class="text-center bg-white py-2 text-xl uppercase rounded-b-xl mb-2">{{$user->licence_name}}-(RL-{{$user->rl_no}})</div> --}}


                        <div class="w-full flex flex-wrap py-3 gap-3">
                            <div class="w-full rounded-lg md:w-[49%] text-xl font-semibold shadow-lg flex">
                                <p
                                    class="w-1/4 flex items-center justify-center bg-indigo-400 rounded-l-lg text-white">
                                    RL
                                    Name</p>
                                <p class="p-3 uppercase pl-2 w-3/4 text-center">{{ $user->licence_name }}</p>
                            </div>
                            <div class="w-full rounded-lg md:w-[49%] text-xl font-semibold shadow-lg flex">
                                <p
                                    class="w-1/4 flex items-center justify-center bg-indigo-400 rounded-l-lg pl-2 text-white">
                                    RL Name Arabic</p>
                                <p class="p-3 uppercase w-3/4 flex items-center justify-center text-2xl">
                                    {{ $user->arabic_name }}</p>
                            </div>

                        </div>

                        <div class="w-full flex flex-wrap py-3 gap-3">
                            <div class="w-full rounded-lg md:w-[49%] text-xl font-semibold shadow-lg flex">
                                <p
                                    class="w-1/4 flex items-center justify-center bg-indigo-400 rounded-l-lg pl-2 text-white">
                                    RL NO</p>
                                <p class="p-3 uppercase w-3/4 flex items-center justify-center text-2xl">
                                    {{ $user->rl_no }}</p>
                            </div>

                            <div class="w-full rounded-lg md:w-[49%] text-xl font-semibold shadow-lg flex">
                                <p
                                    class="w-1/4 flex items-center justify-center bg-indigo-400 rounded-l-lg text-white">
                                    Email</p>
                                <p class="p-3 pl-2 w-3/4 text-center overflow-hidden">{{ $user->email }}</p>
                            </div>


                        </div>

                        <form action="{{ route('user/update') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-outline ">

                                        @php
                                            // dd($user->phone);
                                            if ($user->phone) {
                                                echo '
                        
                        ';
                                            } else {
                                                echo '<label class="form-label" for="form6Example4">Agency Owner Phone Number</label><input type="text" id="form6Example4" class="form-control" name="phone"/>';
                                            }
                                        @endphp

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="exampleInputEmail1" class="form-label">Embassy Representative Name</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uname"> --}}
                                @php
                                    // dd($user->phone);
                                    if ($user->embassy_man_name) {
                                        echo '<input type="text" id="form6Example4" placeholder="' .
                                            $user->embassy_man_name .
                                            '" class="form-control " value="' .
                                            $user->embassy_man_name .
                                            '" name="uname"/>';
                                    } else {
                                        echo '<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uname">';
                                    }
                                @endphp

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Embassy Representative
                                    Number(What's
                                    App)</label>
                                @php
                                    // <input type="text" class="form-control" id="exampleInputPassword1" name="wsphn">
                                    if ($user->embassy_man_phone) {
                                        echo '<input type="text" id="form6Example4" placeholder="' .
                                            $user->embassy_man_phone .
                                            '" class="form-control " value="' .
                                            $user->embassy_man_phone .
                                            '" name="wsphn" />';
                                    } else {
                                        echo '<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="wsphn">';
                                    }
                                @endphp
                            </div>

                            <div class="row">
                                <!-- First Column -->
                                <div class="col-md-6 mb-3">
                                    <label for="rl_no_bangla" class="form-label">RL Number (Bangla)</label>
                                    <input type="text" id="rl_no_bangla" class="form-control" name="rl_no_bangla"
                                        placeholder="Enter RL Number in Bangla"
                                        value="{{ $user->rl_no_bangla ?? '' }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rl_name_bangla" class="form-label">RL Name (Bangla)</label>
                                    <input type="text" id="rl_name_bangla" class="form-control"
                                        name="rl_name_bangla" placeholder="Enter RL Name in Bangla"
                                        value="{{ $user->rl_name_bangla ?? '' }}">
                                </div>

                                <!-- Second Column -->
                                <div class="col-md-6 mb-3">
                                    <label for="owner_name_bangla" class="form-label">Owner Name (Bangla)</label>
                                    <input type="text" id="owner_name_bangla" class="form-control"
                                        name="owner_name_bangla" placeholder="Enter Owner Name in Bangla"
                                        value="{{ $user->owner_name_bangla ?? '' }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="owner_name_english" class="form-label">Owner Name (English)</label>
                                    <input type="text" id="owner_name_english" class="form-control"
                                        name="owner_name_english" placeholder="Enter Owner Name in English"
                                        value="{{ $user->owner_name_english ?? '' }}">
                                </div>

                                <!-- Full-Width Field -->
                                <div class="col-12 mb-3">
                                    <label for="office_address_bangla" class="form-label">Office Address
                                        (Bangla)</label>
                                    <input type="text" id="office_address_bangla" class="form-control"
                                        name="office_address_bangla" placeholder="Enter Office Address in Bangla"
                                        value="{{ $user->office_address_bangla ?? '' }}">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                
                </div>
            </div>
        </div>

        {{-- agent modal --}}
        <div class="modal fade " id="agentModal" tabindex="-1" aria-labelledby="agentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-[#275E8B]">
                        <h5 class="modal-title text-white" id="agentModalLabel">Add New Agent</h5>
                        <button type="button" class="btn-close !text-white !bg-red-600 font-bold"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body bg-[#f2f9fc]">
                        <form class="row g-3" id="addagent" action="{{ route('agent/index') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="px-10 gap-x-10 grid md:grid-cols-2">
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Agent's Name</div>
                                        <input type="text" class="form-control uppercase" required id="agent_name"
                                            name="agent_name" placeholder="">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Agent's Phone Number</div>
                                        <input type="number" class="form-control uppercase" id="agent_phone"
                                            name="agent_phone" placeholder="">
                                    </div>
                                    {{-- <div class="py-1">
                                    <div class="font-semibold text-lg">Agent's Email</div>
                                    <input type="email" class="form-control" id="agent_email"
                                        name="agent_email" placeholder="">
                                </div> --}}
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Agent's Address</div>
                                        <input type="text" class="form-control uppercase" id="agent_address"
                                            name="agent_address" placeholder="">
                                    </div>
                                    {{-- <div class="py-1">
                                    <div class="font-semibold text-lg">Agent's Emergency Phone No</div>
                                    <input type="text" class="form-control uppercase" id="agent_e_phone"
                                        name="agent_e_phone" placeholder="">
                                </div> --}}
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Agent's Picture</div>
                                        <input type="file" class="form-control" id="agent_picture"
                                            name="agent_picture">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="bg-[#289788] hover:bg-[#074f56] p-3 rounded text-white font-semibold">
                                    Add Agent
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" bg-[#074f56] p-3 rounded text-white font-semibold"
                            data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        {{-- candidat modal --}}
        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-[#275E8B] text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Candidate</h5>
                        <button type="button"
                            class="btn-close !bg-red-600 bg-red-500 !bg-white btn text-white font-bold"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body bg-[#f2f9fc]">
                        <form class="row g-3 " id="addcandidate" action="{{ route('user/index') }}" method="post">
                            @csrf

                            <div class="">
                                <div class="px-10 gap-x-10 grid md:grid-cols-2">
                                    <div class="py-1">
                                        <input type="hidden" name="sl_number" value="{{ $maxSlNumber + 1 }}" />
                                        <div class="font-semibold text-lg">Agent <span class="text-red-500">*</span>
                                        </div>
                                        <div class="flex items-center justify-center gap-2">
                                            <select class="form-control select2 w-[70%]" id="agent_id"
                                                name="agent_id" required>
                                                <option value="" disabled selected>Select Agent</option>
                                                @foreach ($agentsform as $agent)
                                                    <option value="{{ $agent->id }}">{{ $agent->agent_name }}
                                                    </option>
                                                @endforeach
                                                <!-- Add more options as needed -->
                                            </select>
                                            <button type="button"
                                                class="rounded-md w-[28%] bg-indigo-500 text-white p-2 text-md font-semibold"
                                                data-bs-toggle="modal" data-bs-target="#agentModal">Add Agent</button>
                                        </div>
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Candidate Name <span
                                                class="text-red-500">*</span> </div>
                                        <input type="text" class="form-control uppercase" id="pname"
                                            name="pname" placeholder="" required>
                                    </div>



                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Passport Number <span
                                                class="text-red-500">*</span></div>
                                        <input type="text" class="form-control uppercase " id="pnumber"
                                            autocomplete="off" name="pnumber" minlength="0" maxlength="9" required
                                            placeholder="">
                                    </div>
                                    <div class="py-1">
                                        <div class="items-center gap-3 flex">
                                            <div class="text-lg font-semibold">Passport Issue Date </div>
                                            <div class="text-md font-semibold">
                                                <input type="radio" id="five" name="passDate"
                                                    value="five" />
                                                <label for="five" class="mr-4">5 years</label>
                                                <input type="radio" id="ten" checked name="passDate"
                                                    value="ten" />
                                                <label for="ten">10 years</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control uppercase " id="pass_issue_date"
                                            autocomplete="off" placeholder="" name="pass_issue_date">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Passport Expire Date</div>
                                        <input type="text" class="form-control uppercase" id="pass_expire_date"
                                            name="pass_expire_date" placeholder="">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Date Of Birth <span
                                                class="text-red-500">*</span></div>
                                        <input type="text" class="form-control uppercase" id="date_of_birth"
                                            required autocomplete="off" name="date_of_birth" placeholder="">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Place Of Birth</div>
                                        <input type="text" class="form-control uppercase" id="place_of_birth"
                                            name="place_of_birth" list="districts" placeholder="">
                                        <datalist id="districts">
                                            <option value="Bagerhat">
                                            <option value="Barishal">
                                            <option value="Jashore">
                                            <option value="Chattogram">
                                            <option value="Cumilla">
                                            <option value="Bogura">
                                            <option value="Bandarban">
                                            <option value="Barguna">
                                            <option value="Barisal">
                                            <option value="Bhola">
                                            <option value="Bogra">
                                            <option value="Brahmanbaria">
                                            <option value="Chandpur">
                                            <option value="Chapainawabganj">
                                            <option value="Chittagong">
                                            <option value="Chuadanga">
                                            <option value="Comilla">
                                            <option value="Cox's Bazar">
                                            <option value="Dhaka">
                                            <option value="Dinajpur">
                                            <option value="Faridpur">
                                            <option value="Feni">
                                            <option value="Gaibandha">
                                            <option value="Gazipur">
                                            <option value="Gopalganj">
                                            <option value="Habiganj">
                                            <option value="Jamalpur">
                                            <option value="Jessore">
                                            <option value="Jhalokati">
                                            <option value="Jhalakati">
                                            <option value="Jhalakathi">
                                            <option value="Jhenaidah">
                                            <option value="Joypurhat">
                                            <option value="Khagrachhari">
                                            <option value="Khulna">
                                            <option value="Kishoreganj">
                                            <option value="Kurigram">
                                            <option value="Kushtia">
                                            <option value="Lakshmipur">
                                            <option value="Lalmonirhat">
                                            <option value="Madaripur">
                                            <option value="Magura">
                                            <option value="Manikganj">
                                            <option value="Meherpur">
                                            <option value="Moulvibazar">
                                            <option value="Munshiganj">
                                            <option value="Mymensingh">
                                            <option value="Naogaon">
                                            <option value="Narail">
                                            <option value="Narayanganj">
                                            <option value="Narsingdi">
                                            <option value="Natore">
                                            <option value="Netrokona">
                                            <option value="Nilphamari">
                                            <option value="Noakhali">
                                            <option value="Pabna">
                                            <option value="Panchagarh">
                                            <option value="Patuakhali">
                                            <option value="Pirojpur">
                                            <option value="Rajbari">
                                            <option value="Rajshahi">
                                            <option value="Rangamati">
                                            <option value="Rangpur">
                                            <option value="Satkhira">
                                            <option value="Shariatpur">
                                            <option value="Sherpur">
                                            <option value="Sirajganj">
                                            <option value="Sunamganj">
                                            <option value="Sylhet">
                                            <option value="Tangail">
                                            <option value="Thakurgaon">
                                        </datalist>
                                    </div>
                                    {{-- <div class="py-1">
                      <div class="font-semibold text-lg">Address</div>
                      <input type="text" class="form-control uppercase" id="address" name="address" placeholder="">
                    </div> --}}
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Father's Name</div>
                                        <input type="text" class="form-control uppercase" id="father"
                                            name="father" placeholder="">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Mother's Name</div>
                                        <input type="text" class="form-control uppercase" id="mother"
                                            name="mother" placeholder="">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Religion</div>
                                        <select class="form-control p-2 rounded-lg w-full" size="large"
                                            placeholder="" id="religion" name="religion">
                                            <option selected>Choose...</option>
                                            <option value="MUSLIM">MUSLIM</option>
                                            <option value="NON MUSLIM">NON MUSLIM</option>
                                        </select>
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Gender</div>
                                        <select class="form-control p-2 rounded-lg w-full" size="large"
                                            placeholder="" name="gender" id="gender">
                                            <option selected>Choose...</option>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </select>
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Marital Status</div>
                                        <select id="inputState" class="form-select uppercase" name="married">
                                            <option selected>Choose...</option>
                                            <option value="MARRIED">MARRIED</option>
                                            <option value="UNMARRIED">UNMARRIED</option>
                                        </select>
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Address</div>
                                        <div class="input-group">
                                            <input type="text" class="form-control uppercase" id="address"
                                                placeholder="" name="address">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h2 class='my-4 font-bold text-2xl ml-10'>Other Inoformaition</h2>
                                </div>

                                <div class="px-10 gap-x-10 grid md:grid-cols-2">

                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Medical Center Name</div>
                                        <input type="text" class="form-control uppercase" placeholder=""
                                            value="FIT" id="medical_center_name" name="medical_center_name">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Medical Issue Date</div>
                                        <input type="text" class="form-control uppercase" placeholder=""
                                            id="medical_issue_date" name="medical_issue_date">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Medical Expiry Date</div>
                                        <input type="text" class="form-control uppercase" placeholder=""
                                            id="medical_expire_date" name="medical_expire_date">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Driver Licence Number</div>
                                        <input type="text" class="form-control uppercase" id="driving_licence"
                                            placeholder="" name="driving_licence">
                                    </div>
                                    <div class="py-1">
                                        <div class="font-semibold text-lg">Police Clearence No</div>
                                        <div class="input-group border border-gray-200 rounded-lg">
                                            <input type="text"
                                                class="form-control border-none focus:outline-none uppercase"
                                                id="police_licence" placeholder="" name="police_licence">
                                            <button type="button"
                                                class="rounded-r-lg bg-indigo-500 text-white p-2 text-md font-semibold"
                                                onclick="SearchPC()">Search</button>
                                        </div>
                                    </div>

                                    <div class="text-start">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="bg-[#289788] hover:bg-[#074f56] p-3 rounded text-white font-semibold">
                                    Add Candidate
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" bg-[#074f56] p-3 rounded text-white font-semibold"
                            data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        {{-- agent modal view --}}
        <div class="modal fade" id="viewAgentModal" tabindex="-1" aria-labelledby="viewAgentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewAgentModalLabel">Agent Details</h5>
                        <button type="button" class="btn-close !bg-red-600" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="agentDetails">

                    </div>
                </div>
            </div>
        </div>



<script>
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleBtn");
    const dropdownToggle = document.getElementById("dropdownToggle");
    const dropdownMenu = document.getElementById("dropdownMenu");
    const arrow = document.getElementById("arrow");

    // Sidebar Toggle
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-full");
    });

    // Dropdown Toggle
    dropdownToggle.addEventListener("click", () => {
        dropdownMenu.classList.toggle("hidden");
        arrow.classList.toggle("rotate-180"); // Rotates arrow when open
    });
</script>
{{-- <script>
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleBtn");
  
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-full");
    });
  </script> --}}
  