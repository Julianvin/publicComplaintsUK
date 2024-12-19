@if ($errors->any())
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: "Terjadi Kesalahan!",
              text: "{{ implode("\\n", $errors->all()) }}",
              icon: "error",
              position: "center",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              toast: true,
              customClass: {
                  popup: 'animated fadeInRight'
              }
          });
      });
  </script>
  @endif
  <!-- Sweet Alert Notifications -->
  @if (Session::has('success'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: "Berhasil!",
              text: "{{ Session::get('success') }}",
              icon: "success",
              position: "t",
              showConfirmButton: false,
              timer: 2500,
              timerProgressBar: true,
              toast: true,
              customClass: {
                  popup: 'animated fadeInRight'
              }
          });
      });
  </script>
@endif

@if (Session::has('failed'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: "Oops...",
              text: "{{ Session::get('failed') }}",
              icon: "error",
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              toast: true,
              customClass: {
                  popup: 'animated fadeInRight'
              }
          });
      });
  </script>
@endif