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
    bottom: 125%; /* Position the tooltip above the text */
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
{{-- @include('layout.navbar') --}}



<div class="bg-white space-y-2 pt-[15px] max-w-[1050px] container-fluid" id="printable_Area">
    <h2 class="text-center text-2xl font-medium">
        بيان بالجوازات المقدمة
    </h2>

    <div class="flex text-lg pt-[15px]">
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

    <table class="w-full table-bordered" id="embassy_list">
        <thead>
            <tr
                class=" [&>th]:border [&>th]:border-black [&>th]:py- text-md font-semibold text-center [&>th]:font-bold">


                <th>
                    <p>المهنة</p>
                    <p>Profession</p>
                </th>
                <th class="w-[60px]">
                    <p>التاريخ</p>
                    <p>Year</p>
                </th>
                <th class="w-[110px]">
                    <p>رقم التأشيرة</p>
                    <p>Visa Number</p>
                </th>
                <th>
                    <p>اسم الكفيل</p>
                    <p>Sponsor Name</p>
                </th>
                <th class="w-[110px]">
                    <p>أرقام الجوازات</p>
                    <p>Passport No.</p>
                </th>
                <th class="w-[15px]">
                    <p>ت</p>
                    <p>SL</p>
                </th>
                <th>
                    <p>Agent</p>
                </th>

            </tr>
        </thead>
        <thead>
            <tr
                class=" [&>th]:border [&>th]:border-black [&>th]:py-0 text-md font-semibold text-center [&>th]:font-bold">


                <th colspan="7" class="border border-black"> جديد / New</th>

            </tr>
        </thead>
        @php
            $slNo = 1; // Initialize the serial number counter
        @endphp
        <tbody id="table_body">
            @foreach($records as $record)
                @if($record->is_cancelled == 0)
                    <tr class="[&>td]:border [&>td]:border-black [&>td]:p-1 text-sm text-center relative group">
                        <td>{{ $record->profession }}</td>
                        <td>{{ $record->year }}</td>
                        <td>{{ $record->visa_number }}</td>
                        <td class="">{{ $record->sponsor_name }}</td>
                        <td>{{ $record->passport_no }}</td>
                        <td>{{ $slNo++ }}</td>
                        {{-- 
                        <td class="p-2">
                            <a href="{{ route('edit', ['id' => $record->id]) }}" class="text-blue-500 hover:underline">Edit</a>
                            <a href="{{ route('delete', ['id' => $record->id]) }}" class="text-red-500 hover:underline">Delete</a>
                        </td> --}}
                    </tr>
                @endif
            @endforeach
        </tbody>
        <thead id="cancel_head" class="">
            <tr class=" [&>th]:border [&>th]:border-black [&>th]:py-0 text-md font-semibold text-center [&>th]:font-bold">
                <th colspan="7" class="border border-black">إلغاء / Cancellation</th>
            </tr>
        </thead>
        <tbody id="table_cancel_body">
            @foreach($records as $record)
            dd($record)
                @if($record->is_cancelled == 1)
                    <tr class="[&>td]:border [&>td]:border-black [&>td]:p-1 text-sm text-center relative group">
                        <td>{{ $record->profession }}</td>
                        <td>{{ $record->year }}</td>
                        <td>{{ $record->visa_number }}</td>
                        <td class="">{{ $record->sponsor_name }}</td>
                        <td>{{ $record->passport_no }}</td>
                        <td>{{ $slNo++ }}</td>
                        <td>{{ $record->agent_name }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
        <tbody>
            <tr class="[&>td]:border [&>td]:border-black [&>td]:p-0 text-lg text-center relative group">
                <td colspan="5" contentEditable class="font-bold text-xl text-end px-5" id="totalCancel">
                    {{$records->count()}}
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
<div class="max-w-[1050px] my-4 container-fluid flex justify-center items-center"><button class="btn btn-primary mr-2 " onclick="printTable()">Print</button></div>



@include('layout.script')

<script type="text/javascript">
    var sl = 1;
    var rowsData = [];
    var cancelRowsData = [];

    function getdata() {
        var id = document.getElementById('candidate').value;

        fetch('/user/embassy/' + id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                addRowToTable(data[0]);
                document.getElementById('candidate').value = null;
                updateTotalCount();
            })
            .catch(error => {
                console.error(error);
            });
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
    function printTable() {
        var printContents = document.getElementById('printable_Area').innerHTML;
        var originalContents = document.body.innerHTML;
    
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>