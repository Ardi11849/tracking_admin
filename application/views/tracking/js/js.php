
    <!-- container-scroller -->
    <script type="text/javascript" src="<?php echo base_url()?>template/jquery.min.js"></script>
    <!-- plugins:js -->
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
    <!-- Maps -->
    <script type="text/javascript">
      //Variable
      var locationsAll = [];
      var locations = [];
      var onClick = [];
      // END variable

      $("#cardMap").hide();
      $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#area span").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
        function click(){
            for (var i = locationsAll.length - 1; i >= 0; i--) {
              $("#lacakid"+[i]).on("click", function(){
                onClick.length = 0;
                onClick.push(this.id)
                locations.length = 0;
                setInterval(locations.push({lat: $(this).data("lat"), lng: $(this).data("lng")}), 5000)
                console.log(locations[0]['lat'])
                $("#cardMap").show('show');
                initMap();
                console.log(onClick[0])
                // get_addreess()
              })
            }
        }
        // $(".all").on("click", function(){
        //   locations.length = 0;
        //   locations.push(locationsAll);
        // })
        setInterval(function(){panggilAjax(); $("#"+onClick[0]).click()}, 10000)
        panggilAjax()
        // function get_addreess() {
        //   $.ajax({
        //     type: 'get',
        //     url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+locations[0]["lat"]+','+locations[0]["lng"]+'&key=AIzaSyCjCoX47JuBWAsqKkhyIA1ofM0vufpMfSM&callback=initMap&libraries',
        //     dataType: 'json',
        //     success: function(hasil){
        //       console.log(hasil)
        //     }
        //   })
        // }
        function panggilAjax() {
            $.ajax({
                    type: "get",
                    url: "<?php echo base_url()?>Tracking/get_tracking",
                    dataType: "json",
                    success: function (hasil) {
                        console.log(hasil)
                        locationsAll.length = 0;
                        for (var i = hasil.data.length - 1; i >= 0; i--) {
                          var isi = '<div class="col-md-6 grid-margin stretch-card"><div class="card"><div class="card-body"><div class="row"><div class="col-md-6"><div class="d-flex align-items-center pb-2"><div class="dot-indicator bg-danger mr-2"></div><p class="mb-0">'+hasil.data[i].Nama+'</p></div><h4 class="font-weight-semibold">Lat = '+hasil.data[i].latitude+'</h4></div><div class="col-md-6 mt-4 mt-md-0"><div class="d-flex align-items-center pb-2"><div class="dot-indicator bg-success mr-2"></div><p class="mb-0" id="IdKurir">'+hasil.data[i].IdKurir+'</p></div><h4 class="font-weight-semibold">Lon = '+hasil.data[i].longitude+'</h4><button data-Id = '+hasil.data[i].IdKurir+' data-lat = '+hasil.data[i].latitude+' data-lng = '+hasil.data[i].longitude+' id = "lacakid'+[i]+'">Lacak Pengendara</button></div></div></div></div></div>'
                        // var isi = '<span class="col-lg-4 col-md-6" style="border: double"><div><div class="flex-row"><div class="wrapper""><h5 class="mb-0 font-weight-medium" id="DeviceId">Device Id = '+hasil.data[i].DeviceId+'</h5><h5 class="mb-0 font-weight-medium" id="IdKurir">Kurir Id = '+hasil.data[i].IdKurir+'</h5><h5 class="mb-0 font-weight-medium" id="NamaKurir">Nama Kurir = '+hasil.data[i].Nama+'</h5><h5 class="mb-0 font-weight-medium" id="lat">Latitude = '+hasil.data[i].latitude+'</h5><h5 class="mb-0 font-weight-medium" id="lng">Langtitude = '+hasil.data[i].longitude+'</h5></div><div style="padding-bottom:30px; padding-top:10px" class="wrapper my-auto ml-auto ml-lg-4"><button data-Id = '+hasil.data[i].IdKurir+' data-lat = '+hasil.data[i].latitude+' data-lng = '+hasil.data[i].longitude+' id = "lacakid'+[i]+'">Lacak Pengendara</button></div></div></div></span>';
                            if ($("#IdKurir").text() == hasil.data[i].IdKurir) {
                                $("#area").html(isi)
                            }else{
                                $("#area").append(isi)
                            }
                            locationsAll.push({lat: parseFloat(hasil.data[i].latitude), lng: parseFloat(hasil.data[i].longitude)})
                        }
                        click()
                    }
                });
        }
      function initMap() {
        console.log(locations[0])
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 18,
          // center: { lat: -31.56391, lng: 147.154312 },
          center: locations[0],
        });
        // Create an array of alphabetical characters used to label the markers.
        const labels = "Tracking";
        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        const markers = locations.map((location, i) => {
          return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length],
          });
        });
        // Add a marker clusterer to manage the markers.
        new MarkerClusterer(map, markers, {
          imagePath:
            "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
        });
      }
      // const locations = [
      //   { lat: -31.56391, lng: 147.154312 },
      //   { lat: -33.718234, lng: 150.363181 },
      //   { lat: -33.727111, lng: 150.371124 },
      //   { lat: -33.848588, lng: 151.209834 },
      //   { lat: -33.851702, lng: 151.216968 },
      //   { lat: -34.671264, lng: 150.863657 },
      //   { lat: -35.304724, lng: 148.662905 },
      //   { lat: -36.817685, lng: 175.699196 },
      //   { lat: -36.828611, lng: 175.790222 },
      //   { lat: -37.75, lng: 145.116667 },
      //   { lat: -37.759859, lng: 145.128708 },
      //   { lat: -37.765015, lng: 145.133858 },
      //   { lat: -37.770104, lng: 145.143299 },
      //   { lat: -37.7737, lng: 145.145187 },
      //   { lat: -37.774785, lng: 145.137978 },
      //   { lat: -37.819616, lng: 144.968119 },
      //   { lat: -38.330766, lng: 144.695692 },
      //   { lat: -39.927193, lng: 175.053218 },
      //   { lat: -41.330162, lng: 174.865694 },
      //   { lat: -42.734358, lng: 147.439506 },
      //   { lat: -42.734358, lng: 147.501315 },
      //   { lat: -42.735258, lng: 147.438 },
      //   { lat: -43.999792, lng: 170.463352 },
      // ];
</script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCoX47JuBWAsqKkhyIA1ofM0vufpMfSM&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    <!-- End custom js for this page-->