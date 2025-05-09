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
        <div class="d-flex mx-auto mt-2 bg-gray-200 rounded-lg px-2 py-1 items-center"
            style="justify-content: space-between;">
            <div class="flex items-center gap-3">
                <div>
                    <label for="pass" class="form-label">Select by passport number/Name</label>
                    <input list="candidates" name="candidate" id="candidate" class="form-control" onchange="getdata()">
                    {{-- <input list="candidates" name="cancelInput" id="cancelInput" class="form-control hidden"
                    onchange="getCanceldata()"> --}}
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

    <div class="mt-5" id="printable-section">
        <div class="">
            <div class="p-[50px] pl-[50px] w-full bg-white mb-10 text-[12px] " contentEditable="true">
                <p class=" font-bangla  text-[13px]">
                    <span contentEditable="true">।</span> রিক্রুটিং এজেন্সী
                    {{ $user->rl_name_bangla }} ({{ $user->rl_no_bangla }}) এর ব্যবস্থাপনা
                    পরিচালক সৌদিআরব গামি <span id='counting'></span> জন
                    পুরুষ/মহিলা কর্মীর অনুকুলে একক বহির্গমন ছাড়পত্র
                    গ্রহনের জন্য আবেদনপত্রসহ নিম্নে বর্ণিত কাগজপত্রাদি দাখিল করেছেন।
                </p>
                <ol class=" text-[12px] leading-5 font-bangla">
                    <li class="">
                        ক) রিক্রুটিং এজেন্সী আবেদনপত্র (পতাকা &quot;ক&quot;)
                    </li>
                    <li class="">
                        খ) আয়কর চালান, কল্যান, ও বীমা ফি এবং স্মার্টকার্ড ফি বাবদ প্রাপ্ত
                        পে-অর্ডারের ফটোকপি (পতাকা &quot;খ&quot;)
                    </li>
                    <li class="">গ)কর্মীর পুটআপ লিস্ট (পতাকা &quot;গ&quot;)</li>
                    <li class="">
                        ঘ) রিক্রুটিং এজেন্সী কর্তৃক দাখিলকৃত ৩০০/- টাকার নন-জুডিশিয়াল
                        স্টাম্পে অঙ্গিকারনামা (পতাকা &quot;ঘ&quot;)
                    </li>
                    <li class="">
                        ঙ) কর্মীর পাসপোর্ট ফটোকপি এবং স্ট্যাফিংকৃত ভিসার ফটোকপি (পতাকা
                        &quot;ঙ&quot;)
                    </li>
                    <li class="">চ) ইনজাজ কপি (পতাকা &quot;চ&quot;)</li>
                    <li class="">ছ) চুক্তিপত্রের ফটোকপি (পতাকা &quot;ছ&quot;)</li>

                    <li class="">জ) কর্মীর প্রশিক্ষণ সনদ। (পতাকা &quot;ঝ&quot;)</li>
                    <li class="">
                        ঝ) কর্মীর ডাটা এন্ট্রি শিট। (পতাকা &quot;ঞ&quot;)
                    </li>
                    <li class="">
                        ঞ) ড্রাইভিং লাইসেন্স সংযুক্ত। (পতাকা &quot;ট&quot;)
                    </li>
                </ol>
                <h1 class="text-[14px] font-semibold font-bangla">
                    <span contentEditable="true">।</span> কর্মীর বিবরণঃ
                </h1>
                <table class="w-full ">
                    <thead>
                        <tr
                            class="[&>td]:border [&>td]:border-black [&>td]:py-1  text-[11px] font-semibold text-center font-bangla">
                            <td>ক্র/নং</td>
                            <td>কর্মীর নাম</td>
                            <td>পাসপোর্ট নম্বর</td>
                            <td>ভিসা/আইডি নম্বর</td>

                            <td>নিয়োগকারীর নাম</td>
                            <td>পেশা</td>
                        </tr>
                    </thead>
                    <tbody id="first_table_notesheet">

                    </tbody>
                </table>
                <h1 class="text-[14px] font-semibold pb- font-bangla mt-2">
                    <span contentEditable="true">।</span> প্রশিক্ষণ সনদের বিবরণঃ-
                </h1>
                <table class="w-full ">
                    <thead>
                        <tr
                            class="[&>td]:border [&>td]:border-black [&>td]:py-1 text-[12px] font-semibold text-center font-bangla">
                            <td>ক্র/নং</td>
                            <td>কর্মীর নাম</td>
                            <td>পাসপোর্ট নম্বর</td>
                            <td>সনদ নং</td>
                            <td>ব্যাংকের নাম ও আকাউন্ট নং</td>
                            <td>মেডিকেল সেন্টার</td>
                            <td>টিটিসির নাম</td>
                        </tr>
                    </thead>
                    <tbody id="second_table_notesheet">

                    </tbody>
                </table>
                <h1 class="text-[14px] font-semibold pb-1 font-bangla mt-2">
                    <span contentEditable="true">।</span>আয়কর চালান, কল্যান ও বীমা ফি এবং
                    স্মার্টকার্ড এর বিবরনীঃ-
                </h1>

                <table class="w-full ">
                    <thead>
                        <tr class="[&>td]:border [&>td]:border-black [&>td]:py-1 text-[12px] font-bangla text-center">
                            <td>ফি সমূহ</td>
                            <td>জন প্রতি হার</td>
                            <td>কর্মীর সংখ্যা</td>
                            <td>মোট টাকা</td>
                            <td>পে অর্ডার নম্বর</td>
                            <td>তারিখ</td>
                            <td>ব্যাংকের নাম ও শাখা</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="[&>td]:border [&>td]:border-black [&>td]:p- text-[12px] text-center relative group">
                            <td>কল্যান ও বীমা ফি</td>
                            <td>
                                <p>(৩৫০০+১০০০)= ৪৫০০</p>
                            </td>
                            <td rowspan='3'>
                                <p id="candidate_no">

                                </p>
                            </td>
                            <td>
                                <!-- {toBengaliNumber(passengers?.length * 4500)} -->
                                4500
                            </td>
                            <td>0</td>
                            <td class="" rowspan='3'>
                                <p contentEditable="true">
                                    12/30/2020
                                </p>
                            </td>
                            <td class="">ইসলামী ব্যাংক লিঃ, ভি. আই. পি. রোড, ঢাকা।</td>
                        </tr>
                        <tr class="[&>td]:border [&>td]:border-black [&>td]:p- text-[12px] text-center relative group">
                            <td>স্মার্ট কার্ড ফি</td>
                            <td>
                                <p>২৫০/--</p>
                            </td>
                            <!-- {/* <td rowspan='4'>
              <p>12</p>
            </td> */} -->
                            <td>250</td>
                            <td>0</td>
                            <!-- {/* <td class="text-end">
              <p contentEditable="true">
                তাং-১২/১২/২০২৩
              </p>
            </td> */} -->
                            <td class="">ইসলামী ব্যাংক লিঃ, ভি. আই. পি. রোড, ঢাকা।</td>
                        </tr>
                        <tr
                            class="[&>td]:border [&>td]:border-black [&>td]:py-1 text-[12px] text-center relative group">
                            <td>আয়কর চালান</td>
                            <td>৫০০/--</td>

                            <td>500</td>
                            <td contentEditable="true">0</td>

                            <td class="">ইসলামী ব্যাংক লিঃ, ভি. আই. পি. রোড, ঢাকা।</td>
                        </tr>
                    </tbody>
                </table>
                <h1 class="text-sm font-semibold font-bangla mt-2">
                    <span contentEditable="true">।</span>.ভিসার সঠিকতা, ধরন, পেশা, নিষিদ্ধ
                    কোম্পানীর ভিসা ও এনজাজ কপির
                    <span class="font-sans"> Advice/Lot</span> এ ভিসার সংখ্যা ২৪ এর
                    অধিক ভিসা আছে কি না এ বিষয়ে মতামতের জন্য অনুবাদক শাখায় প্রেরন করা হলো।
                </h1>
                <div class="text-center w-[1100px] mt-[20px] font-semibold text-md font-bangla">
                    <p>অনুবাদক</p>
                </div>
            </div>
        </div>
    </div>
    @include('layout.script')
    <script>
        // function updateTotalCount() {
        //     var totalRows = rowsData.length + cancelRowsData.length;
        //     document.getElementById('totalCancel').innerHTML = totalRows;
        // }

        // function updateTable() {
        //     updateTableIndexes();
        //     updateTotalCount();
        // }

        var sl = 1;
        var rowsData = [];

        // function getdata() {
        //     var id = document.getElementById('candidate').value;

        //     fetch('/user/embassy/' + id, {
        //             method: 'GET',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             // console.log(data);
        //             addRowToTable(data[0]);
        //             document.getElementById('candidate').value = null;
        //             updateTotalCount();
        //         })
        //         .catch(error => {
        //             console.error(error);
        //     });
        // }

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
                .then(responses => {
                    // Check for response errors
                    if (!responses.every(response => response.ok)) {
                        throw new Error('One or more fetch requests failed');
                    }
                    return Promise.all(responses.map(response => response.json()));
                })
                .then(data => {
                    // Handle the data from both responses
                    const embassyData = data[0];
                    const manpowerData = data[1];

                    // Merge the two objects
                    const mergedData = {
                        ...embassyData[0],
                        ...manpowerData[0]
                    };

                    dynamicBanglaCount();
                    // Add merged data to the table
                    addRowToTable(mergedData);
                    // Clear the input field
                    document.getElementById('candidate').value = '';

                    // Update total count or any other UI updates
                    updateTotalCount();
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }


        
        function getTotalRows() {
            var tbody = document.getElementById('first_table_notesheet'); // Get the table body by its ID
            var rows = tbody.getElementsByTagName('tr'); // Get all rows (tr elements) in the table body
            return rows.length; // Return the total number of rows
        }

        function addRowToTable(data, highlight = false) {
            var tbody = document.getElementById('first_table_notesheet');
            var candidate_no = document.getElementById('candidate_no');
            var totalRows = getTotalRows();
            candidate_no.innerHTML = totalRows + 1;
            var tr = document.createElement('tr');
            tr.classList.add('[&>td]:border', '[&>td]:border-black', '[&>td]:py-', 'text-[11px]', 'text-center', 'relative',
                'group');

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            var td4 = document.createElement('td');
            var td5 = document.createElement('td');
            var td6 = document.createElement('td');

            td1.innerHTML = sl;
            td1.setAttribute('contentEditable', 'true');
            sl++;

            // Check if the properties exist before accessing them
            td2.innerHTML = (data.name || '') + '<br>' + (data.passenger_no || '');
            td3.innerHTML = data.passport_number || '';
            td4.innerHTML = (data.visa_no || '') + '<br>' + (data.spon_id || '');
            td5.innerHTML = data.spon_name_english || '';
            td6.innerHTML = data.prof_name_english || '';

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            tr.appendChild(td6);

            tbody.appendChild(tr);

            var tbody2 = document.getElementById('second_table_notesheet');
            var tr = document.createElement('tr');
            tr.classList.add('[&>td]:border', '[&>td]:border-black', '[&>td]:py-', 'text-[11px]', 'text-center', 'relative',
                'group');

            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            var td4 = document.createElement('td');
            var td5 = document.createElement('td');
            var td6 = document.createElement('td');
            var td7 = document.createElement('td');

            td1.innerHTML = sl - 1;
            td1.setAttribute('contentEditable', 'true');


            // Check if the properties exist before accessing them
            td2.innerHTML = (data.name || '');
            td3.innerHTML = data.passport_number || '';
            td4.innerHTML = data.certificate_no || '';
            td5.innerHTML = (data.bank_name || '') + '<br>' + (data.bank_acc_no || '');
            td6.innerHTML = data.medical_center || '';
            td7.innerHTML = data.ffc_name || '';




            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            tr.appendChild(td6);
            tr.appendChild(td7);

            tbody2.appendChild(tr);

            // var totalAmount = 0;
            // data.forEach(row => {
            //     if (row.amount) {
            //         totalAmount += parseFloat(row.amount);  // Summing up the amount field
            //     }
            // });
            // candidate_no.innerHTML = totalAmount;

        }
        function englishToBanglaNumber(number) {
            const banglaNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return number.toString().split('').map(digit => banglaNumbers[parseInt(digit)]).join('');
        }

        // Function to dynamically update the Bangla count
        function dynamicBanglaCount() {
            const countElement = document.getElementById('counting'); // Element where the count is shown
            // const countElement2 = document.getElementById('footer_Dynamic_count');  shown
            // const countElement3 = document.getElementById('footer_Dynamic_count2'); 
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
            // countElement2.innerHTML = `${newBanglaCount} (${banglaNumberToWord(newCount)})`; // Example: ৩ (তিন)
            // countElement3.innerHTML = `${newBanglaCount} (${banglaNumberToWord(newCount)})`; // Example: ৩ (তিন)
        }

       
        function banglaNumberToWord(number) {
    const banglaWords = [
        'শূন্য', 'এক', 'দুই', 'তিন', 'চার', 'পাঁচ', 'ছয়', 'সাত', 'আট', 'নয়', 'দশ',
        'এগারো', 'বারো', 'তেরো', 'চৌদ্দ', 'পনেরো', 'ষোলো', 'সতেরো', 'আঠারো', 'উনিশ', 'বিশ',
        'একুশ', 'বাইশ', 'তেইশ', 'চব্বিশ', 'পঁচিশ', 'ছাব্বিশ', 'সাতাশ', 'আঠাশ', 'ঊনত্রিশ', 'ত্রিশ',
        'একত্রিশ', 'বত্রিশ', 'তেত্রিশ', 'চৌত্রিশ', 'পঁইত্রিশ', 'ছত্রিশ', 'সাইত্রিশ', 'আটত্রিশ', 'ঊনচল্লিশ', 'চল্লিশ',
        'একচল্লিশ', 'বিয়াল্লিশ', 'তেতাল্লিশ', 'চুয়াল্লিশ', 'পঁইতাল্লিশ', 'ছেচল্লিশ', 'সাতচল্লিশ', 'আটচল্লিশ', 'ঊনপঞ্চাশ', 'পঞ্চাশ',
        'একান্ন', 'বায়ান্ন', 'তিপ্পান্ন', 'চুয়ান্ন', 'পঁইচান্ন', 'ছাপ্পান্ন', 'সাতান্ন', 'আটান্ন', 'ঊনষাট', 'ষাট',
        'একষট্টি', 'বাষট্টি', 'তেষট্টি', 'চৌষট্টি', 'পঁইষট্টি', 'ছেষট্টি', 'সাতষট্টি', 'আটষট্টি', 'ঊনসত্তর', 'সত্তর',
        'একাত্তর', 'বাহাত্তর', 'তিয়াত্তর', 'চুয়াত্তর', 'পঁইচাত্তর', 'ছিয়াত্তর', 'সাতাত্তর', 'আটাত্তর', 'ঊনআশি', 'আশি',
        'একাশি', 'বিরাশি', 'তিরাশি', 'চুরাশি', 'পঁইচাশি', 'ছিয়াশি', 'সাতাশি', 'আটাশি', 'ঊননব্বই', 'নব্বই',
        'একানব্বই', 'বিরানব্বই', 'তিরানব্বই', 'চুরানব্বই', 'পঁইচানব্বই', 'ছিয়ানব্বই', 'সাতানব্বই', 'আটানব্বই', 'নিরানব্বই', 'একশো'
    ];

    return number >= 0 && number <= 100 ? banglaWords[number] : number;
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
</body>

</html>
