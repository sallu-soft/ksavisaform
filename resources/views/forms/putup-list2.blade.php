<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body class="flex">
    {{-- @include('layout.sidebar') --}}
    <div class="flex-1 xl:ml-[280px]">
  @include('layout.navbar')
  <style>
    @font-face {
      font-family: arbFont;
      src: url("path/to/font-file.woff");
    }
    @font-face {
      font-family: "Times New Roman", Times, serif;
      src: url("../asset/css/times new roman.ttf");
    }
    .print {
      font-family: "Times New Roman", Times, serif;
    }
    .arb {
      font-family: arb Arial, sans-serif;
    }
    @media print {
      .noPrint {
        display: none;
      }
    }
  </style>
  <style>
    .horizontalTable {
      border-collapse: collapse; /* Ensures border lines are not doubled */
      width: 100%; /* Optional: Adjust the table width */
    }
  
    .horizontalTable th,
    .horizontalTable td {
      border: 1px solid black; /* Adds a solid border to table cells */
      padding: 8px; /* Optional: Adds spacing inside cells */
      text-align: left; /* Optional: Aligns text to the left */
    }
  
    .horizontalTable th {
      background-color: #f2f2f2; /* Optional: Adds a light gray background to header cells */
    }
  </style>
  
  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <!-- tailwind css cdn -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      important: true,
      theme: {
        extend: {
          colors: {
            clifford: "#da373d",
          },
          backgroundImage: {
            "hero-pattern": "url('/asset/image/hero1.jpg')",
          },
        },
      },
    };
  </script>

<div class="container">
    <div class="d-flex max-w-full mx-auto mt-2 bg-gray-200 rounded-lg px-2 py-1 items-center"
        style="justify-content: space-between;">
        <div class="flex items-center gap-3">
            <div>
                <label for="pass" class="form-label">Select by passport number/Name</label>
                <input list="candidates" name="candidate" id="candidate" class="form-control" onchange="getdata()">
                <input list="candidates" name="cancelInput" id="cancelInput" class="form-control hidden"
                    onchange="getCanceldata()">
            </div>
          
        </div>


        <datalist id="candidates">
            @foreach ($candidates_manpower as $candidate)
                <option value="{{ $candidate->candidate_id }}">
                    <b class="text-danger">Passport no: {{ $candidate->passport_number }},</b>
                    Candidate Name: {{ $candidate->name }}
                </option>
            @endforeach
        </datalist>


        <button class="btn btn-primary" onclick="printtable()">Print</button>
    </div>
