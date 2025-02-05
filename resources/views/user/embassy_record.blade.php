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

</head>

<body>
    @include('layout.navbar')
    <div class="flex justify-between items-center xl:w-[65%] w-[90%] mx-auto mt-3">    <h2 class=" font-semibold py-2 text-2xl">Embassy Record List</h2>

<!-- Search Form -->
<div class="  py-2">
    <form action="{{ route('user/embassy_report') }}" method="GET" class="flex gap-4">
        <input type="date" name="search_date" class="border border-gray-400 p-2 w-[250px] rounded-lg" value="{{ request()->get('search_date') }}" required>
        <button type="submit" class="bg-green-700 px-3 py-2 text-white rounded-lg">Search</button>
    </form>
</div></div>
    <div class="datelist">
      <table class="table stripe xl:w-[65%] w-[90%] shadow-lg mx-auto mt-10  no-footer dataTable passenger-table" id="simpleTable">
        <thead class="!text-white !bg-[#275E8B] thed">
          <tr class=" !text-white !bg-[#275E8B]">
            <th scope="col">Date</th>
            <th scope="col" class="text-center">Total Submitted Passport</th>
            <th scope="col" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-gray-400">
          @foreach($records as $record)
            <tr class="bg-gray-700 td-bg my-auto">
              <td>
                {{ \Carbon\Carbon::parse($record->record_date)->format('d-m-Y') }}
              </td>
              <td class="p-2 text-center">
                {{ $record->total_records }}
              </td>
              <td class="p-2 flex gap-2 justify-center">
                <div class="md:text-lg text-md">
                  <a class="bg-blue-700 px-5 py-2 rounded-lg text-white" href="{{ route('embassy_report_datewise/print', ['date' => $record->record_date]) }}" class="fw-semibold text-warning">
                    <i class="bi bi-eye-fill mr-1"></i>View
                  </a>
                </div>
                <div class="md:text-lg text-md">
                  <a class="bg-rose-700 px-5 py-2 rounded-lg text-white" href="{{ route('embassy_report_datewise/agent', ['date' => $record->record_date]) }}" class="fw-semibold text-warning">
                    <i class="bi bi-eye-fill mr-1"></i>View with Agent
                  </a>
                </div>
                <div class="md:text-lg text-md">
                  <a class="bg-red-700 px-5 py-2 rounded-lg text-white" href="{{ route('embassy_report_datewise.delete', ['date' => $record->record_date]) }}" class="fw-semibold text-warning">
                    <i class="bi bi-trash-fill mr-1"></i>Delete
                  </a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div id="reportdiv">

    </div>


</body>

</html>
