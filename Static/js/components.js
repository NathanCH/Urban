/*  components.js
 *  nathancharrois@gmail.com
 *
 *  standalonne site components and elements.
 */

    $(function(){

        /**
         *  Google Maps
         *
         *  <div id="map"></div>
         */
            // Load the map when the page has loaded.
            google.maps.event.addDomListener(window, 'load', loadMap);

            function loadMap() {

                // Get map options.
                var options = getMapOptions();

                // Get map HTML DOM element.
                var element = document.getElementById('map');

                // Render the map.
                var map = new google.maps.Map(element, options);

                // Get map event type.
                getMapEvent(map);

                // Set an map components on the page. (ie. search location).
                setMapComponents(map);

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

                            var place = autocomplete.getPlace();
                            var x = place.geometry.location.lat()
                            var y = place.geometry.location.lng();

                           mapElement.setCenter({lat: x, lng: y});
                           mapElement.setOptions({zoom:15})

                            console.log(x);
                            console.log(y);

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
    });