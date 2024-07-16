<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Embassy List | KSA Form Print Solution</title>
    <style>
    
    </style>
     
    @include('layout.head')
   
</head>
<body>
    @include("layout.navbar")
    <div class="container  ">
        
        <div class="d-flex max-w-[1050px] mx-auto mt-2 bg-gray-200 rounded-lg px-2 py-1 items-center" style="justify-content: space-between;">
            <div class="flex items-center gap-3">
                <div>
                <label for="pass" class="form-label">Select by passport number/Name</label>
                <input list="candidates" name="candidate" id="candidate" class="form-control" onchange="getdata()">
                <input list="candidates" name="cancelInput" id="cancelInput" class="form-control hidden" onchange="getCanceldata()">
                </div><div class="text-xl font-bold">
                      <input type="radio" id="New" name="emb_list" value="New" onchange="toggleInputBox()" checked/>
                      <label for="New">New</label>
                      <input type="radio" id="Cancel" name="emb_list" value="Cancel" onchange="toggleInputBox()"/>
                      <label for="Cancel">Cancelletion</label>
                      </div>
            </div>
           
            
            <datalist id="candidates">
                @foreach($candidates as $candidate)
                    <option value="{{ $candidate->candidate_id }}">
                        <b class="text-danger">Passport no: {{ $candidate->passport_number }},</b>
                        Candidate Name: {{ $candidate->name }}
                    </option>
                @endforeach
            </datalist>  

           
            <button class="btn btn-primary" onclick="printtable()">Print</button>
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
                       {{Session::get('arabic_name')}} 
                    </span>
                    <span>: اسم مقدم الجوازات</span>
                </h3>
                <h3 class="flex justify-between">
                    <span></span>
                    <span>: الــتـــوقـيـــع</span>
                </h3>
            </div>
        </div>
       
        <table class="w-full table-bordered" id="embassy_list">
            <thead>
                <tr class=" [&>th]:border [&>th]:border-black [&>th]:py- text-md font-semibold text-center [&>th]:font-bold">
                  
                           
                            <th>
                                <p>المهنة</p>
                                <p>Profession</p>
                            </th>
                            <th class="w-[90px]">
                                <p>التاريخ</p>
                                <p>Year</p>
                            </th>
                            <th class="w-[140px]">
                                <p>رقم التأشيرة</p>
                                <p>Visa Number</p>
                            </th>
                            <th>
                                <p>اسم الكفيل</p>
                                <p>Sponsor Name</p>
                            </th>
                            <th class="w-[140px]">
                                <p>أرقام الجوازات</p>
                                <p>Passport No.</p>
                            </th>
                            <th>
                                <p>ت</p>
                                <p>SL</p>
                            </th>
                            
                </tr>
            </thead >
            <thead>
                <tr class=" [&>th]:border [&>th]:border-black [&>th]:py-0 text-md font-semibold text-center [&>th]:font-bold">
                  
                           
                    <th colspan="6" class="border border-black"> جديد / New</th>
                    
        </tr>
            </thead >
            
            <tbody id="table_body">
                
                
            </tbody>
            {{-- <tbody>
                <tr class="[&>td]:border [&>td]:border-black [&>td]:p-0 text-lg text-center relative group">
                    
                    <td colspan="5" class="font-bold text-xl text-end px-5" id="total">
                     
                    </td>
                    <td>المجموع</td>
                </tr>
            </tbody> --}}
            <thead id="cancel_head" class="">
                <tr class=" [&>th]:border [&>th]:border-black [&>th]:py-0 text-md font-semibold text-center [&>th]:font-bold">
                  
                           
                            <th colspan="6" class="border border-black">إلغاء / Cancelation</th>
                            
                </tr>
            </thead >
           
            <tbody id="table_cancel_body">
               
                
            </tbody>
            <tfoot>
                <tr class="[&>td]:border [&>td]:border-black [&>td]:p-0 text-lg text-center relative group">
                    
                    <td colspan="5" contentEditable class="font-bold text-xl text-end px-5" id="totalCancel">
                     
                    </td>
                    <td>المجموع</td>
                </tr>
            </tfoot>
        </table>
        
        <div style="display: flex; flex-wrap: wrap; justify-content: center; font-size: 1rem; font-weight: bold; text-align: center; padding: 0;">
            <div style="flex-basis: 50%; flex-grow: 1;">: الختم</div>
            <div style="flex-basis: 50%; flex-grow: 1;">: المستلم</div>
            <div style="flex-basis: 50%; flex-grow: 1;">: التعبئة</div>
            <div style="flex-basis: 50%; flex-grow: 1;">: المدقق</div>
            <div style="flex-basis: 50%; flex-grow: 1;">: التسجيل</div>
            <div style="flex-basis: 50%; flex-grow: 1;">: المسئول</div>
        </div>
          
    </div>
 
    @include('layout.script')
    <script type="text/javascript">
   
        function toggleInputBox() {
    const radioSelection = document.querySelector('input[name="emb_list"]:checked').value;
    const inputNew = document.getElementById('candidate');
    const inputCancel = document.getElementById('cancelInput');

    if (radioSelection === 'New') {
        inputNew.style.display = 'block';
        inputCancel.style.display = 'none';
     
        // document.getElementById('candidate').setAttribute('onchange', 'getdata()');
    } else if (radioSelection === 'Cancel') {
        inputNew.style.display = 'none';
        inputCancel.style.display = 'block';
       
        // document.getElementById('candidate').setAttribute('onchange', 'getCanceldata()');
    } else {
        // Handle the default case if needed
        inputNew.style.display = 'block';
        inputCancel.style.display = 'none';
    }
}


        var sl = 1;
        var sl_cancel = 1
        function getdata(){
            var id = document.getElementById('candidate').value;
            
            fetch('/user/embassy/' + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
           // Parse the response as JSON
            .then(data => {
                var tbody = document.getElementById('table_body');
                var tr = document.createElement('tr');
        //         var tr2 = `<tr class="border border-black p-0 text-xl text-center relative group">
        //       <td>${sl}</td>
        //       <td>${data[0].prof_name_arabic}</td>
        //       <td>${data[0].visa_date2}</td>
        //       <td>${data[0].visa_no}</td>
        //       <td>${data[0].spon_name_arabic}</td>
        //       <td>${data[0].passport_number}</td>
        //   </tr>`;

                tr.classList.add('border', 'border-black', 'p-0', 'text-[13px]', 'text-center', 'relative', 'group');

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                var td4 = document.createElement('td');
                var td5 = document.createElement('td');
                var td6 = document.createElement('td');
                td1.setAttribute('contentEditable', 'true');
                td1.innerHTML = sl;
                sl++;
                td2.innerHTML = data[0].prof_name_arabic;
                td3.innerHTML = data[0].visa_date2.substr(0, 4);
                
                td3.setAttribute('contentEditable', 'true');

                td4.innerHTML = data[0].visa_no;
                td5.innerHTML = data[0].spon_name_arabic;
                td6.innerHTML = data[0].passport_number;
                
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td1);
                tbody.appendChild(tr);
                // tbody.appendChild(tr2);
                console.log(data);
                document.getElementById('candidate').value = null;
            })
            .catch(error => {
                // Handle any errors that occurred during the request
                // ...
            });
            document.getElementById('totalCancel').innerHTML = sl;
        }
        function getCanceldata(){
            var id = document.getElementById('cancelInput').value;
            
            fetch('/user/embassy/' + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
           // Parse the response as JSON
            .then(data => {
                // console.log(data[0].passport_number);
                var cancelShow = data[0].passport_number;
                var tbody = document.getElementById('table_cancel_body');
                var cancelTitle = document.getElementById('cancel_head');
                // if(cancelShow===null){
                //     console.log("true")
                //     cancelTitle.style.display = "none";
                // }else{
                //     console.log("false")
                //     cancelTitle.style.display = "block";
                // }
                var tr = document.createElement('tr');
             

                tr.classList.add('border', 'border-black', 'p-0', 'text-[13px]', 'text-center', 'relative', 'group');
                // tr2.classList.add('border', 'border-black', 'p-0', 'text-xl', 'text-center', 'relative', );



                // var tdc1 = document.createElement('td');
                // tdc1.innerHTML ="إلغاء" ;

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                var td4 = document.createElement('td');
                var td5 = document.createElement('td');
                var td6 = document.createElement('td');
                td1.innerHTML = sl;
                td1.setAttribute('contentEditable', 'true');
                sl++;
                td2.innerHTML = data[0].prof_name_arabic;
                td3.innerHTML = data[0].visa_date2.substr(0, 4);
                td4.innerHTML = data[0].visa_no;
                td5.innerHTML = data[0].spon_name_arabic;
                td6.innerHTML = data[0].passport_number;
                
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td1);
                // tr2.appendChild(tdc1);
                // tbody.appendChild(tr2);
                tbody.appendChild(tr);
                
                // tbody.appendChild(tr2);
                // console.log(data);
                document.getElementById('cancelInput').value = null;
            })
            .catch(error => {
                // Handle any errors that occurred during the request
                // ...
            });
            document.getElementById('totalCancel').innerHTML = sl;
            document.getElementById('totalCancel').setAttribute('contentEditable', 'true');
        }

        function printtable() {
            // Hide other elements on the page
            var elementsToHide = document.querySelectorAll('body > *:not(#printable)');
            // for (var i = 0; i < elementsToHide.length; i++) {
            //     elementsToHide[i].style.display = 'none';
            // }

            // Print the specific table
            var printContents = document.getElementById('printable').outerHTML;
            // var newWindow = window.open('', '_blank');
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            
            // Restore the original contents of the page
            document.body.innerHTML = originalContents;

            // Show the previously hidden elements
            for (var j = 0; j < elementsToHide.length; j++) {
                elementsToHide[j].style.display = '';
            }
        }
        const today = new Date();

// Get day, month, and year from the date object
const day = String(today.getDate()).padStart(2, '0');
const month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
const year = today.getFullYear();

// Format the date as "DD-MM-YYYY"
const formattedDate = `${day}/${month}/${year}`;

// Insert the formatted date into the HTML element with the "currentDate" ID
document.getElementById('currentDate').textContent = formattedDate;
    </script>
    <script>
        $(document).ready(function() {
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
                       
                        success: function (response) {
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
                            error: function (error) {
                            console.error("Error calling API:", error);
                        }
                    });
        }
        

        </script>

   
</body>
</html>