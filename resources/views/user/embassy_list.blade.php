<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Embassy List | KSA Form Print Solution</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

    <style>
        /* Custom CSS for the tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            /* Position the tooltip above the text */
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>

    @include('layout.head')

</head>

<body class="flex">
    
        @include('layout.sidebar')
    <div id="rightbar" class="flex-1 ml-[200px] md:ml-[240px] xl:ml-[280px]">
        @include('layout.navbar')
        

            <div class="d-flex max-w-[1050px] mx-auto mt-2 bg-gray-200 rounded-lg px-2 py-1 items-center"
                style="justify-content: space-between;">
                <div class="flex items-center gap-3">
                    <div>
                        <label for="pass" class="form-label">Select by passport number/Name</label>
                        <input list="candidates" name="candidate" id="candidate" class="form-control"
                            style="display: block;" onchange="getdata()" />
                        <input list="candidates" name="cancelInput" id="cancelInput" class="form-control"
                            style="display: none;" onchange="getCanceldata()" />
                    </div>
                    <div class="text-xl font-bold">
                        <input type="radio" id="New" name="emb_list" value="New" onchange="toggleInputBox()"
                            checked />
                        <label for="New">New</label>
                        <input type="radio" id="Cancel" name="emb_list" value="Cancel"
                            onchange="toggleInputBox()" />
                        <label for="Cancel">Cancellation</label>
                    </div>
                </div>


                <datalist id="candidates">
                    @foreach ($candidates as $candidate)
                        @if (!$candidate->visa_no)
                            @continue
                        @endif
                        <option data-id="{{ $candidate->id }}">
                            Serial no: {{ $candidate->sl_number ?? $candidate->serial_number }},
                            Passport no: {{ $candidate->passport_number }},
                            Candidate Name: {{ $candidate->name }}
                        </option>
                    @endforeach
                </datalist>



                <button class="btn btn-primary mr-2" onclick="printtable()">Print</button>
                <button class="btn btn-primary" id="saveAndPrintBtn">Save & Print</button>
            </div>

            <div class="bg-white space-y-2 pt-[15px] max-w-[1050px] container-fluid" id="printable">
                <h2 class="text-center text-2xl font-medium">
                    بيان بالجوازات المقدمة
                </h2>

                <div class="flex text-lg pt-[30px]">
                    <div class="flex-1 space-y-1">
                        <h3 class="flex">
                            <span class="font-semibold text-lg w-[130px]">
                                {{ Session::get('rl_no') }}

                            </span>
                            <span>:رقم الرخصة</span>
                        </h3>
                        <h3 class="flex">
                            <span contentEditable class="font-semibold text-lg w-[130px] " id="currentDate">

                            </span>
                            <span>: التاريخ</span>
                        </h3>
                    </div>
                    <div class="flex-2">
                        <h3 class="flex items-center justify-end gap-5">
                            <span class="font-semibold mr-14 text-2xl">
                                {{-- {{ $agency_name?.arabic }} --}}
                                {{ Session::get('arabic_name') }}
                            </span>
                            <span>: اسم مقدم الجوازات</span>
                        </h3>
                        <h3 class="flex justify-between">
                            <span></span>
                            <span>: الــتـــوقـيـــع</span>
                        </h3>
                    </div>
                </div>

                <div id="candidateModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50"
                    style="display:none;">
                    <div
                        class="bg-white w-full max-w-md rounded-lg shadow-lg overflow-hidden transform transition-all duration-300">
                        <!-- Modal Header -->
                        <div class="px-6 py-4 bg-blue-500 text-white text-xl font-bold">
                            <h4>Select a Candidate</h4>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-4">
                            <label for="candidateSelect" class="block text-gray-700 font-semibold mb-2">Search by
                                Candidate
                                ID or Passport Number:</label>
                            <input list="candidateadd" id="candidateSelect" name="candidate"
                                placeholder="Type or select a candidate"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

                            <datalist id="candidateadd">
                                @foreach ($candidates as $candidate)
                                    @if ($candidate->visa_no != null)
                                        <option data-id="{{ $candidate->id }}">
                                            Serial No: {{ $candidate->sl_number ?? $candidate->serial_number }}
                                            Passport: {{ $candidate->passport_number }} -
                                            {{ $candidate->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </datalist>

                        </div>

                        <!-- Modal Footer -->
                        <div class="px-6 py-4 bg-gray-100 flex justify-end space-x-4">
                            <button onclick="closeModal()"
                                class="text-red-600 text-lg font-bold hover:text-red-800 transition duration-200">Cancel</button>
                            <button onclick="selectCandidate()"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Select</button>
                        </div>
                    </div>
                </div>

                <table class="w-full table-bordered" id="embassy_list">
                    <thead>
                        <tr
                            class=" [&>th]:border [&>th]:border-black [&>th]:py- text-md font-semibold text-center [&>th]:font-bold">


                            <th>
                                <p>المهنة</p>
                                <p>Profession</p>
                            </th>
                            <th class="w-[65px]">
                                <p>التاريخ</p>
                                <p>Year</p>
                            </th>
                            <th class="w-[120px]">
                                <p>رقم التأشيرة</p>
                                <p>Visa Number</p>
                            </th>
                            <th>
                                <p>اسم الكفيل</p>
                                <p>Sponsor Name</p>
                            </th>
                            <th class="w-[120px]">
                                <p>أرقام الجوازات</p>
                                <p>Passport No.</p>
                            </th>
                            <th class="w-[20px]">
                                <p>ت</p>
                                <p>SL</p>
                            </th>
                            <th id="hide">
                                <p>Options</p>
                            </th>

                        </tr>
                    </thead>
                    <thead>
                        <tr
                            class=" [&>th]:border [&>th]:border-black [&>th]:py-0 text-md font-semibold text-center [&>th]:font-bold">


                            <th colspan="7" class="border border-black"> جديد / New</th>

                        </tr>
                    </thead>

                    <tbody id="table_body">


                    </tbody>

                    <thead id="cancel_head" class="">
                        <tr
                            class=" [&>th]:border [&>th]:border-black [&>th]:py-0 text-md font-semibold text-center [&>th]:font-bold">


                            <th colspan="7" contenteditable="true" class="border border-black">إلغاء / Cancelation
                            </th>

                        </tr>
                    </thead>

                    <tbody id="table_cancel_body">


                    </tbody>
                    <tbody>
                        <tr class="[&>td]:border [&>td]:border-black text-lg text-center relative group">

                            <td colspan="5" contentEditable class="font-bold text-xl text-end pr-5 "
                                id="totalCancel">

                            </td>
                            <td>المجموع</td>

                        </tr>
                    </tbody>
                </table>

                <div
                    style="display: flex; flex-wrap: wrap; justify-content: center; font-size: 1rem; font-weight: bold; text-align: center; padding: 0;">
                    <div style="flex-basis: 50%; flex-grow: 1;">: الختم</div>
                    <div style="flex-basis: 50%; flex-grow: 1;">: المستلم</div>
                    <div style="flex-basis: 50%; flex-grow: 1;">: التعبئة</div>
                    <div style="flex-basis: 50%; flex-grow: 1;">: المدقق</div>
                    <div style="flex-basis: 50%; flex-grow: 1;">: التسجيل</div>
                    <div style="flex-basis: 50%; flex-grow: 1;">: المسئول</div>
                </div>

            </div>
    </div>
            @include('layout.script')
            

</body>

</html>
