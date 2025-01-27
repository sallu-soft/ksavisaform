<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body>
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
    <div class="d-flex max-w-[1050px] mx-auto mt-2 bg-gray-200 rounded-lg px-2 py-1 items-center"
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
            @foreach ($candidates as $candidate)
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
    <div class="bg-white p-6" contentEditable="true" id="dynamic-table">
        <span class="font-bangla text-center border-b-2 flex justify-center pb-1 px-3 text-sm font-semibold">
          একক বহির্গমন ছাড়পত্রের পুটআপসীট ও ডাটাএন্ট্রি ফরম
        </span>
        <table class="w-full border-collapse" id="copy-table">
            <thead>
                <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py-1 text-sm">
                    <td class="w-[20%] pl-3 font-bangla font-semibold">
                        নিয়োগকারী দেশের নামঃ
                    </td>
                    <td class="w-[20%] pl-3 text-center font-bold">সৌদি আরব</td>
                    <td class="w-[8%] pl-3">আর এল নং</td>
                    <td class="w-[15%] text-center" colspan="1">
                        ভিসার ধরন
                    </td>
                    <td class="w-[19%] text-sm pl-3 text-[17px] font-semibold">
                        উৎস আয়করের পরিমান জন প্রতিঃ
                    </td>
                    <td class="w-[18%] text-center text-[17px] font-semibold">
                        ৫০০/-
                    </td>
                </tr>
                <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py-0 text-sm">
                    <td class="w-[20%] pl-3 font-bold" rowspan="2">
                        রিক্রুটিং এজেন্সীর নামঃ
                    </td>
                    <td class="w-[20%] font-semibold text-center text-[16px]" rowspan="2">
                        সাল্লু এয়ার সার্ভিসেস
                    </td>
                    <td class="w-[8%] font-bold text-lg text-center" rowspan="3">
                        ১২১
                    </td>
                    <td class="w-[8%] text-center text-[17px] font-bold" rowspan="3">
                        সত্যায়িত
                    </td>
                    <td class="w-[19%] text-sm pl-3 text-[17px] font-semibold">
                        কল্যান ফি পরিমান জনপ্রতিঃ
                    </td>
                    <td class="w-[18%] pl-3 text-center text-[17px] font-bold">
                        ৪৫০০/-
                    </td>
                </tr>
                <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py-1 text-sm">
                    <td class="w-[19%] text-sm pl-3 text-[17px] font-semibold">
                        স্মার্ট কার্ড ফি
                    </td>
                    <td class="w-[18%] text-center text-[17px] font-bold">২৫০/-</td>
                </tr>
                <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py- text-sm">
                    <td class="w-[20%] pl-3 py-1 font-bold text-[14px]">
                        টাকা জমার পারমিট নং
                    </td>
                    <td></td>
                    <td class="w-[19%] text-sm pl-3 text-[14px] font-semibold">
                        তারিখ
                    </td>
                    <td class="w-[18%] text-center text-[14px] font-bold">
                        11/12/2000
                    </td>
                </tr>
            </thead>
        </table>

        
      

        {{-- <table id="horizontalTable" class="text-sm w-full border-t-0 horizontalTable">
          <thead>
            
          </thead>
          
          <tbody>
              <tr>
                  <td className="text-[10px]">Employee No.</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Worker SI No.</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Company Name</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Employee Name</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Job Post</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Salary</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Reg ID</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Visa No.</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Visa Issue</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Visa Expire</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Passport No.</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Passport Issue</td>

              </tr>
              <tr>
                  <td className="text-[10px]">Passport Expire</td>
              </tr>
              <tr>
                  <td className="text-[10px]">Date of Birth</td>
              </tr>
          </tbody>
          
        </table> --}}
        <div id="tableContainer">
            
          <table id="horizontalTable1" class="text-sm w-full border-t-0 horizontalTable">
            <thead>
                <tr>
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
                    <td class="text-[10px]">Employee No.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Worker SI No.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Company Name</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Employee Name</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Job Post</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Salary</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Reg ID</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Visa No.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Visa Issue</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Visa Expire</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Passport No.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Passport Issue</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Passport Expire</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-[10px]">Date of Birth</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
          </table>
          <div id="footerpartforallpage">
          
            
            <div class="py-1 text-[14px]  leading-6 font-bangla">
              বর্ণিত কর্মী গ্রুপ ভিসা অন্তর্ভুক্ত নয় । কর্মীদের
              পাসপোর্ট,ভিসা,চাকুরী,চুক্তিপত্রের বর্নিত বেতন ও শর্তাদি সঠিক আছে। উক্ত
              বিষয়ে ত্রুটির কারনে কর্মীদের কোনো প্রকার সমস্যা হইলে আমার এজেন্সী 
              <span class="font-semibold">
                {{$user->licence_name}} (আর এল- {{$user->rl_no}})
              </span> 
              সম্পূর্ন দায় দায়িত্বগ্রহন ও কর্মীদের ক্ষতিপূরন দিতে বাধ্য থাকিবে।
            </div>
            <table class=" w-full">
              <tr
                class="
                 [&>td]:border [&>td]:border-black font-bangla [&>td]:pl-3 text-sm  pl-2
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
      
            <div class="text-[16px] w-full !flex justify-around my-5">
              <div class="flex flex-col items-center font-bangla text-sm text-center gap-x-14">
                <p>এজেন্সী মালিক/প্রতিনিধির সাক্ষর</p>
                <p></p>
              </div>
              <div class="flex gap-y-14 flex-col items-center font-bangla text-sm text-center gap-y-14">
                <p className="">পরিক্ষিত হয়েছে কাগজপত্র সঠিক আছে/নাই</p>
                <p>সহকারীর স্বাক্ষর</p>
              </div>
              <div class="flex flex-col items-center font-bangla text-sm text-center gap-y-14">
                <p>বর্নীত তথ্যাদি সঠিক আছে/নাই</p>
                <p>সহকারী পরিচালকের স্বাক্ষর</p>
              </div>
              <div class="flex flex-col items-center font-bangla text-sm text-center gap-y-14">
                <p>বহির্গমনের ছাড়পত্র দেয়া যায়/যায় না</p>
                <p>উপ-পরিচালকের স্বাক্ষর</p>
              </div>
              <div class="flex flex-col items-center font-bangla text-sm text-center gap-y-14">
                <p>বহির্গমনের ছাড়পত্র দেয়া যায়/যায় না</p>
                <p>পরিচালকের স্বাক্ষর</p>
              </div>
            </div>
          </div>
        </div>

        
      
      <br>
      


    </div>
  </div>
  @include('layout.script')
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

            const newTable = document.createElement("table");
            newTable.id = `horizontalTable${index}`;
            newTable.className = "text-sm w-full border-t-0 horizontalTable";

            const thead = document.createElement("thead");
            const headerRow = document.createElement("tr");

            const attributesHeader = document.createElement("th");
            attributesHeader.textContent = "";
            headerRow.appendChild(attributesHeader);

            // Create the header for 8 columns
            for (let i = 1; i <= 8; i++) {
                const th = document.createElement("th");
                th.textContent = `${i}`;
                headerRow.appendChild(th);
            }

            thead.appendChild(headerRow);
            newTable.appendChild(thead);

            const tbody = document.createElement("tbody");

            // Dynamically copy rows from the initial table for consistency
            const initialTable = document.getElementById("horizontalTable1");
            const initialRows = initialTable.querySelectorAll("tbody tr");

            initialRows.forEach((initialRow) => {
                const newRow = document.createElement("tr");
                const rowLabelCell = document.createElement("td");

                rowLabelCell.textContent = initialRow.cells[0]?.textContent.trim(); // Copy the row label
                newRow.appendChild(rowLabelCell);

                // Add empty cells for the new table (8 columns)
                for (let i = 1; i <= 8; i++) {
                    const td = document.createElement("td");
                    newRow.appendChild(td);
                }

                tbody.appendChild(newRow);
            });

            newTable.appendChild(tbody);
            tableContainer.appendChild(newTable);

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

            // Trigger print
            window.print();

            // Restore all elements to their original display state
            for (let i = 0; i < bodyElements.length; i++) {
                bodyElements[i].style.display = '';
            }
        }
  </script>