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
        const restepInput = document.getElementById('restepInput');
        
        if (radioSelection === 'New') {
            inputNew.style.display = 'block';
            inputCancel.style.display = 'none';
            restepInput.style.display = 'none';
            console.log("new selected")
            // document.getElementById('candidate').setAttribute('onchange', 'getdata()');
        }
        else if(radioSelection === 'Re-step'){
            inputNew.style.display = 'none';
            inputCancel.style.display = 'none';
            restepInput.style.display = 'block';
            console.log('restemp select');
        }
        else (radioSelection === 'Cancel')
            inputNew.style.display = 'none';
            restepInput.style.display = 'none';
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




    