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
    <div class="d-flex  mx-auto mt-2 bg-gray-200 rounded-lg px-2 py-1 items-center"
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

  <div class="w-[100%] mx-auto" id="printable-section">
    <div class=" bg-white  pb-0" contentEditable="true">
        <div class="h-[1260px] pt-[360px] relative">
          <p class="text-center text-lg px-7 underline font-bangla">
            নিম্নলিখিত সৌদিআরবগামী <span id="counting"></span> জন কর্মী প্রেরণ সংক্রান্ত
            রিক্রুটিং এজেন্সী {{$user->rl_name_bangla}} (আর এল- {{$user->rl_no_bangla}}) এর
            অঙ্গীকারনামা।
          </p>

          <table class="w-full my-2" id="stemp_table">
            <thead>
              <tr class="[&>td]:border [&>td]:border-black font-bangla [&>td]:py-1 text-[12px] text-center">
                <td>ক্র/নং</td>
                <td>কর্মীর নাম</td>
                <td>পাসপোর্ট নম্বর</td>
                <td>ভিসা নম্বর</td>
                <td>নিয়োগকারীর নাম</td>
                <td>পদের নাম</td>
  
                <td>অভিবাসন ব্যয়</td>
              </tr>
            </thead>
            <tbody>
            
            </tbody>
          </table>
  
          {{-- <p class="text-[12px] text-justify w-[95%] pl-7 leading-5 font-bangla ">
            আমি {{ $user->rl_name_bangla }} (আরএল-{{ $user->rl_no_bangla }})
            স্বত্ত্বাধিকারী/ব্যবস্থাপনা অংশীদার /ব্যবস্থাপনা পরিচালক এই মর্মে
            অঙ্গীকার করছি যে, চাকুরীর উদ্দেশ্যে সৌদিআরব গামী দেশের বিভিন্ন
            নিয়োগকর্তার অধীনে বর্ণিত <span id="footer_Dynamic_count"></span> জন কর্মীর একক বহির্গমন ছাড়পত্র
            গ্রহণের নিমিত্তে কর্মীদের ভিসা, চুক্তিপত্রসহ অন্যান্য প্রয়োজনীয়
            কাগজপত্রাদি দাখিল করলাম, যা সঠিক আছে।
          </p> --}}
         
        </div>
        <div class="text-[16px] flex pt-[360px] leading-9 h-[1260px] relative">
            <div>
          <h3 class="text-center text-xl">পাতা নং - ২</h3>
          <br />
          {{-- <p class="text-justify px-7">
            উপর্যুক্ত কর্মীদের সৌদিআরব বিমানবন্দরে নিয়োগকর্তা বা নিয়োগ কর্তার
            প্রতিনিধি গ্রহণ করবেন এবং বর্ণিত কর্মীগণকে সৌদিআরবগামী দেশে প্রেরণর
            জন্য বহির্গমন ছাড়পত্র গ্রহনের পর উক্ত দেশ ব্যতিত অন্য কোনো দেশে প্রেরন
            করবনা মর্মে অঙ্গীকার করছি। আমি আরও অঙ্গীকার করছি যে, উপযুক্ত কর্মীদের
            ভিসা,নিয়োগপত্র এবং চুক্তিপত্র সঠিক আছে। বিদেশ গমণের পর কোন কারণে
            কর্মীদের বিমানবন্দর হতে নিয়োগকর্তা গ্রহণ না করে অথবা কর্মীদের ভিসা জাল
            বলে প্রমাণিত হয় অথবা অন্য কোনকারণে চাকুরীতে সমস্যার সৃষ্টি হয় তাহলে
            উক্ত কর্মীর/কর্মীদের সকল দায়- দায়িত্ব আমি বা আমার রিক্রুটিং এজেন্সী
            বহন করতে বাধ্য থাকব।
          </p> --}}
          <p class="text-justify px-7">
            আমি রিক্রুটিং এজেন্সি {{ $user->rl_name_bangla }} (আরএল-{{ $user->rl_no_bangla }})-এর স্বত্বাধিকারী এই মর্মে অঙ্গীকার করছি যে,চারকুরীর উদ্দেশ্যে সৌদি আরব দেশের  <span id="counting"></span> নিয়োগকর্তার অধীনে বর্ণিত  <span id="counting"></span> জন কর্মীর ভিসা প্রসেসিংসহ জনশক্তি,কর্মসংসস্থান ও প্রশিক্ষণ ব্যুরো হতে একক বহির্গমন ছাড়পত্র গ্রহণের নিমিত্তে বিদেশগামী কর্মীর নিকট হতে প্রয়োজনীয় কাগজ-পত্র বুঝে পেয়েছি,যাহা সঠিক আছে মর্মে প্রতীয়মান হয়েছে। উল্লিখিত ভিসাগুলোর মধ্যে বিভিন্ন নিয়োগকর্তার অধীনে ২৫ জনের অধিক কর্মী প্রেরণ করা হচ্ছে না অথবা ভিসাগুলো গ্রুপ ভিসা নয়।

