{{-- <div class="bg-[#0b7f96]">
    <nav class="w-[90%] mx-auto py-3 flex items-center justify-between">
      <div class="flex items-center gap-6">
        <div class="text-white">
          <p class="font-semibold">01609317035</p>
          <p class="text-sm">contact.sallusoft@gmail.com</p>
        </div>
      </div>
  
      <div class="text-white font-bold text-xl">
        {{ $user->licence_name }} - {{ $user->rl_no }}
      </div>
  
      <div class="flex items-center space-x-4 relative">
        <button class="text-white text-xl p-2 rounded-full hover:bg-gray-800 focus:outline-none focus:bg-gray-800 mr-4" data-bs-target="#user" data-toggle="tooltip" data-placement="bottom" title="Edit Profile" data-bs-toggle="modal">
            <i class="far fa-user"></i>
          </button>
        
        <button class="text-white text-xl p-2 rounded-full hover:bg-gray-700">
          <i class="bi bi-bell"></i>
        </button>
  
        <button class="text-white text-xl p-2 rounded-full hover:bg-gray-700">
          <a href="{{ route('user/logout') }}">
            <i class="bi bi-box-arrow-left"></i>
          </a>
        </button>
  
        
    </nav>
  </div> --}}

  




<script>
  const dropdownButton = document.getElementById('dropdownButton');
  const dropdownMenu = document.getElementById('dropdownMenu');

  dropdownButton.addEventListener('click', () => {
      const isExpanded = dropdownMenu.classList.contains('hidden');
      // Toggle the visibility of the dropdown
      dropdownMenu.classList.toggle('hidden', !isExpanded);
  });

  // Close the dropdown if clicked outside
  document.addEventListener('click', (event) => {
      if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.classList.add('hidden');
      }
  });


  const dropdownReportButton = document.getElementById('dropdownReportButton');
  const dropdownMenu1 = document.getElementById('dropdownMenu1');

  dropdownReportButton.addEventListener('click', () => {
      const isExpanded = dropdownMenu1.classList.contains('hidden');
      // Toggle the visibility of the dropdown
      dropdownMenu1.classList.toggle('hidden', !isExpanded);
  });

  // Close the dropdown if clicked outside
  document.addEventListener('click', (event) => {
      if (!dropdownReportButton.contains(event.target) && !dropdownMenu1.contains(event.target)) {
          dropdownMenu1.classList.add('hidden');
      }
  });