</div>

  <div class="container" id="printable-section">
    <div class="bg-white " contentEditable="true" id="dynamic-table">
      

        <div id="tableContainer" class=' h-[800px] pt-10'>
            <span class="font-bangla text-center border-b-2 mt-5 pb-3 flex justify-center pb-1 px-3 text-sm font-semibold" id="intro-line">
                একক বহির্গমন ছাড়পত্রের পুটআপসীট ও ডাটাএন্ট্রি ফরম
            </span>
      
            
            <table class="w-full border-collapse" id="copy-table">
                <thead>
                    <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py-1 text-[12px]">
                        <td class="w-[20%] pl-3 font-bangla font-semibold">
                            নিয়োগকারী দেশের নামঃ
                        </td>
                        <td class="w-[20%] pl-3 text-center font-bold">সৌদি আরব</td>
                        <td class="w-[8%] pl-3">আর এল নং</td>
                        <td class="w-[15%] text-center" colspan="1">
                            ভিসার ধরন
                        </td>
                        <td class="w-[19%] text-[12] pl-3 text-[12px] font-semibold">
                            উৎস আয়করের পরিমান জন প্রতিঃ
                        </td>
                        <td class="w-[18%] text-center text-[12px] font-semibold">
                            ৫০০/-
                        </td>
                    </tr>
                    <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py-0 text-[12px]">
                        <td class="w-[20%] pl-3 font-bold" rowspan="2">
                            রিক্রুটিং এজেন্সীর নামঃ
                        </td>
                        <td class="w-[20%] font-semibold text-center text-[12px]" rowspan="2">
                            {{$user->rl_name_bangla}}
                        </td>
                        <td class="w-[8%] font-bold text-[12px] text-center" rowspan="3">
                            {{$user->rl_no_bangla}}
                        </td>
                        <td class="w-[8%] text-center text-[12px] font-bold" rowspan="3">
                            সত্যায়িত
                        </td>
                        <td class="w-[19%] text-[12px] pl-3 text-[12px] font-semibold">
                            কল্যান ফি পরিমান জনপ্রতিঃ
                        </td>
                        <td class="w-[18%] pl-3 text-center text-[12px] font-bold">
                            ৪৫০০/-
                        </td>
                    </tr>
                    <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py-1 text-[12px]">
                        <td class="w-[19%] text-[12px] pl-3 font-semibold">
                            স্মার্ট কার্ড ফি
                        </td>
                        <td class="w-[18%] text-center text-[12px] font-bold">২৫০/-</td>
                    </tr>
                    <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py- text-[12px]">
                        <td class="w-[20%] pl-3 py-1 font-bold text-[14px]">
                            টাকা জমার পারমিট নং
                        </td>
                        <td></td>
                        <td class="w-[19%] text-[12px] pl-3 text-[12px] font-semibold">
                            তারিখ
                        </td>
                        <td class="w-[18%] text-center text-[12px] font-bold">
                            <script>
                                const today = new Date();
                                const formattedDate = `${today.getDate()}/${today.getMonth() + 1}/${today.getFullYear()}`;
                                document.write(formattedDate);
                            </script>
                        </td>
                    </tr>
                </thead>
            </table>
            
            <table id="horizontalTable1" class="text-sm w-full horizontalTable">
                <thead>
                    <tr class="hidden">
                        <th></th>
                        <th>01</th>
                        <th>02</th>
                        <th>03</th>
                        <th>04</th>
                        <th>05</th>
                        <th>06</th>
                        <th>07</th>
                        <th>08</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Employee No.</td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                        <td class="py-0 text-center w-[11.5%]"></td>
                    </tr>
                   
                    <tr>
                        <td class="text-[10px] py-1 w-[7%]">Company Name</td>
                        <td class="text-[12px] text-center text-black font-bangla py-0 w-[11.5%]"></td>
                        <td class="text-[12px] text-black text-center font-bangla py-0 w-[11.5%]"></td>
                        <td class="text-[12px] text-black text-center font-bangla py-0 w-[11.5%]"></td>
                        <td class="text-[12px] text-black text-center font-bangla py-0 w-[11.5%]"></td>
                        <td class="text-[12px] text-black text-center font-bangla py-0 w-[11.5%]"></td>
                        <td class="text-[12px] text-black text-center font-bangla py-0 w-[11.5%]"></td>
                        <td class="text-[12px] text-black text-center font-bangla py-0 w-[11.5%]"></td>
                        <td class="text-[12px] text-black text-center font-bangla py-0 w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-1 w-[7%]">Employee Name</td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Job Post</td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[12px] text-center font-semibold p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Salary</td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center font-medium p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Reg ID</td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Visa No.</td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Visa Issue</td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Visa Expire</td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Passport No.</td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                        <td class="text-[16px] text-center font-bold p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Passport Issue</td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Passport Expire</td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                    </tr>

                    <tr>
                        <td class="text-[10px] py-0 w-[7%]">Date of Birth</td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                        <td class="text-[14px] text-center p-0 text-black w-[11.5%]"></td>
                    </tr>
                </tbody>
            </table>

            <div id="footerpartforallpage">
            
                
                <div class="py-1 text-[11.5px]  leading-6 font-bangla">
                বর্ণিত কর্মী গ্রুপ ভিসা অন্তর্ভুক্ত নয় । কর্মীদের
                পাসপোর্ট,ভিসা,চাকুরী,চুক্তিপত্রের বর্নিত বেতন ও শর্তাদি সঠিক আছে। উক্ত
                বিষয়ে ত্রুটির কারনে কর্মীদের কোনো প্রকার সমস্যা হইলে আমার এজেন্সী 
                <span class="font-semibold">
                    {{$user->rl_name_bangla}} (আর এল- {{$user->rl_no_bangla}} )
                </span> 
                সম্পূর্ন দায় দায়িত্বগ্রহন ও কর্মীদের ক্ষতিপূরন দিতে বাধ্য থাকিবে।
                </div>
                <table class="mt-2 w-full">
                <tr
                    class="
                    [&>td]:border [&>td]:border-black font-bangla [&>td]:pl-3 text-[11px]  pl-2
                    "
                >
                    <td>পে অর্ডার নং-</td>
                    <td>তাং-</td>
                    <td>টাকা-</td>
                    <td>চালান নং-</td>
                    <td>তাং-</td>
                    <td>টাকা-</td>
                </tr>
                </table>
        
                <div class="text-[12px] w-full !flex justify-around my-5">
                <div class="flex flex-col items-center font-bangla text-sm text-center gap-x-20">
                    <p>এজেন্সী মালিক/প্রতিনিধির সাক্ষর</p>
                    <p></p>
                </div>
                <div class="flex gap-y-16 flex-col items-center font-bangla text-[12px] text-center gap-y-20">
                    <p className="">পরিক্ষিত হয়েছে কাগজপত্র সঠিক আছে/নাই</p>
                    <p>সহকারীর স্বাক্ষর</p>
                </div>
                <div class="flex flex-col items-center font-bangla text-[12px] text-center gap-y-20">
                    <p>বর্নীত তথ্যাদি সঠিক আছে/নাই</p>
                    <p>সহকারী পরিচালকের স্বাক্ষর</p>
                </div>
                <div class="flex flex-col items-center font-bangla text-[12px] text-center gap-y-20">
                    <p>বহির্গমনের ছাড়পত্র দেয়া যায়/যায় না</p>
                    <p>উপ-পরিচালকের স্বাক্ষর</p>
                </div>
                <div class="flex flex-col items-center font-bangla text-[12px] text-center gap-y-20">
                    <p>বহির্গমনের ছাড়পত্র দেয়া যায়/যায় না</p>
                    <p>পরিচালকের স্বাক্ষর</p>
                </div>
                </div>
            </div>
        
            <br>
        
        </div>


    </div>
  </div>
  @include('layout.script')
