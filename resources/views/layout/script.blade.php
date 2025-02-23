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



<script>
  const sidebar = document.getElementById("sidebar");
  const toggleBtn = document.getElementById("toggleBtn");

  toggleBtn.addEventListener("click", () => {
      sidebar.classList.toggle("-translate-x-full");
  });
</script>


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
  document.getElementById('saveAndPrintBtn').addEventListener('click', () => {
      console.log('Save and print');
      let tableBodyData = extractTableData('table_body'); // Extract table body data
      let tableCancelBodyData = extractTableData('table_cancel_body'); // Extract cancel body data

      saveDataToDB(tableBodyData, tableCancelBodyData); // Save the data to DB
      printtable(); // Trigger print
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
{{-- embassy list script --}}

