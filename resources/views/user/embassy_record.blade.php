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

    <div class="datelist">
      <table class="table stripe w-[50%] bg-white shadow-lg mx-auto mt-10  no-footer dataTable passenger-table" id="simpleTable">
        <thead class="bg-blue-300 thed">
          <tr class="">
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-gray-400">
          @foreach($records as $record)
            <tr class="bg-gray-700 td-bg my-auto">
              <td>
                {{ \Carbon\Carbon::parse($record->distinct_date)->format('d-m-Y') }}
              </td>
              <td class="p-2">
                <div class="md:text-lg text-md">
                  <a class="bg-red-700 px-5 py-2 rounded-lg text-white" href="{{ route('embassy_report_datewise/print', ['date' => $record->distinct_date]) }}" class="fw-semibold text-warning">
                    <i class="bi bi-printer-fill mr-1"></i>Print
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
