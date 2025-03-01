<style>
  @media (max-width: 768px) {
    #sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    .ml-[280px] {
        margin-left: 0;
    }
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

<script src="{{asset('assets/js/main.js')}}"></script>

<script>
    function toggleInputBox() {
    const radioSelection = document.querySelector('input[name="emb_list"]:checked').value;
    const inputNew = document.getElementById('candidate');
    const inputCancel = document.getElementById('cancelInput');

    if (radioSelection === 'New') {
        inputNew.style.display = 'block';
        inputCancel.style.display = 'none';
        console.log("new selected")
        // document.getElementById('candidate').setAttribute('onchange', 'getdata()');
    } else (radioSelection === 'Cancel')
        inputNew.style.display = 'none';
        inputCancel.style.display = 'block';
        console.log("cancel selected")
        
}
</script>
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



{{-- <script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggleBtn");

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener("click", () => {
                sidebar.classList.toggle("-translate-x-full");
            });
        } else {
            console.error("Sidebar or toggle button not found");
        }
    });
</script> --}}


{{-- embassy list script --}}
<script type="text/javascript">
  // $(document).ready( function () {
  //     $('#embassy_list').DataTable();
  // } );

  function toggleInputBox() {
      const radioSelection = document.querySelector('input[name="emb_list"]:checked')?.value;
      const inputNew = document.getElementById('candidate');
      const inputCancel = document.getElementById('cancelInput');

      // Check if radioSelection is not undefined
      if (radioSelection === 'New') {
          inputNew.style.display = 'block';
          inputCancel.style.display = 'none';

          // Optional: Add event listener if needed
          // inputNew.addEventListener('change', getdata);
      } else if (radioSelection === 'Cancel') {
          inputNew.style.display = 'none';
          inputCancel.style.display = 'block';

          // Optional: Add event listener if needed
          // inputCancel.addEventListener('change', getCanceldata);
      } else {
          // Handle case when no valid selection is made or defaults
          inputNew.style.display = 'block';
          inputCancel.style.display = 'none';
      }
  }


  var sl = 1;
  var rowsData = [];
  var cancelRowsData = [];



  function getdata(id = null) {
      if (id == null) {
          var id = document.getElementById('candidate').value;
      }
      let input = document.getElementById('candidate');
      let selectedOption = getSelectedOption(input);

      if (selectedOption) {
          let candidateId = selectedOption.getAttribute('data-id');
          fetch('/user/embassy/' + candidateId, {
                  method: 'GET',
                  headers: {
                      'Content-Type': 'application/json'
                  },
              })
              .then(response => response.json())
              .then(data => {
                  var existingRow = findRowById(data[0].passport_number, 'table_body');

                  if (existingRow) {
                      // Overwrite the existing row
                      overwriteRowData(existingRow, data[0]);
                  } else {
                      // Add new row only if it doesn't exist
                      addRowToTable(data[0]);
                  }

                  document.getElementById('candidate').value = null;
                  updateTotalCount();
              })
              .catch(error => {
                  console.error(error);
              });
      } else {
          console.log('No valid selection made.');
      }

  }


  function getCanceldata(id = null) {
      if (id == null) {
          var id = document.getElementById('cancelInput').value;
      }
      let input = document.getElementById('cancelInput');
      let selectedOption = getSelectedOption(input);

      if (selectedOption) {
          let candidateId = selectedOption.getAttribute('data-id');
          fetch('/user/embassy/' + candidateId, {
                  method: 'GET',
                  headers: {
                      'Content-Type': 'application/json'
                  },
              })
              .then(response => response.json())
              .then(data => {
                  var existingRow = findRowById(data[0].passport_number, 'table_cancel_body');

                  if (existingRow) {
                      // Overwrite the existing row in the cancel table
                      overwriteRowData(existingRow, data[0]);
                  } else {
                      // Add new row only if it doesn't exist
                      addRowToTable(data[0], true); // Pass true to highlight row
                  }

                  document.getElementById('cancelInput').value = null;
                  updateTotalCount();
              })
              .catch(error => {
                  console.error(error);
              });
      } else {
          console.log('No valid selection made.');
      }


  }

  function findRowById(passportNumber, tableBodyId) {
      var rows = document.getElementById(tableBodyId).getElementsByTagName('tr');
      for (var i = 0; i < rows.length; i++) {
          if (rows[i].children[4].textContent === passportNumber) {
              return rows[i];
          }
      }
      return null;
  }

  function overwriteRowData(row, data) {
      row.children[0].textContent = data.prof_name_arabic;
      row.children[1].textContent = data.visa_date2.substr(0, 4);
      row.children[2].textContent = data.visa_no;
      row.children[3].textContent = data.spon_name_arabic;
      row.children[4].textContent = data.passport_number;
  }



  function addRowToTable(data, highlight = false) {
      var tbody = highlight ? document.getElementById('table_cancel_body') : document.getElementById('table_body');
      var tr = document.createElement('tr');
      tr.classList.add('border', 'border-black', 'p-0', 'text-[13px]', 'text-center', 'relative', 'group');

      var td1 = document.createElement('td');
      var td2 = document.createElement('td');
      var td3 = document.createElement('td');
      var td4 = document.createElement('td');
      var td5 = document.createElement('td');
      var td6 = document.createElement('td');
      var td7 = document.createElement('td');

      td1.innerHTML = sl;
      td1.setAttribute('contentEditable', 'true');
      sl++;

      td2.innerHTML = data.prof_name_arabic;
      td3.innerHTML = data.visa_date2.substr(0, 4);
      td3.setAttribute('contentEditable', 'true');
      td4.innerHTML = data.visa_no;
      td5.innerHTML = data.spon_name_arabic;
      td6.innerHTML = data.passport_number;
      td7.innerHTML =
          `<button class="text-lg text-red-700 mr-2" onclick="deleteRow(this)"><i class="bi bi-trash"></i></button> <button class="text-lg text-green-600" onclick="overwriteRow(this)"><i class="bi bi-arrow-left-right"></i></button>`;


      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
      tr.appendChild(td5);
      tr.appendChild(td6);
      tr.appendChild(td1);
      tr.appendChild(td7);

      if (highlight) {

          cancelRowsData.push(tr);
      } else {
          rowsData.push(tr);
      }

      tbody.appendChild(tr);
      updateTable();
  }


  var selectedCandidate = null;
  function overwriteRow(btn, id) {
      const row = btn.parentNode.parentNode;
      const index = Array.from(row.parentNode.children).indexOf(row);

      // Open the modal
      openModal();

      // Candidate selection logic
      window.selectCandidate = function() {
          const candidateInput = document.getElementById('candidateSelect');
          const selectedValue = candidateInput.value;

          // Find the selected <option>
          const selectedOption = Array.from(document.querySelectorAll('#candidateadd option')).find(
              option => option.value === selectedValue
          );

          // Retrieve the data-id from the selected option
          if (selectedOption) {
              const selectedCandidate = selectedOption.getAttribute('data-id');

              // Fetch the new data for the selected candidate
              fetch(`/user/embassy/${selectedCandidate}`, {
                      method: 'GET',
                      headers: {
                          'Content-Type': 'application/json'
                      },
                  })
                  .then(response => response.json())
                  .then(data => {
                      if (data.length === 0) {
                          console.error('No data found for the selected candidate');
                          return;
                      }

                      // Update the row's content
                      row.children[0].textContent = data[0].prof_name_arabic;
                      row.children[1].textContent = data[0].visa_date2.substr(0, 4);
                      row.children[2].textContent = data[0].visa_no;
                      row.children[3].textContent = data[0].spon_name_arabic;
                      row.children[4].textContent = data[0].passport_number;

                      // Update the corresponding data array
                      if (row.parentNode.id === 'table_cancel_body') {
                          cancelRowsData[index] = {
                              ...cancelRowsData[index],
                              ...data[0]
                          };
                      } else {
                          rowsData[index] = {
                              ...rowsData[index],
                              ...data[0]
                          };
                      }

                      // Update input and trigger data fetching functions
                      const passportNumber = data[0].passport_number;

                      if (row.parentNode.id === 'table_cancel_body') {
                          document.getElementById('cancelInput').value = passportNumber;
                          getCanceldata();
                      } else {
                          document.getElementById('candidate').value = passportNumber;
                          getdata();
                      }

                      console.log("Candidate updated successfully");

                      // Clear input and close modal
                      candidateInput.value = "";
                      closeModal();
                  })
                  .catch(error => {
                      console.error('Error fetching candidate data:', error);
                      closeModal();
                  });
          } else {
              console.log('No matching candidate found.');
              closeModal();
          }
      };
  }


  function openModal() {
      document.getElementById('candidateModal').style.display = 'flex';
  }

  function closeModal() {
      document.getElementById('candidateModal').style.display = 'none';
  }

  function deleteRow(btn) {
      var row = btn.parentNode.parentNode;
      var index = Array.from(row.parentNode.children).indexOf(row);

      if (row.parentNode.id === 'table_cancel_body') {
          cancelRowsData.splice(index, 1);
      } else {
          rowsData.splice(index, 1);
      }
      row.parentNode.removeChild(row);
      updateTableIndexes();
      updateTotalCount();
  }

  function updateTableIndexes() {
      rowsData.forEach((tr, index) => {
          tr.children[5].innerHTML = index + 1;
      });

      cancelRowsData.forEach((tr, index) => {
          tr.children[5].innerHTML = index + 1 + rowsData.length;
      });
  }

  function updateTotalCount() {
      var totalRows = rowsData.length + cancelRowsData.length;
      document.getElementById('totalCancel').innerHTML = totalRows;
  }

  function updateTable() {
      updateTableIndexes();
      updateTotalCount();
  }
  var hide = document.getElementById('hide');
  if (!rowsData) {
      hide.classList.add('hidden');
  }

  function printtable() {
      // Hide the delete buttons and overwrite button before printing
      var deleteButtons = document.querySelectorAll('button[onclick="deleteRow(this)"]');
      deleteButtons.forEach(function(button) {
          var parentTd = button.parentNode; // Get the parent <td> element
          parentTd.classList.add('no-print'); // Add the no-print class to the parent <td>
      });

      var overwriteButton = document.querySelectorAll('button[onclick="overwriteRow(this);"]');
      overwriteButton.forEach(function(button) {
          var overwriteparent = button.parentNode; // Get the parent <td> element
          overwriteparent.classList.add('no-print'); // Add the no-print class to the parent <td>
      });
      var hide = document.getElementById('hide');
      hide.classList.add('no-print');
      // Print the specific table
      var printContents = document.getElementById('printable').outerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();

      // Restore the original contents of the page
      document.body.innerHTML = originalContents;

      // Remove the no-print class from the buttons after printing
      deleteButtons.forEach(function(button) {
          var parentTd = button.parentNode; // Get the parent <td> element
          parentTd.classList.remove('no-print'); // Remove the no-print class from the parent <td>
      });

      overwriteButton.forEach(function(button) {
          var overwriteparent = button.parentNode; // Get the parent <td> element
          overwriteparent.classList.remove('no-print'); // Add the no-print class to the parent <td>
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
  document.addEventListener('DOMContentLoaded', function () {
        const currentDateElement = document.getElementById('currentDate');

        if (!currentDateElement) {
            console.error("Element with ID 'currentDate' not found.");
            return;
        }

        const now = new Date();
        const formattedDate = now.toLocaleDateString(); // Adjust format if needed
        currentDateElement.textContent = formattedDate;
    });
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
</script>


<script>
  // Function to extract table data
  function extractTableData(tableId) {
      let tableData = [];
      let rows = document.querySelectorAll(`#${tableId} tr`);

      rows.forEach(row => {
          let rowData = {};
          let cells = row.querySelectorAll('td, th'); // Select table cells
          if (cells.length > 0) {
              rowData.profession = cells[0]?.innerText.trim(); // Profession
              rowData.year = cells[1]?.innerText.trim(); // Year
              rowData.visaNumber = cells[2]?.innerText.trim(); // Visa Number
              rowData.sponsorName = cells[3]?.innerText.trim(); // Sponsor Name
              rowData.passportNo = cells[4]?.innerText.trim(); // Passport No
              rowData.sl = cells[5]?.innerText.trim(); // SL
              tableData.push(rowData);
          }
      });
      return tableData;
  }

  // Function to save the data to the database
  async function saveDataToDB(tableData, cancelData) {
      try {
          const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
          const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

          if (!csrfToken) {
              throw new Error('CSRF token not found.');
          }

          let response = await fetch('/save-table-data', { // Laravel route to handle data saving
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken // CSRF token for Laravel
              },
              body: JSON.stringify({
                  table_body: tableData,
                  table_cancel_body: cancelData
              })
          });

          if (response.ok) {
              const result = await response.json();
              alert("Data saved successfully!", result);
          } else {
              alert("Failed to save data!");
          }
      } catch (error) {
          alert("Error:", error);
      }
  }


  // Function to handle print
  function handlePrint() {
      window.print(); // This will open the browser print dialog
  }

  // Button Click Event
  document.addEventListener('DOMContentLoaded', function () {
        const saveAndPrintBtn = document.getElementById('saveAndPrintBtn');

        if (!saveAndPrintBtn) {
            console.error("Element with ID 'saveAndPrintBtn' not found.");
            return;
        }

        saveAndPrintBtn.addEventListener('click', () => {
            console.log('Save and print');
            let tableBodyData = extractTableData('table_body'); // Extract table body data
            let tableCancelBodyData = extractTableData('table_cancel_body'); // Extract cancel body data

            saveDataToDB(tableBodyData, tableCancelBodyData); // Save the data to DB
            printtable(); // Trigger print
        });
    });


  function getSelectedOption(inputElement) {
      let options = inputElement.list.options; // Get all options in the datalist
      for (let option of options) {
          if (option.value === inputElement.value) {
              return option; // Return the matching option element
          }
      }
      return null; // Return null if no match is found
  }
</script>
{{-- embassy list script end --}}

<script>
    // Get elements once
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownReportButton = document.getElementById('dropdownReportButton');
    const dropdownMenu1 = document.getElementById('dropdownMenu1');

    document.addEventListener('DOMContentLoaded', function () {
        // Ensure the elements exist before adding an event listener
        if (dropdownButton && dropdownMenu) {
            dropdownButton.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });
        } else {
            console.warn("Dropdown elements not found in the DOM.");
        }

        if (dropdownReportButton && dropdownMenu1) {
            dropdownReportButton.addEventListener('click', () => {
                dropdownMenu1.classList.toggle('hidden');
            });
        } else {
            console.warn("Dropdown report elements not found in the DOM.");
        }
    });

    // Close dropdowns if clicked outside
    document.addEventListener('click', (event) => {
        if (dropdownButton && dropdownMenu && !dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }

        if (dropdownReportButton && dropdownMenu1 && !dropdownReportButton.contains(event.target) && !dropdownMenu1.contains(event.target)) {
            dropdownMenu1.classList.add('hidden');
        }
    });
