<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAsT3i29ee9grFevI2bo14_umv_pXsGfDc"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#address2").on("keyup", function () {
            $('#lat').val('');
            $('#long').val('');
            $('.errors').html('Enter correct location.');
            if (this.value == '')
            {
                $('#submit').attr('disabled', false);
                $('.errors').html('');
            } else {
                $('#submit').attr('disabled', true);
                $('.errors').html('Enter correct location.');
            }

        });
    });
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('address2'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            //var mesg = "Address: " + address;
            $('#lat').val(latitude);
            $('#long').val(longitude);
            $('.errors').html('');
            $('#submit').attr('disabled', false);
            //console.log(mesg);

        });
    });
</script>

<script type="text/javascript" src="{{ Request::root() }}/public/quickadmin/dist/js/standalone/selectize.js"></script>
<script type="text/javascript" src="{{ Request::root() }}/public/quickadmin/js/index.js"></script>

<script>
     $('#symptom,#search_keyword').selectize({
         maxItems: 8,
         plugins: ['remove_button'],
     });
     $('#dieases').selectize({
         maxItems: 1
     });
</script>


<div class="an_footer"> ©2017 All Rights Reserved by AskNuma.com </div>



</body>
</html>