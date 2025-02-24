<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>KSA Form Print Solution</title>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <style>
        #candidatetable_filter {
            margin-bottom: 20px;
        }

        .tooltip {
            position: relative;
            display: inline-block;
            /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #92560c;
            color: #fff;
            border: 1px solid white;
            text-align: center;
            padding: 3px 3px;
            font-size: 14px;
            border-radius: 6px;

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
            right: 10px;
            top: 40px;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        table.table-bordered.dataTable thead tr:first-child th,
        table.table-bordered.dataTable thead tr:first-child td {
            border-top-width: 1px;

        }

        /* table.table-bordered.dataTable thead tr:first-child th:hover,
        table.table-bordered.dataTable thead tr:hover {
            background-color: #a85454;
            transition: background-color 0.3s ease;
        } */
        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 8px 12px;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }
    </style>

    @isset($user)
        @include('layout.head', ['user' => $user])
    @endisset
</head>

<body class="bg-[#f2f9fc] flex">
    
        @include('layout.sidebar')
    <div class="flex-1 xl:ml-[280px]">
        @include('layout.navbar')





        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
                {!! session()->forget('success') !!}
            </script>
        @endif





        <!-- End Hero -->
        <div class="w-[90%] mx-auto my-5 hello">

            

        </div>
        {{-- agent view modal --}}
        {{-- <div class="modal fade" id="agentViewModal" tabindex="-1" aria-labelledby="agentViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-[#275E8B]">
                        <h5 class="modal-title text-white" id="agentViewModalLabel">Agent Details</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
        
                    <div class="modal-body bg-[#f2f9fc]">
                        <div class="px-10 gap-x-10 grid md:grid-cols-2">
                            <div class="py-1">
                                <div class="font-semibold text-lg">Agent's Name</div>
                                <p class="form-control uppercase" id="agent_name" value="" name="agent_name"></p>
                            </div>
                            
                            <div class="py-1">
                                <div class="font-semibold text-lg">Agent's Phone Number</div>
                                <input type="number" class="form-control uppercase" id="agent_phone" value="" name="agent_phone">
                            </div>
                            
                            <div class="py-1">
                                <div class="font-semibold text-lg">Agent's Address</div>
                                <input type="text" class="form-control uppercase" id="agent_address" value="" name="agent_address">
                            </div>
                        </div>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="bg-[#074f56] p-3 rounded text-white font-semibold" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="modal fade" id="agentViewModal" tabindex="-1" aria-labelledby="agentViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-[#275E8B]">
                        <h5 class="modal-title text-white" id="agentViewModalLabel">Agent Details</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
        
                    <div class="modal-body bg-[#f2f9fc]">
                        <div class="px-10 gap-x-10 grid md:grid-cols-2">
                            <div class="py-1">
                                <div class="font-semibold text-lg">Agent's Name</div>
                                <p id="agent_name" class="text-gray-700 font-medium"></p>
                            </div>
                            
                            <div class="py-1">
                                <div class="font-semibold text-lg">Agent's Phone Number</div>
                                <p id="agent_phone" class="text-gray-700 font-medium"></p>
                            </div>
                            
                            <div class="py-1">
                                <div class="font-semibold text-lg">Agent's Address</div>
                                <p id="agent_address" class="text-gray-700 font-medium"></p>
                            </div>
                        </div>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="bg-[#074f56] p-3 rounded text-white font-semibold" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive rounded-lg bg-[#DFE8EF]  my-5 w-[98%] xl:w-[97%] mx-auto shadow-lg main-datatable">
            <form method="GET" class="bg-[#275E8B] py-2" action="{{ route('user/index') }}">
                <div class="flex w-[50%] my-3 mx-auto gap-4 ">
                    <input type="text" class="form-control" name="search" placeholder="Search"
                        value="{{ request('search') }}">
                    <button type="submit" class="text-white px-4 rounded-lg bg-indigo-500">Search</button>
                </div>
            </form>
            <table class=" no-footer dataTable " id="candidatetable">
                <thead class="bg-[#f9f9f9] thed">
                    <tr class="bg-[#f9f9f9]">
                        <th scope="col">Serial <br /> Number</th>
                        <th scope="col">Creation <br /> Date</th>
                        <th scope="col" class="w-[250px]">Name</th>

                        <th scope="col" class="w-[80px]">DOB</th>
                        <th scope="col" style="">VISA/Sponsor <br /> Number</th>
                        <th scope="col" class="text-lg">Medical Info</th>

                        <th scope="col">Profession/MOFA No</th>

                        <th scope="col" class="w-[120px]">Actions</th>
                    </tr>
                </thead>
                <tbody class="cantab">

                    {{-- @foreach ($candidates as $index => $candidate) --}}
                    @foreach ($candidates as $index => $candidate)
                        @php

                            $dob = $candidate->date_of_birth;
                            $birthdate = new DateTime($dob);
                            $currentDate = new DateTime();
                            $ageInterval = $birthdate->diff($currentDate);
                            $years = $ageInterval->y;
                            $age = '';
                            if ($years > 0) {
                                $age .= $years . ' year' . ($years > 1 ? 's' : '');
                            }
                        @endphp
                        @php
                            $visaExpDate = \Carbon\Carbon::parse($candidate->visa_exp_date);
                            $daysLeft = $visaExpDate->diffInDays(\Carbon\Carbon::now(), false);
                        @endphp
                        @php
                            $medicalExpDate = \Carbon\Carbon::parse($candidate->medical_expire_date);
                            $medicalDaysLeft = $medicalExpDate->diffInDays(\Carbon\Carbon::now(), false);
                        @endphp

                        <!-- Add Candidate Visa Modal -->
                        <div class="modal fade" id="addVisaModal" tabindex="-1" aria-labelledby="addVisaModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addVisaModalLabel">Add Candidate Visa</h5>
                                        <button type="button" class="btn-close btn text-red-700 font-bold"
                                            data-bs-dismiss="modal" aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="visainput" method="post" action class="mt-5">
                                            @csrf
                                            <input type="hidden" name="candidate_id" id="candidate_id"
                                                value="{{ $candidate->id }}" />
                                            <div class="px-10 gap-x-10 grid md:grid-cols-2">
                                                @foreach ([['Visa No', 'visa_no', 'Ex- 1303044456'], ['Sponsor ID', 'spon_id', 'Ex- 7097997442'], ['Visa Date (Hijri)', 'visa_date', 'Ex- 1444/09/30'], ['Salary', 'salary', 'Ex- 1000'], ['Sponsor Name (Arabic)', 'spon_name_arabic', 'Ex- القوة العربية.'], ['Sponsor Name (English)', 'spon_name_english', 'Ex- Arabic Power'], ['Profession (Arabic)', 'prof_name_arabic', 'Ex- القوة العربية.'], ['Profession (English)', 'prof_name_english', 'Ex- Electrian'], ['Mofa No', 'mofa_no', 'Ex- 43780333'], ['Mofa Date', 'mofa_date', ''], ['Okala No', 'okala_no', 'Ex- 9430340'], ['Musaned No', 'musaned_no', 'Ex- 039409230']] as [$label, $id, $placeholder])
                                                    <div class="py-2 flex flex-col gap-2">
                                                        <div class="font-bold text-lg">{{ $label }}</div>
                                                        <input type="{{ $id === 'mofa_date' ? 'date' : 'text' }}"
                                                            id="{{ $id }}" name="{{ $id }}"
                                                            class="form-control p-2 rounded-lg w-full uppercase"
                                                            placeholder="{{ $placeholder }}" />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="text-center pt-3">
                                                <button type="submit"
                                                    class="bg-[#289788] mb-2 hover:bg-[#074f56] p-3 rounded text-white font-semibold">Add
                                                    Candidate Visa</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="bg-[#074f56] p-3 rounded text-white font-semibold"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($candidate->is_delete == 0)
                            <tr
                                class=" my-auto border hover:bg-gray-200 border-gray-600 [&>td]:border-t [&>td]:border-gray-600">
                                {{-- <td>{{ $candidates->total() - ($loop->index + (($candidates->currentPage() - 1) * $candidates->perPage())) }}</td> --}}
                                <td scope="col" class="">
                                    <span>{{ $candidate->sl_number ?? $candidate->serial_number }}</span>
                                </td>
                                {{-- <th scope="col" class=""><span>{{ $serial }}</span></th> --}}
                                <td class="">
                                    {{ date('d-m-Y', strtotime($candidate->created_at)) }}<br />
                                    {{ date('H:m', strtotime($candidate->created_at)) }}
                                </td>
                                <td><a href="{{ route('user/view', ['id' => $candidate->id]) }}"
                                        class="font-semibold hover:font-bold cursor-pointer hover:text-blue-400 text-xl">{{ $candidate->name }}</a><br />
                                    <p class="text-md mt-2 font-semibold">{{ $candidate->passport_number }}</p>
                                    <br /><strong>Agent : </strong><a href="#" class="view-agent" data-agent-id="{{ $candidate->id }}" >
                                        {{ $candidate->agent }}
                                    </a>
                                </td>

                                <td>
                                    {{ date('d-m-Y', strtotime($candidate->date_of_birth)) }}
                                    <br /><span class="font-semibold">Age</span>: {{ $age }}
                                </td>
                                <td>

                                    <strong>Visa No:</strong> {{ $candidate->visa_no }} <br />
                                    <strong>ID:</strong> {{ $candidate->spon_id }}<br />
                                    <strong>Issued Visa:</strong>
                                    @if (!empty($candidate->visa_issued_date))
                                        {{ date('d-m-Y', strtotime($candidate->visa_issued_date)) }}
                                    @endif
                                    <br />
                                    <p class="text-red-600 font-semibold text-md">
                                        @if ($daysLeft <= 0)
                                            {{ $daysLeft }} days remaining
                                        @endif
                                    </p>
                                </td>
                                <td>{{ $candidate->medical_center }}<br />
                                    <strong>Issued Date:</strong>
                                    @if (!empty($candidate->medical_issue_date))
                                        {{ date('d-m-Y', strtotime($candidate->medical_issue_date)) }}
                                    @endif
                                    <br />
                                    <p class="text-red-600 font-semibold text-md">
                                        @if ($medicalDaysLeft <= 0)
                                            {{ $medicalDaysLeft }} days remaining
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <strong>Profession:</strong> {{ $candidate->prof_name_english }} <br />
                                    <strong>MOFA No:</strong> {{ $candidate->mofa_no }}
                                </td>
                                <td scope="col" class="p-1">
                                    @if (!$candidate->visa_no)
                                        <div class="2xl:text-lg text-sm cursor-pointer">
                                            <a href="{{ route('user/visaadd', ['id' => $candidate->id]) }}"
                                                class="fw-semibold text-primary"><i
                                                    class="bi bi-file-earmark-plus mr-1"></i>Visa</a>
                                        </div>
                                    @endif
                                    @if (!$candidate->manpower_id)
                                        <div class="2xl:text-lg text-sm cursor-pointer">
                                            <a href="{{ route('user/manpoweradd', ['id' => $candidate->id]) }}"
                                                class="fw-semibold text-violet-700"><i
                                                    class="bi bi-file-earmark-plus mr-1"></i>Manpower</a>
                                        </div>
                                    @endif
                                    <div class="2xl:text-lg text-sm">
                                        <a href="{{ route('user/edit', ['id' => $candidate->id]) }}"
                                            class="fw-semibold text-success"><i
                                                class="bi bi-pencil-square mr-1"></i>Edit</a>
                                    </div>
                                    <div class="2xl:text-lg text-sm">
                                        <a href="#" onclick="return surity('{{ $candidate->id }}')"
                                            class="fw-semibold text-danger"><i class="bi bi-trash mr-1"></i>Delete</a>
                                    </div>
                                    @if (!$candidate->visa_no)
                                        <div class="2xl:text-lg text-sm fw-semibold text-teal-700 cursor-pointer"
                                            data-bs-toggle="modal" data-bs-target="#printModal">
                                            <i class="bi bi-printer-fill mr-1"></i>Print
                                        </div>
                                        <div class="modal fade" id="printModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-indigo-300">
                                                        <h5 class="modal-title text-black font-semibold"
                                                            id="exampleModalLabel">Print Warning</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body font-semibold text-indigo-800">
                                                        Please Enter Candidates Visa Information First and then Try to
                                                        Print
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div
                                                            class="md:text-lg text-md cursor-pointer bg-green-700 p-1 px-2 rounded-lg text-white">
                                                            <a href="{{ route('user/visaadd', ['id' => $candidate->id]) }}"
                                                                class="fw-semibold"><i
                                                                    class="bi bi-file-earmark-plus mr-1"></i>Visa</a>
                                                        </div>
                                                        <button type="button"
                                                            class="md:text-lg text-md cursor-pointer bg-green-700 p-1 px-2 rounded-lg text-white bg-indigo-600 text-white"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="2xl:text-lg text-sm">
                                            <a href="{{ route('user/print', ['id' => $candidate->id]) }}"
                                                class="fw-semibold text-teal-700"><i
                                                    class="bi bi-printer-fill mr-1"></i>Print</a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @else
                        @endif
                    @endforeach
                </tbody>

            </table>
            {{ $candidates->links() }}
        </div>
        

    </div>

    <a href="https://web.whatsapp.com/send?phone=8801609317035" rel="noopener noreferrer" target="_blank"
        class="fixed bottom-10 right-10 text-6xl text-green-600">
        <i class="bi bi-whatsapp"></i>
    </a>
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    
    @include('layout.script')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script>
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
      
        dropdownButton.addEventListener('click', () => {
            const isExpanded = dropdownMenu.classList.contains('hidden');
            // Toggle the visibility of the dropdown
            dropdownMenu.classList.toggle('hidden', !isExpanded);
        });
      
        // Close the dropdown if clicked outside
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
      
      
        const dropdownReportButton = document.getElementById('dropdownReportButton');
        const dropdownMenu1 = document.getElementById('dropdownMenu1');
      
        dropdownReportButton.addEventListener('click', () => {
            const isExpanded = dropdownMenu1.classList.contains('hidden');
            // Toggle the visibility of the dropdown
            dropdownMenu1.classList.toggle('hidden', !isExpanded);
        });
      
        // Close the dropdown if clicked outside
        document.addEventListener('click', (event) => {
            if (!dropdownReportButton.contains(event.target) && !dropdownMenu1.contains(event.target)) {
                dropdownMenu1.classList.add('hidden');
            }
        });
      </script>
      <script>
        function showAlert() {
            alert("Visa is not available! Please Enter Your Candidates Visa First for Print");
            // You can perform other actions here as needed.
        }
      
        function surity(id) {
            let text = "Sure Want to delete!\nEither OK or Cancel.";
            if (confirm(text)) {
                let url = '/user/delete/' + id;
                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            alert(response.message, "Deleted Successfully");
                            location.reload();
      
                        } else {
                            alert(response.message, "Not Deleted");
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error("An error occurred:", error);
                        // Handle any network or other errors here.
                    });
            } else {
                console.log("You canceled!");
            }
      
            return false; // Prevent the link from being followed immediately
      
        }
      
        function SearchPC() {
            var PCInput = document.getElementById("police_licence").value.toUpperCase();
            var url = `https://pcc.police.gov.bd/ords/f?p=500:50::::RP:P50_TOKEN_ID:${PCInput}`;
      
            // Open the link in a new tab
            window.open(url, "_blank");
        }
      </script>
      <script>
      document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".view-agent").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            let agentId = this.getAttribute("data-agent-id");
            console.log("Agent ID:", agentId);

            if (!agentId) {
                alert("Agent ID is missing.");
                return;
            }

            let url = "{{ route('user.agent_view', ['id' => '__id__']) }}".replace('__id__', agentId);
            console.log("Fetching data from:", url);

            fetch(url)
                .then(response => response.json())
                .then(response => {
                    console.log("Response Data:", response);

                    if (response.success && response.agent) {
                        // Set data inside the <p> tags
                        document.getElementById("agent_name").innerHTML = response.agent.agent_name || "N/A";
                        document.getElementById("agent_phone").textContent = response.agent.agent_phone || "N/A";
                        document.getElementById("agent_address").textContent = response.agent.agent_address || "N/A";
                        // document.getElementById("agent_name2").innerHTML = response.agent.agent_name || "N/A";

                        // Open the modal
                        let modal = new bootstrap.Modal(document.getElementById("agentViewModal"));
                        modal.show();
                    } else {
                        alert("Agent not found!");
                    }
                })
                .catch(error => {
                    console.error("Fetch Error:", error);
                    alert("An error occurred. Please try again.");
                });
        });
    });
});
    </script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agents = @json($agents->items());
            const agentInput = document.getElementById('agentSearch');
            const agentDropdown = document.getElementById('agentDropdown');
            const agentIdInput = document.getElementById('agent_id');
      
            function filterOptions(search) {
                agentDropdown.innerHTML = ''; // Clear previous options
                const filteredAgents = agents.filter(agent =>
                    agent.agent_name.toLowerCase().includes(search.toLowerCase())
                );
      
                if (filteredAgents.length) {
                    filteredAgents.forEach(agent => {
                        const option = document.createElement('div');
                        option.classList.add('dropdown-item');
                        option.textContent = agent.agent_name;
                        option.dataset.value = agent.id;
                        option.addEventListener('click', () => {
                            agentInput.value = agent.agent_name;
                            agentIdInput.value = agent.id;
                            agentDropdown.classList.remove('show');
                        });
                        agentDropdown.appendChild(option);
                    });
                } else {
                    const noResult = document.createElement('div');
                    noResult.classList.add('dropdown-item');
                    noResult.textContent = 'No agents found';
                    agentDropdown.appendChild(noResult);
                }
            }
      
            agentInput.addEventListener('input', function() {
                const search = agentInput.value;
                filterOptions(search);
                agentDropdown.classList.add('show');
            });
      
            document.addEventListener('click', function(e) {
                if (!agentDropdown.contains(e.target) && e.target !== agentInput) {
                    agentDropdown.classList.remove('show');
                }
            });
        });
      
      
      
      
        function deleteAgent(agentId) {
            $.ajax({
                url: `/agents/${agentId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        window.location.href = response.redirect_url;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred. Please try again.');
                }
            });
        }
      
        $(document).ready(function() {
      
           
      
            $('#medical_issue_date').datepicker({
                dateFormat: 'dd/mm/yy',
                onSelect: function(selectedDate) {
                    var issueDate = $(this).datepicker('getDate');
                    issueDate.setMonth(issueDate.getMonth() + 3);
                    issueDate.setDate(issueDate.getDate() - 1);
                    var formattedDate = $.datepicker.formatDate('dd/mm/yy', issueDate);
                    $('#medical_expire_date').val(formattedDate);
                }
            });
      
      
            $('#pass_issue_date').datepicker({
                dateFormat: 'dd/mm/yy',
                onSelect: function(selectedDate) {
                    var issueDate = $(this).datepicker('getDate');
                    var radioSelection = document.querySelector('input[name="passDate"]:checked').value;
                    console.log(radioSelection);
                    if (radioSelection === "ten") {
                        issueDate.setFullYear(issueDate.getFullYear() + 10);
                    } else if (radioSelection === "five") {
                        issueDate.setFullYear(issueDate.getFullYear() + 5);
                    } else {
                        issueDate.setFullYear(issueDate.getFullYear() + 5);
                    }
                    issueDate.setDate(issueDate.getDate() - 1);
                    var formattedDate = $.datepicker.formatDate('dd/mm/yy', issueDate);
                    $('#pass_expire_date').val(formattedDate);
                }
            });
      
      
            // $('#date_of_birth').datepicker({
            //   dateFormat: 'dd/mm/yy',
            //   onSelect: function(selectedDate) {
            //         var dateOfBirth = $(this).datepicker('getDate');
      
            //         var formattedDate = $.datepicker.formatDate('dd/mm/yy',dateOfBirth);
            //         $('#date_of_birth').val(formattedDate);
            //   }
            // });
      
            $('#date_of_birth').datepicker({
                dateFormat: 'dd/mm/yy',
                onSelect: function(selectedDate) {
                    var selectedDateObject = $(this).datepicker('getDate');
                    var currentDate = new Date();
      
                    // Calculate the age difference in years
                    var ageDifferenceYears = currentDate.getFullYear() - selectedDateObject
                        .getFullYear();
      
                    var ageDifference = currentDate - selectedDateObject;
                    var ageDate = new Date(ageDifference);
                    var years = ageDate.getUTCFullYear() - 1970;
                    var months = ageDate.getUTCMonth();
                    var days = ageDate.getUTCDate() - 1;
      
      
                    // Check if the birthdate has occurred 21 or more years ago
                    if (ageDifferenceYears > 21 || (ageDifferenceYears === 21 && (currentDate
                            .getMonth() > selectedDateObject.getMonth() || (currentDate
                                .getMonth() ===
                                selectedDateObject.getMonth() && currentDate.getDate() >=
                                selectedDateObject.getDate())))) {
                        var formattedDate = $.datepicker.formatDate('dd/mm/yy', selectedDateObject);
                        $('#date_of_birth').val(formattedDate);
                    } else {
                        // Display an error message or take some other action
                        var ageString = years + " years, " + months + " months, " + days + " days";
                        alert("You must be at least 21 years old. Your Age is " + ageString);
                        $(this).val(''); // Clear the input field
                    }
                }
            });
      
      
      
            $('#pass_expire_date').datepicker({
                dateFormat: 'd/m/y'
            });
      
            var apiUrl = window.location.origin + '/user/get';
            var method = "GET";
            var data = {
      
            };
            var headers = {
      
            };
      
            callApi(apiUrl, method, data, headers);
      
        });
        var dataObject = {};
      
        function callApi(apiUrl, method, data, headers) {
            $.ajax({
                url: apiUrl,
                type: method,
                data: data,
                headers: headers,
                dataType: "json",
      
                success: function(response) {
                    // console.log(response);
      
                    for (var key in response.candidates) {
                        var candidateValue = response.candidates[key];
                        var userEmail = key;
                        var combinedValue = {
                            candidate: candidateValue,
                            user: response.users[candidateValue] || null
                        };
                        dataObject[userEmail] = combinedValue;
                    }
                    // console.log(dataObject);
                },
                error: function(error) {
                    console.error("Error calling API:", error);
                }
            });
        }
        $('#pnumber').on('change', function() {
            var inputValue = $(this).val();
            var foundObject = dataObject[inputValue];
      
            if (foundObject) {
                // var email = Object.keys(foundObject)[0];
                var email = foundObject.candidate;
                // var licenceName = foundObject[email].user ? foundObject[email].user.licence_name : "Not available";
                var licenceName = foundObject.user.licence_name ? foundObject.user.licence_name : "Not available";
                alert(inputValue + " exists in database under: " + licenceName + '(' + foundObject.user.rl_no +
                    ')' + ' Contact here: ' + email);
      
                $('#pnumber').val("");
            } else {
      
            }
        });
      
        $('#visainput').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var form = $(this);
            var formData = form.serialize(); // Serialize the form data
            // console.log(formData);
            var id = (document.getElementById('candidate_id').value);
            // console.log(id);
            $.ajax({
                url: "{{ url('user/visaadd') }}/" + id,
      
                method: form.attr('method'),
                data: formData,
                success: function(response) {
      
                    console.log(response);
      
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
      
                    });
                    // if (response.redirect_url) {
                    //     setTimeout(function() {
                    //       var redirectUrl = window.location.origin + '/'+ response.redirect_url;
                    //       window.location.href = redirectUrl;
                    //     }, 2000);
                    // }l
      
                },
                error: function(response) {
      
                    console.log(response.title);
                    Swal.fire({
                        title: "Error",
                        text: "Cannot add candidate\n 1: Complete all fields are required\n 2: Same ID check",
                        icon: 'error',
      
                    });
                    //   if (response.redirect_url) {
                    //     setTimeout(function() {
                    //       var redirectUrl = window.location.origin + '/'+ response.redirect_url;
                    //       window.location.href = redirectUrl;
                    //     }, 2000);
                    // }l
      
      
                }
      
            });
        });
      
        $('#addcandidate').on('submit', function(e) {
            e.preventDefault();
      
            var form = $(this);
            var formData = form.serialize();
            // console.log(formData);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
      
                    console.log(response);
      
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
      
                    });
                    if (response.redirect_url) {
                        setTimeout(function() {
                            var redirectUrl = window.location.origin + '/' + response
                                .redirect_url;
                            window.location.href = redirectUrl;
                        }, 3000);
                    }
      
                },
                error: function(response) {
      
                    console.log(response);
                    var errorMessage = xhr.responseText;
                    var regex = /SQLSTATE\[23000\]:.*Duplicate entry.*'(.+)' for key '(.+)'/;
                    var matches = errorMessage.match(regex);
                    var duplicateEntryValue = matches ? matches[1] : null;
                    var duplicateEntryKey = matches ? matches[2] : null;
      
                    console.log("Duplicate Entry Value:", duplicateEntryValue);
                    console.log("Duplicate Entry Key:", duplicateEntryKey);
                    Swal.fire({
                        title: "Error",
                        text: "Cannot add candidate\n 1: Complete all fields are required\n 2: Same ID check",
                        icon: 'error',
      
                    });
                    if (response.redirect_url) {
                        setTimeout(function() {
                            var redirectUrl = window.location.origin + '/' + response
                                .redirect_url;
                            window.location.href = redirectUrl;
                        }, 3000);
                    }
      
                }
            });
        });
        $('#addagent').on('submit', function(e) {
            e.preventDefault();
      
            var form = $(this);
            var formData = form.serialize();
            // console.log(formData);
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
      
                    console.log(response);
      
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
      
                    });
                    if (response.redirect_url) {
                        setTimeout(function() {
                            var redirectUrl = window.location.origin + '/' + response
                                .redirect_url;
                            window.location.href = redirectUrl;
                        }, 3000);
                    }
      
                },
                error: function(response) {
      
                    console.log(response);
                    var errorMessage = xhr.responseText;
                    var regex = /SQLSTATE\[23000\]:.*Duplicate entry.*'(.+)' for key '(.+)'/;
                    var matches = errorMessage.match(regex);
                    var duplicateEntryValue = matches ? matches[1] : null;
                    var duplicateEntryKey = matches ? matches[2] : null;
      
                    console.log("Duplicate Entry Value:", duplicateEntryValue);
                    console.log("Duplicate Entry Key:", duplicateEntryKey);
                    Swal.fire({
                        title: "Error",
                        text: "Cannot add agent\n 1: Complete all fields are required\n 2: Same ID check",
                        icon: 'error',
      
                    });
                    if (response.redirect_url) {
                        setTimeout(function() {
                            var redirectUrl = window.location.origin + '/' + response
                                .redirect_url;
                            window.location.href = redirectUrl;
                        }, 3000);
                    }
      
                }
            });
        });
        document.getElementById('pass_issue_date').addEventListener('change', function() {
            var issueDate = new Date(this.value);
            var expireDate = new Date(issueDate.getFullYear() + 10, issueDate.getMonth(), issueDate.getDate());
            var formattedExpireDate = formatDate(expireDate);
            console.log(formattedExpireDate);
            document.getElementById('pass_expire_date').value = formattedExpireDate;
        });
      
        function formatDate(date) {
            date.setDate(date.getDate() - 1); // Subtract 1 day from the date
      
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
      
            return year + '-' + month + '-' + day;
        }
        document.addEventListener("DOMContentLoaded", function() {
    const candidateModalEl = document.getElementById("exampleModal");
    const agentModalEl = document.getElementById("agentModal");

    const candidateModal = new bootstrap.Modal(candidateModalEl);
    const agentModal = new bootstrap.Modal(agentModalEl);

    document.querySelector("[data-bs-target='#agentModal']").addEventListener("click", function(event) {
        event.preventDefault();

        // Close Candidate Modal before opening Agent Modal
        candidateModal.hide();

        // Wait until Candidate Modal is fully closed
        candidateModalEl.addEventListener("hidden.bs.modal", function() {
            agentModal.show();
        }, { once: true }); // Runs only once to prevent multiple triggers
    });

    // Remove any leftover backdrop when Agent Modal is closed
    agentModalEl.addEventListener("hidden.bs.modal", function() {
        
        document.querySelectorAll(".modal-backdrop").forEach(backdrop => backdrop.remove());
        location.reload();
    });
});
      </script>
      {{-- Index file script --}}


    

</body>

</html>
