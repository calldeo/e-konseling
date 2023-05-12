<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"&libraries=places"></script>
<script src="{{asset('dashboards/dist/js/app.js')}}"></script>
<script >function lettersOnly(input) {
    var regex = /[^a-z  ]/gi;
    input.value = input.value.replace(regex, "");
		}
    </script>

{{-- <script>
  const textInput1 = document.getElementById('nama');
  textInput.addEventListener('input1', () => {
    if (textInput.value.length < 5 || textInput.value.length > 9) {
      textInput.setCustomValidity('Text input must be between 5 and 20 characters.');
    } else {
      textInput.setCustomValidity('');
    }
  });
</script> --}}
<script>
  const textInput = document.getElementById('nisn');
  textInput.addEventListener('input', () => {
    if (textInput.value.length < 5 || textInput.value.length > 10) {
      textInput.setCustomValidity('Text input must be between 5 and 10 characters.');
    } else {
      textInput.setCustomValidity('');
    }
  });
</script>

@stack('js')
  