</div>
  <script>

        
        function updateTotalCount() {
            var totalRows = rowsData.length;
            document.getElementById('totalCancel').innerHTML = totalRows;
        }

        function updateTable() {
            updateTableIndexes();
            updateTotalCount();
        }
        
        var sl = 1;
        var rowsData = [];

      
        function getdata() {
            var id = document.getElementById('candidate').value;

            // Define the routes to fetch
            const embassyRoute = '/user/embassy/' + id;
            const manpowerRoute = '/user/manpower/' + id;

            // Fetch both routes concurrently
            Promise.all([
                fetch(embassyRoute, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' }
                }),
                fetch(manpowerRoute, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' }
                })
            ])
            .then(responses => Promise.all(responses.map(response => response.json())))
            .then(data => {
                const embassyData = data[0];
                const manpowerData = data[1];

                const mergedData = { ...embassyData[0], ...manpowerData[0] };
                addColumnToTable(mergedData);

                // Clear the input field
                document.getElementById('candidate').value = null;

                // Update total count or any other UI updates
                // updateTotalCount();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }


       

        let columnCount = 1; // Tracks the current column index within the current table
        let tableIndex = 1; // Tracks the current table index
        let lastEmployeeNo = 1; // Tracks the last used Employee No.

        function addColumnToTable(mergedData) {
            const tableContainer = document.getElementById("tableContainer");

            // Check if the table exists, if not create it
            let table = document.getElementById(`horizontalTable${tableIndex}`);

            if (!table || columnCount > 8) {
                tableIndex++; // Move to next table
                columnCount = 1; // Reset column counter for the new table
                table = createNewTable(tableIndex); // Create a new table
            }

            const rows = table.rows;

            // Add data to the current table by filling the columns from left to right
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const rowLabel = row.cells[0]?.textContent.trim(); // First column is always the label
                const cell = row.cells[columnCount]; // Get the cell where the data should go
                
                if (rowLabel) {
                    const dataMapping = {
                        "Employee No.": "id",
                        "Worker SI No.": "certificate_no",
                        "Company Name": "company_name",
                        "Employee Name": "name",
                        "Job Post": "prof_name_english",
                        "Salary": "salary",
                        "Reg ID": "reg_id",
                        "Visa No.": "visa_no",
                        "Visa Issue": "visa_issued_date",
                        "Visa Expire": "visa_exp_date",
                        "Passport No.": "passport_number",
                        "Passport Issue": "passport_issue_date",
                        "Passport Expire": "passport_expire_date",
                        "Date of Birth": "date_of_birth"
                    };

                    const dataKey = dataMapping[rowLabel];
                    
                    // Check for Employee No. which auto increments
                    if (rowLabel === "Employee No.") {
                        cell.textContent = lastEmployeeNo; // Set Employee No. from lastEmployeeNo
                        lastEmployeeNo++; // Increment for the next Employee No.
                    } else if (dataKey && mergedData[dataKey] !== undefined) {
                        cell.textContent = mergedData[dataKey]; // Populate cell with data
                    } else {
                        cell.textContent = ""; // Default to empty if no data available
                    }
                }
            }

            columnCount++; // Increment the column count for the next data point

            // Once 8 columns are filled, a new table should be created
            if (columnCount > 8) {
                columnCount = 1; // Reset for the new table
                tableIndex++; // Move to the next table
            }
        }

        // Helper function to create a new table
       
        function createNewTable(index) {
            const tableContainer = document.getElementById("tableContainer");

            const div = document.createElement("div");
            div.className = "h-[800px] pt-10"; 
            const introLine = document.getElementById("intro-line");
            const clonedIntroLine = introLine.cloneNode(true); // Deep clone
            clonedIntroLine.id = `introLine${index}`;
            clonedIntroLine.classList.add = `intro-line`;
            div.appendChild(clonedIntroLine);


            // Step 2: Copy the existing table (Clone and append it)
            const copyTable = document.getElementById("copy-table");
            const clonedTable = copyTable.cloneNode(true); // Deep clone
            clonedTable.id = `copyTable${index}`;
            div.appendChild(clonedTable);

            // Step 3: Create a new empty table like the base table's structure
            const newTable = document.createElement("table");
            newTable.id = `horizontalTable${index}`;
            newTable.className = "text-[10px] w-full border-t-0 horizontalTable"; // Same classes as the base table

            // Get the header and body from the base table
            const baseTable = document.getElementById("horizontalTable1");
            const baseTableHeader = baseTable.querySelector("thead");
            const baseTableBody = baseTable.querySelector("tbody");

            // Step 3a: Clone header and append to new table
            const clonedHeader = baseTableHeader.cloneNode(true); // Clone the header with styles
            newTable.appendChild(clonedHeader);

            // Step 3b: Create an empty body (no data cells) and append to new table
            const emptyBody = document.createElement("tbody");

            // Clone the rows from the base table's body but empty out the data cells
            const baseRows = baseTableBody.querySelectorAll("tr");
            baseRows.forEach((row) => {
                const newRow = document.createElement("tr");
                newRow.className = row.className || "row-class"; // Copy row class or use default

                // Copy the first cell (row label) and leave the other cells empty
                const rowLabelCell = row.cells[0].cloneNode(true); // Copy label cell
                newRow.appendChild(rowLabelCell);

                // Add empty cells for the other columns (8 columns)
                for (let i = 1; i < row.cells.length; i++) {
                    const emptyCell = document.createElement("td");
                    emptyCell.className = row.cells[i]?.className || "data-cell-class"; // Keep the same class as the original
                    newRow.appendChild(emptyCell); // Empty cell without data
                }

                emptyBody.appendChild(newRow);
            });

            newTable.appendChild(emptyBody); // Append the empty body

            // Append the new table to the container
            div.appendChild(newTable);

            // Step 4: Add the footer part (Clone and append it)
            const footerPart = document.getElementById("footerpartforallpage");
            const clonedFooter = footerPart.cloneNode(true); // Deep clone
            clonedFooter.id = `footerPart${index}`;
            div.appendChild(clonedFooter);
            tableContainer.appendChild(div);
            return newTable;
        }

        
        function printtable() {
            // Save the original display style of the body
            const bodyElements = document.body.children;

            // Hide all elements except the printable section
            for (let i = 0; i < bodyElements.length; i++) {
                if (bodyElements[i].id !== 'printable-section') {
                    bodyElements[i].style.display = 'none';
                }
            }

            const style = document.createElement('style');
            style.innerHTML = `
                @page {
                    margin-top: 30mm; /* Adjust this value as needed */
                }

                @media print {
                    /* Add margin-top for elements that trigger a new page */
                    .intro-line {
                        page-break-before: always;
                        margin-top: 1rem; 
                    }
                }
            `;
            // Get all elements with the class 'intro-line' and add the 'mt-15' class
            const introLines = document.querySelectorAll('.intro-line');
            introLines.forEach((introLine) => {
                introLine.classList.add('mt-15'); // Add margin-top class
            });

            // Trigger print
            window.print();

            // Restore all elements to their original display state
            for (let i = 0; i < bodyElements.length; i++) {
                bodyElements[i].style.display = '';
            }
        }

       


  </script>