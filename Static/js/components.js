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

                // Setting a default location (Seattle).
                var centerLocation = new google.maps.LatLng(49.2880864, -123.187247);


                var mapOptions = {

                    // Zoom level (city view: 13);
                    zoom: 14,

                    // Disable Google Maps UI, zooming, and panning.
                    disableDefaultUI: true,
                    scrollwheel: false,
                    draggable: false,

                    // Go to default location.
                    center: centerLocation,

                    // Todo: load this as a json object.
                    styles: [{"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},{"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},{"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}]
                };

                // if (navigator.geolocation) {

                //     // Get browser to ask user for current location.
                //     navigator.geolocation.getCurrentPosition(function (position) {

                //         // Center the map on current location.
                //         userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                //         map.setCenter(userLocation);
                //     });
                // }

                // Get map HTML DOM element.
                var mapElement = document.getElementById('map');

                // Render the map.
                var map = new google.maps.Map(mapElement, mapOptions);

                // Slow pan to the right.
                setInterval(function() {
                    map.panBy(1, .5);
                }, 100);

            }
    });