</script>
{{-- <script>
  document.addEventListener('DOMContentLoaded', function() {
      const agents = @json($agents->items());
      const agentInput = document.getElementById('agentSearch');
      const agentDropdown = document.getElementById('agentDropdown');
      const agentIdInput = document.getElementById('agent_id');

      function filterOptions(search) {
          agentDropdown.innerHTML = ''; // Clear previous options
          const filteredAgents = agents.filter(agent =>
              agent.agent_name.toLowerCase().includes(search.toLowerCase())
          );

          if (filteredAgents.length) {
              filteredAgents.forEach(agent => {
                  const option = document.createElement('div');
                  option.classList.add('dropdown-item');
                  option.textContent = agent.agent_name;
                  option.dataset.value = agent.id;
                  option.addEventListener('click', () => {
                      agentInput.value = agent.agent_name;
                      agentIdInput.value = agent.id;
                      agentDropdown.classList.remove('show');
                  });
                  agentDropdown.appendChild(option);
              });
          } else {
              const noResult = document.createElement('div');
              noResult.classList.add('dropdown-item');
              noResult.textContent = 'No agents found';
              agentDropdown.appendChild(noResult);
          }
      }

      agentInput.addEventListener('input', function() {
          const search = agentInput.value;
          filterOptions(search);
          agentDropdown.classList.add('show');
      });

      document.addEventListener('click', function(e) {
          if (!agentDropdown.contains(e.target) && e.target !== agentInput) {
              agentDropdown.classList.remove('show');
          }
      });
  });




  function deleteAgent(agentId) {
      $.ajax({
          url: `/agents/${agentId}`,
          type: 'DELETE',
          data: {
              _token: '{{ csrf_token() }}'
          },
          success: function(response) {
              if (response.success) {
                  alert(response.message);
                  window.location.href = response.redirect_url;
              } else {
                  alert(response.message);
              }
          },
          error: function(xhr) {
              alert('An error occurred. Please try again.');
          }
      });
  }

  $(document).ready(function() {

      $('.view-agent-btn').click(function(e) {
          e.preventDefault();
          var agentId = $(this).data('agent-id');

          $.ajax({
              url: '{{ route('agent.view', ':id') }}'.replace(':id', agentId),
              type: 'GET',
              success: function(response) {
                  console.log(response.html);
                  $('#agentDetails').html(response.html);
                  $('#viewAgentModal').modal('show');
              },
              error: function(xhr) {
                  console.error('Failed to fetch agent details');
              }
          });
      });

      $('#medical_issue_date').datepicker({
          dateFormat: 'dd/mm/yy',
          onSelect: function(selectedDate) {
              var issueDate = $(this).datepicker('getDate');
              issueDate.setMonth(issueDate.getMonth() + 3);
              issueDate.setDate(issueDate.getDate() - 1);
              var formattedDate = $.datepicker.formatDate('dd/mm/yy', issueDate);
              $('#medical_expire_date').val(formattedDate);
          }
      });


      $('#pass_issue_date').datepicker({
          dateFormat: 'dd/mm/yy',
          onSelect: function(selectedDate) {
              var issueDate = $(this).datepicker('getDate');
              var radioSelection = document.querySelector('input[name="passDate"]:checked').value;
              console.log(radioSelection);
              if (radioSelection === "ten") {
                  issueDate.setFullYear(issueDate.getFullYear() + 10);
              } else if (radioSelection === "five") {
                  issueDate.setFullYear(issueDate.getFullYear() + 5);
              } else {
                  issueDate.setFullYear(issueDate.getFullYear() + 5);
              }
              issueDate.setDate(issueDate.getDate() - 1);
              var formattedDate = $.datepicker.formatDate('dd/mm/yy', issueDate);
              $('#pass_expire_date').val(formattedDate);
          }
      });


      // $('#date_of_birth').datepicker({
      //   dateFormat: 'dd/mm/yy',
      //   onSelect: function(selectedDate) {
      //         var dateOfBirth = $(this).datepicker('getDate');

      //         var formattedDate = $.datepicker.formatDate('dd/mm/yy',dateOfBirth);
      //         $('#date_of_birth').val(formattedDate);
      //   }
      // });

      $('#date_of_birth').datepicker({
          dateFormat: 'dd/mm/yy',
          onSelect: function(selectedDate) {
              var selectedDateObject = $(this).datepicker('getDate');
              var currentDate = new Date();

              // Calculate the age difference in years
              var ageDifferenceYears = currentDate.getFullYear() - selectedDateObject
                  .getFullYear();

              var ageDifference = currentDate - selectedDateObject;
              var ageDate = new Date(ageDifference);
              var years = ageDate.getUTCFullYear() - 1970;
              var months = ageDate.getUTCMonth();
              var days = ageDate.getUTCDate() - 1;


              // Check if the birthdate has occurred 21 or more years ago
              if (ageDifferenceYears > 21 || (ageDifferenceYears === 21 && (currentDate
                      .getMonth() > selectedDateObject.getMonth() || (currentDate
                      .getMonth() ===
                          selectedDateObject.getMonth() && currentDate.getDate() >=
                          selectedDateObject.getDate())))) {
                  var formattedDate = $.datepicker.formatDate('dd/mm/yy', selectedDateObject);
                  $('#date_of_birth').val(formattedDate);
              } else {
                  // Display an error message or take some other action
                  var ageString = years + " years, " + months + " months, " + days + " days";
                  alert("You must be at least 21 years old. Your Age is " + ageString);
                  $(this).val(''); // Clear the input field
              }
          }
      });



      $('#pass_expire_date').datepicker({
          dateFormat: 'd/m/y'
      });

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

          success: function(response) {
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
          error: function(error) {
              console.error("Error calling API:", error);
          }
      });
  }
  $('#pnumber').on('change', function() {
      var inputValue = $(this).val();
      var foundObject = dataObject[inputValue];

      if (foundObject) {
          // var email = Object.keys(foundObject)[0];
          var email = foundObject.candidate;
          // var licenceName = foundObject[email].user ? foundObject[email].user.licence_name : "Not available";
          var licenceName = foundObject.user.licence_name ? foundObject.user.licence_name : "Not available";
          alert(inputValue + " exists in database under: " + licenceName + '(' + foundObject.user.rl_no +
              ')' + ' Contact here: ' + email);

          $('#pnumber').val("");
      } else {

      }
  });

  $('#visainput').submit(function(e) {
      e.preventDefault(); // Prevent the default form submission
      var form = $(this);
      var formData = form.serialize(); // Serialize the form data
      // console.log(formData);
      var id = (document.getElementById('candidate_id').value);
      // console.log(id);
      $.ajax({
          url: "{{ url('user/visaadd') }}/" + id,

          method: form.attr('method'),
          data: formData,
          success: function(response) {

              console.log(response);

              Swal.fire({
                  title: response.title,
                  text: response.message,
                  icon: response.icon,

              });
              // if (response.redirect_url) {
              //     setTimeout(function() {
              //       var redirectUrl = window.location.origin + '/'+ response.redirect_url;
              //       window.location.href = redirectUrl;
              //     }, 2000);
              // }l

          },
          error: function(response) {

              console.log(response.title);
              Swal.fire({
                  title: "Error",
                  text: "Cannot add candidate\n 1: Complete all fields are required\n 2: Same ID check",
                  icon: 'error',

              });
              //   if (response.redirect_url) {
              //     setTimeout(function() {
              //       var redirectUrl = window.location.origin + '/'+ response.redirect_url;
              //       window.location.href = redirectUrl;
              //     }, 2000);
              // }l


          }

      });
  });

  $('#addcandidate').on('submit', function(e) {
      e.preventDefault();

      var form = $(this);
      var formData = form.serialize();
      // console.log(formData);
      $.ajax({
          url: form.attr('action'),
          method: form.attr('method'),
          data: form.serialize(),
          success: function(response) {

              console.log(response);

              Swal.fire({
                  title: response.title,
                  text: response.message,
                  icon: response.icon,

              });
              if (response.redirect_url) {
                  setTimeout(function() {
                      var redirectUrl = window.location.origin + '/' + response
                          .redirect_url;
                      window.location.href = redirectUrl;
                  }, 3000);
              }

          },
          error: function(response) {

              console.log(response);
              var errorMessage = xhr.responseText;
              var regex = /SQLSTATE\[23000\]:.*Duplicate entry.*'(.+)' for key '(.+)'/;
              var matches = errorMessage.match(regex);
              var duplicateEntryValue = matches ? matches[1] : null;
              var duplicateEntryKey = matches ? matches[2] : null;

              console.log("Duplicate Entry Value:", duplicateEntryValue);
              console.log("Duplicate Entry Key:", duplicateEntryKey);
              Swal.fire({
                  title: "Error",
                  text: "Cannot add candidate\n 1: Complete all fields are required\n 2: Same ID check",
                  icon: 'error',

              });
              if (response.redirect_url) {
                  setTimeout(function() {
                      var redirectUrl = window.location.origin + '/' + response
                          .redirect_url;
                      window.location.href = redirectUrl;
                  }, 3000);
              }

          }
      });
  });
  $('#addagent').on('submit', function(e) {
      e.preventDefault();

      var form = $(this);
      var formData = form.serialize();
      // console.log(formData);
      $.ajax({
          url: form.attr('action'),
          method: form.attr('method'),
          data: form.serialize(),
          success: function(response) {

              console.log(response);

              Swal.fire({
                  title: response.title,
                  text: response.message,
                  icon: response.icon,

              });
              if (response.redirect_url) {
                  setTimeout(function() {
                      var redirectUrl = window.location.origin + '/' + response
                          .redirect_url;
                      window.location.href = redirectUrl;
                  }, 3000);
              }

          },
          error: function(response) {

              console.log(response);
              var errorMessage = xhr.responseText;
              var regex = /SQLSTATE\[23000\]:.*Duplicate entry.*'(.+)' for key '(.+)'/;
              var matches = errorMessage.match(regex);
              var duplicateEntryValue = matches ? matches[1] : null;
              var duplicateEntryKey = matches ? matches[2] : null;

              console.log("Duplicate Entry Value:", duplicateEntryValue);
              console.log("Duplicate Entry Key:", duplicateEntryKey);
              Swal.fire({
                  title: "Error",
                  text: "Cannot add agent\n 1: Complete all fields are required\n 2: Same ID check",
                  icon: 'error',

              });
              if (response.redirect_url) {
                  setTimeout(function() {
                      var redirectUrl = window.location.origin + '/' + response
                          .redirect_url;
                      window.location.href = redirectUrl;
                  }, 3000);
              }

          }
      });
  });
  document.getElementById('pass_issue_date').addEventListener('change', function() {
      var issueDate = new Date(this.value);
      var expireDate = new Date(issueDate.getFullYear() + 10, issueDate.getMonth(), issueDate.getDate());
      var formattedExpireDate = formatDate(expireDate);
      console.log(formattedExpireDate);
      document.getElementById('pass_expire_date').value = formattedExpireDate;
  });

  function formatDate(date) {
      date.setDate(date.getDate() - 1); // Subtract 1 day from the date

      var year = date.getFullYear();
      var month = ('0' + (date.getMonth() + 1)).slice(-2);
      var day = ('0' + date.getDate()).slice(-2);

      return year + '-' + month + '-' + day;
  }
  document.addEventListener("DOMContentLoaded", function() {
      const candidateModalEl = document.getElementById("exampleModal");
      const agentModalEl = document.getElementById("agentModal");

      const candidateModal = new bootstrap.Modal(candidateModalEl);
      const agentModal = new bootstrap.Modal(agentModalEl);

      document.querySelector("[data-bs-target='#agentModal']").addEventListener("click", function(event) {
          event.preventDefault();

          // Close Candidate Modal before opening Agent Modal
          candidateModal.hide();

          // Open Agent Modal
          setTimeout(() => {
              agentModal.show();
          }, 300); // Delay to ensure smooth transition
      });
  });
</script>
<script>
  function showAlert() {
      alert("Visa is not available! Please Enter Your Candidates Visa First for Print");
      // You can perform other actions here as needed.
  }

  function surity(id) {
      let text = "Sure Want to delete!\nEither OK or Cancel.";
      if (confirm(text)) {
          let url = '/user/delete/' + id;
          fetch(url, {
                  method: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  },
              })
              .then(response => response.json())
              .then(response => {
                  if (response.success) {
                      alert(response.message, "Deleted Successfully");
                      location.reload();

                  } else {
                      alert(response.message, "Not Deleted");
                      location.reload();
                  }
              })
              .catch(error => {
                  console.error("An error occurred:", error);
                  // Handle any network or other errors here.
              });
      } else {
          console.log("You canceled!");
      }

      return false; // Prevent the link from being followed immediately

  }

  function SearchPC() {
      var PCInput = document.getElementById("police_licence").value.toUpperCase();
      var url = `https://pcc.police.gov.bd/ords/f?p=500:50::::RP:P50_TOKEN_ID:${PCInput}`;

      // Open the link in a new tab
      window.open(url, "_blank");
  }
</script> --}}
<div class="bg-gradient-to-r from-[#1e3a8a] to-[#0f172a] shadow-lg">
    <nav class="w-[90%] mx-auto py-3 flex items-center justify-between">
      <!-- Left Section -->
      <div  class="flex items-center gap-x-8">
      <div class="flex items-center gap-6 text-white border-r border-gray-100 pr-5">
        <div>
          <p class="font-normal text-md">For Support</p>
          <p class="font-semibold text-md">📞 01609317035</p>
          <p class="text-sm opacity-80">📧 contact.sallusoft@gmail.com</p>
        </div>
      </div>
      <div class="flex items-center gap-6 text-white">
        <div>
          <p class="font-normal text-md">Mohammed Shakil</p>
          <p class="font-semibold text-md">📞 01609317035</p>
          <p class="text-sm opacity-80">📧 contact.sallusoft@gmail.com</p>
        </div>
      </div>
    </div>
      <!-- Middle Section: User Info -->
      <div  class=" relative flex items-center gap-x-5">
        <button  class="flex items-center gap-x-4 font-bold text-xl tracking-wide  bg-gray-100 px-4 py-2 rounded-lg">
           <div class="text-start"><div class="text-sm font-semibold text-gray-800">Next Payment In!</div><span class="animate-bounce font-bold text-lg text-red-600">
            {{ \Carbon\Carbon::parse($user->previous_month)->addDays(30)->format('d-m-Y') }}
        </span></div></button>
        <button id="profileDropdownBtn" class="flex items-center gap-x-4 font-bold text-xl tracking-wide  bg-gray-100 p-2 rounded-lg">
            <span class="bg-gray-800 w-10 h-10 text-2xl text-white font-normal p-1 rounded-full ">{{ !empty($user->licence_name) ? strtoupper($user->licence_name[0]) : '' }}</span><div class="text-start"><div class="text-sm font-semibold text-gray-800">Welcome Back!</div><span class="font-bold text-lg"> {{ $user->licence_name }} - {{ $user->rl_no }}</span></div></button>
        
        <div id="profileDropdown" class="absolute top-16 right-0 bg-white text-gray-700 rounded-md shadow-md hidden w-48 transition-opacity opacity-0 duration-300">
            <button data-bs-target="#user" data-toggle="tooltip" data-placement="bottom" title="Edit Profile" data-bs-toggle="modal" class="w-full px-4 text-start py-2 hover:bg-gray-100"><i class="far fa-user mr-2"></i>Edit Profile</button>
           
            <a href="{{ route('user/logout') }}" class="block px-4 py-2 hover:bg-red-500 hover:text-white text-red-600"><i class="bi bi-box-arrow-left mr-2"></i> Logout</a>
          </div>
      </div>
      
      <!-- Right Section: Icons & Dropdown -->
       
  
        <!-- Profile Dropdown Menu -->
        
    </nav>
  </div>
  
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const profileBtn = document.getElementById("profileDropdownBtn");
      const profileMenu = document.getElementById("profileDropdown");
  
      profileBtn.addEventListener("click", () => {
        profileMenu.classList.toggle("hidden");
        profileMenu.classList.toggle("opacity-0");
      });
  
      document.addEventListener("click", (event) => {
        if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
          profileMenu.classList.add("hidden");
          profileMenu.classList.add("opacity-0");
        }
      });
    });
  </script>