</script>

   {{-- INDEX FILES SCRIPTS starts bellow--}}
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
</script>
<script>
    $('.view-agent-btn').click(function(e) {
        e.preventDefault();
        var agentId = $(this).data('agent-id');

        $.ajax({
            url: '{{ route('user.agent_view', ':id') }}'.replace(':id', agentId),
            type: 'GET',
            success: function(response) {
                $('#agentDetails').html(response.html);
                $('#viewAgentModal').modal('show');
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    alert('Unauthorized! Please log in.');
                    window.location.href = '{{ route('login') }}';
                } else if (xhr.status === 404) {
                    alert('Agent not found.');
                } else {
                    console.error('Failed to fetch agent details');
                }
            }
        });
    });
</script>

@if(isset($agents) && $agents->count() > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agents = @json($agents->items());
            if (!agents || agents.length === 0) return;

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
    </script>
@endif

<script>

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

            // Wait until Candidate Modal is fully closed
            candidateModalEl.addEventListener("hidden.bs.modal", function() {
                agentModal.show();
            }, {
                once: true
            }); // Runs only once to prevent multiple triggers
        });

        // Remove any leftover backdrop when Agent Modal is closed
        agentModalEl.addEventListener("hidden.bs.modal", function() {

            document.querySelectorAll(".modal-backdrop").forEach(backdrop => backdrop.remove());
            location.reload();
        });
    });
</script>

 {{-- user modal --}}
