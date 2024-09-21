{{-- <x-app-layout> --}}
    @include('layout.head')
    <div class=" bg-white px-4 rounded-lg flex items-center justify-between mt-3 py-2 mx-6 shadow-lg">
        {{-- <h3>fsdsdf</h3> --}}
        <form id="reportForm" action="{{ route('agent_candidate_report') }}" method="POST">
          @csrf
          <div class="flex items-center ">
            
              <div class="w-[30%] flex items-center gap-2 col-md-2">
                  <label for="agent" class="text-[16px] font-semibold">Agent</label>
                  <select class="form-control text-black select2" name="agent" id="agent" >
                      <option value="">Select Agent</option>
                      @foreach($agents as $agent)
                          <option value="{{ $agent->id }}">{{ $agent->agent_name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="py-2 flex w-[30%] gap-2 cols-md-2 ml-6 items-center">
                <div class="font-semibold text-[16px] w-[100px]">Visa No</div>
                <input type="text" id="visa_no" name="visa_no"
                    class="form-control p-2 rounded-lg w-full uppercase"
                    placeholder="Ex- 1303044456" />
            </div>
              <div class="flex items-center gap-4 mx-6">
                <label for="start_date" class='font-semibold text-[14px] text-[#22262e]'>From</label>
                <div class="w-[100%] date">
                    <input type="text" class="form-control datepicker" name="start_date" id="start_date"
                        placeholder="Start Date" />
                </div>
            </div>
            <div class="flex items-center gap-4">
                <label for="end_date" class='font-semibold text-[14px] text-[#22262e]'>To</label>
                <div class="w-[100%] date" >
                    <input type="text" class="form-control datepicker" name="end_date" id="end_date"
                        placeholder="End Date" />
                </div>
            </div>
             
              
              
              <div class="flex items-center ml-2">
                  <button type="submit" class="bg-black border-blue-500 text-white py-2 px-5 rounded-lg ">Submit</button>
              </div>
          </div>
      </form>
      <div class="buttons justify-end flex gap-3">
        <button id="printButton" class="text-white rounded-lg bg-blue-700 font-bold text-md py-1 px-6">Print</button>
        <button onclick="goBack()" class="text-white bg-black font-bold text-md rounded-lg py-1 px-6">GO BACK</button>
    </div> 
    </div>

    

    <div class="reportdiv mt-5" id="reportdiv">

    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
          

            $('#reportForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        // Update the reportdiv with the response
                        $('#reportdiv').html(response.html);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });

        
    </script>

    <script>
        // Function to print the content of the reportdiv
        function printReport() {
            var printContents = document.getElementById("reportdiv").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        // Add event listener to the "Print" button
        document.querySelector("#printButton").addEventListener("click", function() {
            printReport();
        });
        function goBack() {
    window.history.back();
}
    </script>
{{-- </x-app-layout> --}}