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

                coordinates = getRandomCoordinates();

                // Setting a default location (Seattle).
                var centerLocation = new google.maps.LatLng(coordinates.x, coordinates.y);

                var options = {

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

                // Get map HTML DOM element.
                var element = document.getElementById('map');

                // Render the map.
                var map = new google.maps.Map(element, options);

                // Slow pan to the right.
                setInterval(function() {
                    map.panBy(1, .5);
                }, 125);

            }

            function getRandomCoordinates(type) {

                // List of Cities.
                var cities = {

                    'Vancouver' : {
                        'x' : '49.2880864',
                        'y' : '-123.187247'
                    },

                    'Toyko' : {
                        'x' : '35.6521438',
                        'y' : '139.7151945'
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
   console.log(cityCoordinates.x);
                return cityCoordinates;
            }
    });