উল্লিখিত কর্মীদের সৌদি আরব বিমানবন্দরে নিয়োগকর্তা বা নিয়োগকর্তার প্রতিনিধির গ্রহণ করবেন এবং কর্মীদের সৌদি আরব দেশে প্রেরণের জন্য বহির্গমন ছাড়পত্র গ্রহণের পর উক্ত দেশ ব্যতীত অন্য কোন দেশে প্রেরণের অপ্রচেষ্টা করব না এই মর্মে অঙ্গীকার করছি।


            
          </p>
          {{-- <h3 class="text-center text-xl absolute bottom-2 right-7">
            চলমান পাতা - ৩
          </h3> --}}
        </div>
        </div>
        <div class="text-[16px] flex pt-[360px] leading-9 h-[1260px] relative">
            <div>
          <h3 class="text-center text-xl">পাতা নং - ৩</h3>
          
          <p class="text-[14px] leading-8 ">
            আমি আরও অঙ্গীকার করছি যে, উপযুক্ত কর্মীদের ভিসা নিয়োগপত্র,
             চুক্তি পত্র সঠিক আছে। কর্মীগন বিদেশে যাওয়ার পর সংশ্লিস্ট নিয়োগকর্তার 
             অধীনে নির্ধারিত পেশায় চাকুরী প্রদানের নিশ্চয়তা প্রদান করছি এবং কর্মীগন
              বিদেশে যাওয়ার পর চুক্তিপত্র অনুযায়ী বেতন ভাতাদি এবং অন্যান্য সুযোগ-সুবিধা
               প্রাপ্য না হলে তার সকল দায়-দায়িত্ব বহন করব এবং কর্মীদের যাবতীয় ক্ষতিপুরন
                দিতে বাধ্য থাকব। আরও অঙ্গীকার করছি যে, কর্মীদের নিকট হতে সরকার
                 কর্তৃক নির্ধারিত অভিবাসন ব্যায়ের বেশি ব্যয় গ্রহন করা হয়নি। 
                 <br/>
                 আমি আরও অঙ্গীকার করছি যে, নথিতে উপস্থাপিত Employment Contract paper অনলাইন এ 
                 পেয়েছি। Employment Contract paper এর কোন শর্ত লঙ্ঘীত হলে এবং সে কারনে কর্মী কোন
                 ধরনের সমস্যার সম্মুখীন হলে তার সমস্ত দায়-দায়িত্ব আমি বহন করিব বা উদ্ভুত সমস্যা আমি নিজে সমাধান করিব। 
                 মন্ত্রণালয়ের নির্দেশ মোতাবেক অনলাইন মোতাবেক অনলাইন হইতে প্রাপ্ত এনজাজ ভিসা ওকালা এবং নিয়োগকর্তা ও কর্মীর মধ্যে সম্পাদিত চুক্তিপত্র দাখিল করিলাম।
                 <br/>
                 প্রশাসনিক মন্ত্রনালয়ের পত্র নং- ৭০৭ তারিখে ২২/১২/২৪ খ্রিঃ জারিকৃত মোতাবেক নিষিদ্ধ ঘোষত প্রতিস্টানে/কোম্পানিতে কর্মী প্রেরন করা হচ্ছে না এবং 
                 নোটশিটে উল্লেখিত কোম্পানির মধ্যে  <span id="counting"></span> টি নিষিদ্ধ কোম্পানি নেই। এছাড়া সংযুক্ত কর্মীদের ইস্যুকৃত
                 ভিসাসমুহ গত ২২/০৬১৪৪৬ হিজরি তারিখের পূর্বে। যদি কোনো সমস্যা হয় তাহলে আমি সমস্ত দায়-দায়িত্ব বহন করব। 
                 <br/>
            উপর্যুক্ত অঙ্গীকার নামায় বর্ণিত বিষয়ের কোন ব্যত্যয় ঘটলে প্রবাসীকল্যাণ
            ও বৈদেশিক কর্মসংস্থান মন্ত্রণালয় অথবা জনশক্তি কর্মসংস্থান ও
            প্রশিক্ষণব্যুরো আমার বা আমার রিক্রুটিংএজেন্সীর বিরুদ্ধে
            <span class="font-semibold">
              
              বৈদেশিক কর্মসংসস্থান ও অভিবাসী আইন-২০১৩
            </span>
            অনুযায়ী যে কোনব্যবস্থা গ্রহণ করতে পারবে।এই অঙ্গীকারনামা আমি সেচ্ছায়, স্বজ্ঞানে, সুস্থ্য মস্তিস্কে এবং
            কাহারো দ্বারা প্ররোচিত না হয়ে স্বাক্ষর করলাম।
          </p>
          <div class="flex flex-end justify-end mr-10">
            <p class="text-start px-10 text-lg pt-[1rem] font-bangla leading-10">
                রিক্রুটিং এজেন্সীর নাম : {{ $user->rl_name_bangla }}
                <br />
                মালিকের নাম : {{ $user->owner_name_bangla }}
                <br />
                <span class="">মালিকের স্বাক্ষর ও সীল :</span>
                <br />
                <span class="text-start  text-lg pt-[2rem] font-bangla leading-7">
                    তারিখ: <span id="bengali-date"></span>
                </span>
            </p>
            
          </div>
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

        // Set the Bengali date to the span
        document.getElementById('bengali-date').innerText = todayInBengali;
    </script>


    <script>

  
          
        
          
          var sl = 1;
          var rowsData = [];
        

        // function getdata() {
        //     var id = document.getElementById('candidate').value;

        //     // Define the routes to fetch
        //     const embassyRoute = '/user/embassy/' + id;
        //     const manpowerRoute = '/user/manpower/' + id;

        //     // Fetch both routes concurrently
        //     Promise.all([
        //         fetch(embassyRoute, {
        //             method: 'GET',
        //             headers: { 'Content-Type': 'application/json' }
        //         }),
        //         fetch(manpowerRoute, {
        //             method: 'GET',
        //             headers: { 'Content-Type': 'application/json' }
        //         })
        //     ])
        //     .then(responses => Promise.all(responses.map(response => response.json())))
        //     .then(data => {
        //         // Handle the data from both responses
        //         const embassyData = data[0];
        //         const manpowerData = data[1];

        //         // Merge the two objects
        //         const mergedData = { ...embassyData[0], ...manpowerData[0] };

        //         console.log(mergedData);
        //         // Add merged data to the table
        //         addRowToTable(mergedData);

        //         dynamicBanglaCount();
        //         // Clear the input field
        //         document.getElementById('candidate').value = '';

        //         // Update total count or any other UI updates
        //         updateTotalCount();
        //     })
        //     .catch(error => {
        //         console.error('Error fetching data:', error);
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

                  

                    // Add merged data to the table
                    dynamicBanglaCount();
                    addRowToTable(mergedData);
                 
                    // Clear the input field
                    document.getElementById('candidate').value = '';

                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
          
        
        function addRowToTable(data, highlight = false) {
            var tbody = document.getElementById('stemp_table');
            var tr = document.createElement('tr');
            tr.classList.add('[&>td]:border', '[&>td]:border-black', '[&>td]:py-', 'text-[10px]', 'text-center', 'relative', 'group');

            // Create the table cells
            var td1 = document.createElement('td'); // ক্র/নং
            var td2 = document.createElement('td'); // কর্মীর নাম
            var td3 = document.createElement('td'); // পাসপোর্ট নম্বর
            var td4 = document.createElement('td'); // ভিসা নম্বর
            var td5 = document.createElement('td'); // নিয়োগকারীর নাম
            var td6 = document.createElement('td'); // পদের নাম
            var td7 = document.createElement('td'); // অভিবাসন ব্যয়

            // Populate the cells with data
            td1.innerHTML = sl; // Serial number
            td1.setAttribute('contentEditable', 'true'); // Allow editing for serial number
            sl++;

            td2.innerHTML = (data.name || ''); // Worker name
            td2.classList.add('uppercase'); // Add uppercase styling

            td3.innerHTML = data.passport_number || ''; // Passport number
            td3.classList.add('uppercase'); // Add uppercase styling

            td4.innerHTML = data.visa_no || ''; // Visa number

            td5.innerHTML = data.company_name || ''; // Employer name
            td5.classList.add('uppercase'); // Add uppercase styling
            td5.classList.add('text-[8px]');
            td6.innerHTML = data.prof_name_english || ''; // Job position
            td6.classList.add('text-[8px]');
            td6.classList.add('uppercase'); // Add uppercase styling

            // Create an editable field for অভিবাসন ব্যয়
            td7.setAttribute('contentEditable', 'true');
            td7.innerHTML = data.migration_cost || '1,65,000'; // Default migration cost (if available)

            // Append the cells to the row
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            tr.appendChild(td6);
            tr.appendChild(td7);

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
        // function englishToBanglaNumber(number) {
        //     const banglaNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        //     return number.toString().split('').map(digit => banglaNumbers[parseInt(digit)]).join('');
        // }

        // // Function to dynamically update the Bangla count
        // function dynamicBanglaCount() {
        //     const countElement = document.getElementById('counting'); // Element where the count is shown
        //     const countElement2 = document.getElementById('footer_Dynamic_count'); // Element where the count is shown
        //     if (!countElement) return; // Exit if element not found

        //     // Extract the current number (in Bangla) from the element
        //     const currentCountText = countElement.innerText.split(' ')[0]; // Get the numeric part
        //     const banglaNumbersMap = { '০': 0, '১': 1, '২': 2, '৩': 3, '৪': 4, '৫': 5, '৬': 6, '৭': 7, '৮': 8, '৯': 9 };
        //     const currentCount = parseInt(currentCountText.split('').map(banglaDigit => banglaNumbersMap[banglaDigit]).join(''), 10) || 0;

        //     // Increment the count
        //     const newCount = currentCount + 1;

        //     // Convert the incremented count back to Bangla
        //     const newBanglaCount = englishToBanglaNumber(newCount);

        //     // Update the text content with the new count
        //     countElement.innerHTML = `${newBanglaCount} (${banglaNumberToWord(newCount)})`; // Example: ৩ (তিন)
        //     countElement2.innerHTML = `${newBanglaCount} (${banglaNumberToWord(newCount)})`; // Example: ৩ (তিন)
        // }

        // // Helper function to convert numbers to Bangla words
        // function banglaNumberToWord(number) {
        //     const banglaWords = ['শূন্য', 'এক', 'দুই', 'তিন', 'চার', 'পাঁচ', 'ছয়', 'সাত', 'আট', 'নয়', 'দশ'];
        //     if (number <= 10) return banglaWords[number];
        //     // Add logic for larger numbers if necessary
        //     return banglaWords[number % 10]; // For simplicity, just mapping the last digit
        // }
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

  
    </script>




</body>
</html>