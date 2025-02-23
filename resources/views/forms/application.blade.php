<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
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
</head>

<body class="flex">
    @include('layout.sidebar')
    <div class="flex-1 xl:ml-[280px]">
        @include('layout.navbar')

        


        <div class="container">
            <div class="d-flex max-w-[1050px] mx-auto mt-2 bg-gray-200 rounded-lg px-2 py-1 items-center"
                style="justify-content: space-between;">
                <div class="flex items-center gap-3">
                    <div>
                        <label for="pass" class="form-label">Select by passport number/Name</label>
                        <input list="candidates" name="candidate" id="candidate" class="form-control"
                            onchange="getdata()">
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

        <div id="printable-section">
            <div class="w-[90%] mx-auto">
                <div class=" pt-[160px] text-[10px] font-medium text-black leading-5 font-bangla" contenteditable="true"
                    ref={componentRef}>
                    <p>
                        বরাবর,
                        <br />
                        মহা-পরিচালক <br />
                        জনশক্তি, কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো,
                        <br />
                        ৮৯/২ কাকরাইল, ঢাকা-১০০০।
                        <br />
                        <strong class="underline">দৃষ্টি আকর্ষনঃ</strong> উপপরিচালক (বহির্গমন)
                        <br />
                        <span class="underline pb-40">
                            বিষয়: সৌদিআরবগামী
                            <span class='text-[16px]' id="footer_Dynamic_count"></span>
                            জন পুরুষ/মহিলা কর্মীর একক বহির্গমন ছাড়পত্র প্রদানের জন্য আবেদন।
                        </span>
                    </p>
                    <p class=" text-[10px] text-black font-medium">
                        জনাব, <br />
                        বিনীত নিবেদন এই যে,

                        আমার রিক্রুটিং এজেন্সী <span class="">{{ $user->rl_name_bangla }}</span> (আর এল-
                        <span class=""> {{ $user->rl_no_bangla }} </span>
                        ) কর্তৃক সৌদিআরব গমনেচ্ছু
                        <span id="counting"></span>
                        জন কর্মীর ওকালাকৃত হওয়ার এবং কর্মীগনের ভিসা ও চুক্তিপত্র সঠিক থাকায় প্রয়োজনীয় অন্যান্য
                        ডকুমেন্টসহ
                        বহির্গমন ছাড়পত্রের জন্য দাখিল করলাম। উল্লেখ্য যে, ভিসাগুলো একক ভিসা এবং তা ২৫ এর অধিক নয় ও
                        কর্মীদের
                        সকল দায়-দায়িত্ব রিক্রুটিং এজেন্সী কর্তৃক বহন করা হবে।
                        <br />
                        অতএব মহোদয়ের সমীপে বিনীত আরজ সৌদিআরব গমনচ্ছেু
                        <span class='text-[16px]' id="footer_Dynamic_count2">

                        </span>
                        জন পুরুস/মহিলা কর্মীর অনূকুলে একক
                        বহির্গমন ছাড়পত্র প্রদানের বিষয়ে সদয় মর্জি হয়।
                        <br />


                    </p>
                    <p class="text-md leading-1"> সংযুক্তি:</p>

                    <div class="flex mb-5" style="display:flex">
                        <div class="w-2/3 ">
                            <ul class='text-[10px]'>
                                <li>ক) পুট-আপ লিস্ট- পতাকা 'খ'</li>
                                <li>খ) কল্যান ও বীমা ফি এবং স্মার্টকার্ড ফি বাবদ প্রাপ্ত পে-অর্ডারের ফটোকপি- পতাকা 'গ'।
                                </li>
                                <li>গ)রিক্রুটিং এজেন্সী কর্তৃক ৩০০/- টাকার নন-জুডিসিয়াল স্ট্যাম্পে অঙ্গিকারনামা-পতাকা
                                    'ঘ'।
                                </li>
                                <li>ঘ) চুক্তিপত্রের ফটোকপি-পতাকা 'চ'</li>
                                <li>ঙ) প্রশিক্ষন পতাকা-'ছ'।</li>

                                <li>চ) কর্মীর ডাটাশীট 'জ'।</li>
                            </ul>
                        </div>
                        <div class="w-1/3 ">
                            <ul class="flex flex-col text-[12px] gap-y-2">
                                <li>
                                    রিক্রুটিং এজেন্সির নামঃ
                                    <span class="">
                                        {{ $user->rl_name_bangla }} - {{ $user->rl_no_bangla }}
                                    </span>
                                </li>
                                <li>মালিকের নামঃ- {{ $user->owner_name_bangla }} </li>
                                <li>মোবাইল নম্বরঃ {{ $user->phone }}</li>
                                <li class="">মালিকের স্বাক্ষর ও সীলঃ</li>


                            </ul>
                        </div>

                    </div>
                    <div class="w-1/2 px-8">
                        <ul class="flex flex-col gap-y-1">
                            <li>
                                প্রতিনিধির নামঃ
                                {{ $user->embassy_man_name }}
                            </li>
                            <li>মোবাইল নং- {{ $user->embassy_man_phone }} </li>

                        </ul>
                    </div>
                    <div class="overflow-x-auto mb-4">
                        <table class="w-full text-[8px] border-collapse border border-black" id="application_table">
                            <thead>
                                <tr class="">
                                    <th class="border border-black px-4  text-center w-[100px]">ক্রঃ নং</th>
                                    <th class="border border-black px-4  text-center">কর্মীর নাম</th>
                                    <th class="border border-black px-4  text-center">পাসপোর্ট নম্বর</th>
                                    <th colspan="2" class="border border-black px-4  text-center">ভিসা ও আইডি নম্বর
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        @include('layout.script')


        <script>
            function toBengaliNumber(number) {
                const bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                return number.replace(/[0-9]/g, (digit) => bengaliDigits[digit]);
            }

            function getTodayInBengali() {
                const today = new Date();

                // Format the date as DD-MM-YYYY
                const day = String(today.getDate()).padStart(2, '0');
                const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const year = String(today.getFullYear());

                const formattedDate = `${day}-${month}-${year}`;

                // Convert to Bengali numbers
                return toBengaliNumber(formattedDate);
            }



            // Get today's date in English format
            const todayInBengali = getTodayInBengali();
        </script>


        <script>
            function updateTotalCount() {
                var totalRows = rowsData.length + cancelRowsData.length;
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
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        }),
                        fetch(manpowerRoute, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                    ])
                    .then(responses => Promise.all(responses.map(response => response.json())))
                    .then(data => {
                        // Handle the data from both responses
                        const embassyData = data[0];
                        const manpowerData = data[1];

                        // Merge the two objects
                        const mergedData = {
                            ...embassyData[0],
                            ...manpowerData[0]
                        };

                        console.log(mergedData);
                        // Add merged data to the table
                        addRowToTable(mergedData);

                        dynamicBanglaCount();
                        // Clear the input field
                        document.getElementById('candidate').value = null;

                        // Update total count or any other UI updates
                        updateTotalCount();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            function getCanceldata() {
                var id = document.getElementById('cancelInput').value;

                fetch('/user/embassy/' + id, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        addRowToTable(data[0], true); // Pass true to highlight row
                        document.getElementById('cancelInput').value = null;
                        updateTotalCount();
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }


            function addRowToTable(data, highlight = false) {
                var tbody = document.getElementById('application_table');
                var tr = document.createElement('tr');
                tr.classList.add('[&>td]:border', '[&>td]:border-black', '[&>td]:py-0', 'text-[9px]', 'text-center', 'relative',
                    'group');

                // Create the table cells
                var td1 = document.createElement('td'); // ক্র/নং
                var td2 = document.createElement('td'); // কর্মীর নাম
                var td3 = document.createElement('td'); // পাসপোর্ট নম্বর
                var td4 = document.createElement('td'); // পাসপোর্ট নম্বর
                var td5 = document.createElement('td'); // পাসপোর্ট নম্বর

                // Populate the cells with data
                td1.innerHTML = sl; // Serial number
                td1.setAttribute('contentEditable', 'true'); // Allow editing for serial number
                sl++;

                td2.innerHTML = (data.name || ''); // Worker name
                td2.classList.add('uppercase'); // Add uppercase styling

                td3.innerHTML = data.passport_number || ''; // Passport number
                td4.innerHTML = data.visa_no || ''; // Passport number
                td5.innerHTML = data.spon_id || ''; // Passport number
                td3.classList.add('uppercase'); // Add uppercase styling


                // Append the cells to the row
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);


                // Append the row to the table body
                tbody.appendChild(tr);
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


            // Function to convert English numbers to Bangla numbers
            function englishToBanglaNumber(number) {
                const banglaNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                return number.toString().split('').map(digit => banglaNumbers[parseInt(digit)]).join('');
            }

            // Function to dynamically update the Bangla count
            function dynamicBanglaCount() {
                const countElement = document.getElementById('counting'); // Element where the count is shown
                const countElement2 = document.getElementById('footer_Dynamic_count'); // Element where the count is shown
                const countElement3 = document.getElementById('footer_Dynamic_count2'); // Element where the count is shown
                if (!countElement) return; // Exit if element not found

                // Extract the current number (in Bangla) from the element
                const currentCountText = countElement.innerText.split(' ')[0]; // Get the numeric part
                const banglaNumbersMap = {
                    '০': 0,
                    '১': 1,
                    '২': 2,
                    '৩': 3,
                    '৪': 4,
                    '৫': 5,
                    '৬': 6,
                    '৭': 7,
                    '৮': 8,
                    '৯': 9
                };
                const currentCount = parseInt(currentCountText.split('').map(banglaDigit => banglaNumbersMap[banglaDigit]).join(
                    ''), 10) || 0;

                // Increment the count
                const newCount = currentCount + 1;

                // Convert the incremented count back to Bangla
                const newBanglaCount = englishToBanglaNumber(newCount);

                // Update the text content with the new count
                countElement.innerHTML = `${newBanglaCount} (${banglaNumberToWord(newCount)})`; // Example: ৩ (তিন)
                countElement2.innerHTML = `${newBanglaCount} (${banglaNumberToWord(newCount)})`; // Example: ৩ (তিন)
                countElement3.innerHTML = `${newBanglaCount} (${banglaNumberToWord(newCount)})`; // Example: ৩ (তিন)
            }


            function banglaNumberToWord(number) {
                const banglaWords = [
                    'শূন্য', 'এক', 'দুই', 'তিন', 'চার', 'পাঁচ', 'ছয়', 'সাত', 'আট', 'নয়', 'দশ',
                    'এগারো', 'বারো', 'তেরো', 'চৌদ্দ', 'পনেরো', 'ষোলো', 'সতেরো', 'আঠারো', 'উনিশ', 'বিশ',
                    'একুশ', 'বাইশ', 'তেইশ', 'চব্বিশ', 'পঁচিশ', 'ছাব্বিশ', 'সাতাশ', 'আঠাশ', 'ঊনত্রিশ', 'ত্রিশ',
                    'একত্রিশ', 'বত্রিশ', 'তেত্রিশ', 'চৌত্রিশ', 'পঁইত্রিশ', 'ছত্রিশ', 'সাইত্রিশ', 'আটত্রিশ', 'ঊনচল্লিশ',
                    'চল্লিশ',
                    'একচল্লিশ', 'বিয়াল্লিশ', 'তেতাল্লিশ', 'চুয়াল্লিশ', 'পঁইতাল্লিশ', 'ছেচল্লিশ', 'সাতচল্লিশ', 'আটচল্লিশ',
                    'ঊনপঞ্চাশ', 'পঞ্চাশ',
                    'একান্ন', 'বায়ান্ন', 'তিপ্পান্ন', 'চুয়ান্ন', 'পঁইচান্ন', 'ছাপ্পান্ন', 'সাতান্ন', 'আটান্ন', 'ঊনষাট',
                    'ষাট',
                    'একষট্টি', 'বাষট্টি', 'তেষট্টি', 'চৌষট্টি', 'পঁইষট্টি', 'ছেষট্টি', 'সাতষট্টি', 'আটষট্টি', 'ঊনসত্তর',
                    'সত্তর',
                    'একাত্তর', 'বাহাত্তর', 'তিয়াত্তর', 'চুয়াত্তর', 'পঁইচাত্তর', 'ছিয়াত্তর', 'সাতাত্তর', 'আটাত্তর',
                    'ঊনআশি', 'আশি',
                    'একাশি', 'বিরাশি', 'তিরাশি', 'চুরাশি', 'পঁইচাশি', 'ছিয়াশি', 'সাতাশি', 'আটাশি', 'ঊননব্বই', 'নব্বই',
                    'একানব্বই', 'বিরানব্বই', 'তিরানব্বই', 'চুরানব্বই', 'পঁইচানব্বই', 'ছিয়ানব্বই', 'সাতানব্বই', 'আটানব্বই',
                    'নিরানব্বই', 'একশো'
                ];

                return number >= 0 && number <= 100 ? banglaWords[number] : number;
            }
        </script>

    </div>
</body>

</html>
