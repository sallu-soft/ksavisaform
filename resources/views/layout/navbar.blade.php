

<div class="bg-gradient-to-r from-[#1e3a8a] to-[#0f172a] shadow-lg sticky top-0 z-50">
    <nav class="w-[90%] mx-auto py-3 flex items-center justify-between">
      <!-- Left Section -->
      <div  class="flex items-center gap-x-8">
      <div class="flex items-center gap-6 text-white border-r border-gray-100 pr-5">
        <div>
          <p class="font-normal text-md">For Support</p>
          <p class="font-semibold text-md">📞 01888-043572</p>
          <p class="text-sm opacity-80">📧 contact.sallusoft@gmail.com</p>
        </div>
      </div>
      <div class="flex items-center gap-6 text-white">
        <div>
          <p class="font-normal text-md">Mohammed Shakil</p>
          <p class="font-semibold text-md">📞 01609-317035</p>
          <p class="text-sm opacity-80">📧 contact.sallusoft@gmail.com</p>
        </div>
      </div>
    </div>
      <!-- Middle Section: User Info -->
      <div  class=" relative flex items-center gap-x-2">
        <button  class="flex items-center gap-x-4 font-bold text-xl tracking-wide  bg-gray-100 px-4 py-2 rounded-lg">
           <div class="text-start"><div class="text-sm font-semibold text-gray-800">Next Payment In!</div><span class="animate-bounce font-bold text-lg text-red-600">
            {{ \Carbon\Carbon::parse($user->previous_month)->addDays(30)->format('d-m-Y') }}
        </span></div></button>
        <button id="profileDropdownBtn" class="flex items-center gap-x-4 font-bold text-xl tracking-wide  bg-gray-100 p-2 rounded-lg">
            <span class="bg-gray-800 w-10 h-10 text-2xl text-white font-normal p-1 rounded-full ">{{ !empty($user->licence_name) ? strtoupper($user->licence_name[0]) : '' }}</span><div class="text-start"><div class="text-sm font-semibold text-gray-800">Welcome Back!</div><span class="font-bold text-lg"> {{ $user->licence_name }} - {{ $user->rl_no }}</span></div></button>
        
        <div id="profileDropdown" class="absolute top-16 right-0 bg-white text-gray-700 rounded-md shadow-md hidden w-48 transition-opacity opacity-0 duration-300">
            <button data-bs-target="#user" data-toggle="tooltip" data-placement="bottom" title="Edit Profile" data-bs-toggle="modal" class="w-full px-4 text-start py-2 hover:bg-gray-100"><i class="far fa-user mr-2"></i>Edit Profile</button>
           
            <a href="{{ route('user/logout') }}" class="block px-4 py-2 hover:bg-red-500 hover:text-white text-red-600"><i class="bi bi-box-arrow-left mr-2"></i> Logout</a>
          </div>
      </div>
      
      <!-- Right Section: Icons & Dropdown -->
       
  
        <!-- Profile Dropdown Menu -->
        
    </nav>
  </div>
    



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
                              
                                  <select class="form-control select2" id="agent_id"
                                      name="agent_id" required>
                                      <option value="" disabled selected>Select Agent</option>
                                      @foreach ($agentsform as $agent)
                                          <option value="{{ $agent->id }}">{{ $agent->agent_name }}
                                          </option>
                                      @endforeach
                                      <!-- Add more options as needed -->
                                  </select>
                                  
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
    document.addEventListener("DOMContentLoaded", () => {
      const profileBtn = document.getElementById("profileDropdownBtn");
      const profileMenu = document.getElementById("profileDropdown");
  
      profileBtn.addEventListener("click", () => {
        profileMenu.classList.toggle("hidden");
        profileMenu.classList.toggle("opacity-0");
      });
  
      document.addEventListener("click", (event) => {
        if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
          profileMenu.classList.add("hidden");
          profileMenu.classList.add("opacity-0");
        }
      });
    });
  </script>
  <script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
  
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Check if the elements exist before adding event listener
        if (!dropdownButton || !dropdownMenu) {
            console.error("Dropdown elements not found in the DOM.");
            return;
        }

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    });

  
    // Close the dropdown if clicked outside
    document.addEventListener('click', (event) => {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Ensure elements exist before using 'contains'
        if (!dropdownButton || !dropdownMenu) return;

        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
  
  
    const dropdownReportButton = document.getElementById('dropdownReportButton');
    const dropdownMenu1 = document.getElementById('dropdownMenu1');
  
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownReportButton = document.getElementById('dropdownReportButton');
        const dropdownMenu1 = document.getElementById('dropdownMenu1');

        // Ensure the elements exist before adding an event listener
        if (!dropdownReportButton || !dropdownMenu1) {
            console.error("Dropdown elements not found in the DOM.");
            return;
        }

        dropdownReportButton.addEventListener('click', () => {
            dropdownMenu1.classList.toggle('hidden');
        });
    });

  
    // Close the dropdown if clicked outside
    document.addEventListener('click', (event) => {
        const dropdownReportButton = document.getElementById('dropdownReportButton');
        const dropdownMenu1 = document.getElementById('dropdownMenu1');

        // Ensure elements exist before using 'contains'
        if (!dropdownReportButton || !dropdownMenu1) return;

        if (!dropdownReportButton.contains(event.target) && !dropdownMenu1.contains(event.target)) {
            dropdownMenu1.classList.add('hidden');
        }
    });
  </script>

  

