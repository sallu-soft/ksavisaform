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
    <div id="rightbar" class="flex-1 ml-[200px] md:ml-[240px] xl:ml-[280px]">
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
        <div class="modal fade" id="agentViewModal" tabindex="-1" aria-labelledby="agentViewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-[#275E8B]">
                        <h5 class="modal-title text-white" id="agentViewModalLabel">Agent Details</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
                        <button type="button" class="bg-[#074f56] p-3 rounded text-white font-semibold"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive rounded-lg bg-[#DFE8EF]  my-5 w-[98%] xl:w-[97%] mx-auto shadow-lg main-datatable">
            <form action="{{ route('user/index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, ID, passport..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
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
                                    <br /><strong>Agent : </strong><a href="#" class="view-agent-btn"
                                        data-bs-toggle="modal" data-agent-id="{{ $candidate->id }}">
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
        
        <div class="modal fade" id="viewAgentModal" tabindex="-1" aria-labelledby="viewAgentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewAgentModalLabel">Agent Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="agentDetails">

                    </div>
                </div>
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




        </script>




</body>

</html>
