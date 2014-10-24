/*  components.js
 *  nathancharrois@gmail.com
 *
 *  stand alone site components and elements.
 */

    /**
     *  File Upload Component
     *
     *  <div class="file-upload" data-event="select-file">
     *      Upload File
     *  </div>
     *  <input data-target="browse-file" type="file" class="hide" />
     */
        $(function(){

            var selectFile = $('[data-event*="select-file"]');
            var fileInput = $('[data-target*="browse-file"]');

            // Click to browse for file.
            selectFile.click(function(){
                fileInput.click();
            });


            // Trigger upload via file selection.
            fileInput.change(function(event){
                var file = this.files[0];

                renderPreview(file);
            });


            // Trigger upload via drag and drop.
            selectFile.on("drop dragleave dragover dragenter", function(event){

                // Prevent browser from rendering file.
                event.preventDefault();
                event.stopPropagation();

            }).on("drop", function(event){
                var file = event.originalEvent.dataTransfer.files;

                renderPreview(file[0]);
            });


            // Close image preview.
            $('.close-preview').click(function(){
                selectFile.show();
                $('.file-preview').remove();
                $(this).hide();
            });


            // Render image preview.
            var renderPreview = function(file){

                if(file) {

                    var reader = new FileReader();

                    // Create image element with image preview.
                    reader.onload = function(event) {

                        var file = event.target.result;
                        var fileType = file.split(",")[0].split(":")[1].split(";")[0].split("\/")[1];
                        var fileTypes = [
                            "jpeg",
                            "png",
                            "gif"
                        ];

                        // Check file type.
                        if(fileTypes.indexOf(fileType) > -1) {

                            // Hide uploader.
                            $(selectFile).hide();

                            // Hide uploader.
                            $('.close-preview').show();

                            // Create image preview.
                            var imagePreview = $('<img class="file-preview">');
                            imagePreview.attr('src', file);
                            imagePreview.appendTo('.file-upload-container');
                        }

                        // Incorrect file type.
                        else{
                            console.log('hey');
                            selectFile.addClass('error');
                            $('.file-upload i').attr('class', 'fa fa-exclamation-triangle')
                        }
                    }

                    reader.readAsDataURL(file);
                }
            }


        });

    /**
     *  Google Maps Component
     *
     *  <div id="map"></div>
     */
        $(function(){

                // Load the map when the page has loaded.
                google.maps.event.addDomListener(window, 'load', loadMap);

                function loadMap() {

                    // Get map options.
                    var options = getMapOptions();

                    // Get map HTML DOM element.
                    var element = document.getElementById('map');

                    // If map element exists.
                    if(element) {

                        // Render the map.
                        var map = new google.maps.Map(element, options);

                        // Get map event type.
                        getMapEvent(map);

                        // Set an map components on the page. (ie. search location).
                        setMapComponents(map);
                    }
                }

            /**
             *  Get map event.
             *
             *  <div id="map" data-map-event="pan"></div>
             */
                function getMapEvent(mapElement) {

                    // Get map type from HTML element.
                    var mapEvent = $('#map').attr('data-map-event');

                    // Pan.
                    if(mapEvent == 'pan') {

                       // Slow pan to the right.
                        setInterval(function() {
                            mapElement.panBy(1, .5);
                        }, 120);
                    }

                    // Draggable Marker updates long lat data.
                    else if(mapEvent == 'create-marker') {

                        $('.create-marker').click(function() {
                            createMarker(mapElement);
                        });

                    }
                }

            /**
             *  Set map components
             *
             *  <div data-map-component="search-location"></div>
             */
                function setMapComponents(mapElement) {

                    // Get map component from HTML element.
                    var mapComponent = $('input').attr('data-map-component');

                    // Search Location
                    if(mapComponent == 'search-location') {

                        var input = document.getElementById(mapComponent);

                        // Google Places API Auto Complete.
                        autocomplete = new google.maps.places.Autocomplete(input);

                        // Watch for 'place_changed' event listener.
                        google.maps.event.addListener(autocomplete, 'place_changed', function() {

                            // Get place's data.
                            var place   = autocomplete.getPlace();
                            var x       = place.geometry.location.lat()
                            var y       = place.geometry.location.lng();
                            var address = place.formatted_address;

                            // Center map and set new zoom level.
                            mapElement.setCenter({lat: x, lng: y});

                            // Update hidden inputs.
                            $('#coordinate-x').val(x);
                            $('#coordinate-y').val(y);
                            $('#address').val(address);

                            // Create marker at location.
                            createMarker(mapElement);
                        });

                        // Return false on pressing 'enter'.
                        $('#search-location').keypress(function(e) {
                            if (e.which == 13) {
                                return false;
                            }
                        });
                    }
                }

            /**
             *  Get map options.
             *
             *  <div id="map" data-map-type="basic"></div>
             */
                function getMapOptions() {

                    // Get map type from HTML element.
                    var mapType = $('#map').attr('data-map-type');

                    // Get city coordinates.
                    var coordinates = getCityCoordinates();

                    // Setting a default location (Seattle).
                    var centerLocation = new google.maps.LatLng(coordinates.x, coordinates.y);

                    switch (mapType) {

                        case 'basic' :

                            // Set map options.
                            var options = {

                                // Zoom level (city view: 13);
                                zoom: 14,

                                // Disable Google Maps UI, zooming, and panning.
                                disableDefaultUI: true,

                                // Go to default location.
                                center: centerLocation,

                                // Map style.
                                // Todo: load this as a json object.
                                styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":60}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"lightness":30}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ef8c25"},{"lightness":40}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#b6c54c"},{"lightness":40},{"saturation":-40}]},{}]
                            };
                        break;

                        case 'subtle':
                            var options = {
                                zoom: 14,
                                disableDefaultUI: true,
                                scrollwheel: false,
                                draggable: false,
                                center: centerLocation,
                                styles: [{"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},{"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},{"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}]
                            };
                        break;
                    }

                    return options;
                }

            /**
             *  Get (random) city coordinates.
             */
                function getCityCoordinates(type) {

                    // List of Cities.
                    var cities = {

                        'Vancouver' : {
                            'x' : '49.2880864',
                            'y' : '-123.187247'
                        },

                        'Seattle' : {
                            'x' : '47.6035025',
                            'y' : '-122.3560898'
                        },

                        'Auckland' : {
                            'x' : '-36.8385524',
                            'y' : '174.7062437'
                        },

                        'Oslo' : {
                            'x' : '59.9079518',
                            'y' : '10.6683868'
                        },

                        'Stockholm' : {
                            'x' : '59.3282076',
                            'y' : '18.0327551'
                        }

                    }

                    var  tempKey,
                         keys = [];

                    // Iterate through properties of the object and assign to array.
                    for(tempKey in cities) {
                       if(cities.hasOwnProperty(tempKey)) {
                           keys.push(tempKey);
                       }
                    }

                    // Get random city coordinates.
                    var cityCoordinates = cities[keys[Math.floor(Math.random() * keys.length)]];

                    return cityCoordinates;
                }

            /**
             *  Create marker at center location.
             */
                function createMarker(mapElement) {

                    // Create marker.
                    var marker = new google.maps.Marker({
                        position: mapElement.getCenter(),
                        map: mapElement,
                        draggable:true
                    });

                    // Get center coordinates.
                    var x = marker.position.lat();
                    var y = marker.position.lng();

                    $('#coordinate-x').val(x);
                    $('#coordinate-y').val(y);

                    // Get address at this location.
                    getAddress(marker.position);

                    // Update coordinates when dragged.
                    google.maps.event.addListener(marker, 'dragend', function() {

                        var x = marker.position.lat();
                        var y = marker.position.lng();

                        $('#coordinate-x').val(x);
                        $('#coordinate-y').val(y);

                        getAddress(marker.position);

                    });
                }

            /**
             *  Get address.
             */
                function getAddress(latlng) {

                    $('.loader').fadeIn(50);
                    $('#submit').attr('disabled', 'disabled');

                    var geocoder = new google.maps.Geocoder();

                    // Reverse Geocode latling.
                    geocoder.geocode({ 'latLng': latlng }, function (results, status) {

                        // If status is okay.
                        if (status == google.maps.GeocoderStatus.OK) {

                            var state;
                            var city;
                            var street_number;

                            // Iterate trough multi-dimensional array of results data.
                            for (var x = 0, length_1 = results.length; x < length_1; x++){

                                for (var y = 0, length_2 = results[x].address_components.length; y < length_2; y++){

                                    // Type of address.
                                    var type = results[x].address_components[y].types[0];

                                    if (type === "administrative_area_level_1") {
                                        state = results[x].address_components[y].long_name;
                                        if (city) break;

                                    }

                                    else if(type === "locality") {
                                        city = results[x].address_components[y].long_name;
                                        if (state) break;
                                    }

                                    else if(type === "street_number") {
                                        street_number = results[x].address_components[y].long_name;
                                    }
                                }
                            }

                            // Update fields with address.
                            $('#search-location').val(street_number + ', ' + city + ', ' + state);
                            $('#address').val(street_number + ', ' + city + ', ' + state);

                            $('.loader').fadeOut(150);
                            $('#submit').removeAttr('disabled');
                        }
                    });

                }
        });
