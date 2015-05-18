define(function(require) {
    var $ = require('jquery');

    //Rewrite all this.
    function loadMap() {

        var options = getMapOptions();
        var element = document.getElementById('map');

        if(element) {

            var map = new google.maps.Map(element, options);

            getMapEvent(map);
            setMapComponents(map);
        }
    }

    function getMapEvent(mapElement) {

        var mapEvent = $('#map').attr('data-map-event');

        if(mapEvent == 'pan') {
            setInterval(function() {
                mapElement.panBy(1, .5);
            }, 120);
        }

        else if(mapEvent == 'create-marker') {
            $('.create-marker').click(function() {
                createMarker(mapElement);
            });
        }
    }

    function setMapComponents(mapElement) {

        var mapComponent = $('input').attr('data-map-component');

        if(mapComponent == 'search-location') {

            var input = document.getElementById(mapComponent);

            autocomplete = new google.maps.places.Autocomplete(input);

            google.maps.event.addListener(autocomplete, 'place_changed', function() {

                var place   = autocomplete.getPlace();
                var x       = place.geometry.location.lat()
                var y       = place.geometry.location.lng();
                var address = place.formatted_address;

                mapElement.setCenter({lat: x, lng: y});

                $('#coordinate-x').val(x);
                $('#coordinate-y').val(y);
                $('#address').val(address);

                createMarker(mapElement);
            });

            $('#search-location').keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        }
    }

    function getMapOptions() {

        var mapType = $('#map').attr('data-map-type');
        var coordinates = getCityCoordinates();

        var centerLocation = new google.maps.LatLng(coordinates.x, coordinates.y);

        switch (mapType) {

            case 'basic' :

                var options = {
                    zoom: 14,
                    disableDefaultUI: true,
                    center: centerLocation,
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


    function getCityCoordinates() {

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

        for(tempKey in cities) {
           if(cities.hasOwnProperty(tempKey)) {
               keys.push(tempKey);
           }
        }

        var cityCoordinates = cities[keys[Math.floor(Math.random() * keys.length)]];

        return cityCoordinates;
    }


    function createMarker(mapElement) {

        var marker = new google.maps.Marker({
            position: mapElement.getCenter(),
            map: mapElement,
            draggable:true
        });

        var x = marker.position.lat();
        var y = marker.position.lng();

        $('#coordinate-x').val(x);
        $('#coordinate-y').val(y);

        getAddress(marker.position);
        google.maps.event.addListener(marker, 'dragend', function() {

            var x = marker.position.lat();
            var y = marker.position.lng();

            $('#coordinate-x').val(x);
            $('#coordinate-y').val(y);

            getAddress(marker.position);

        });
    }

    function getAddress(latlng) {

        $('.loader').fadeIn(50);
        $('#submit').attr('disabled', 'disabled');

        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'latLng': latlng }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var state;
                var city;
                var street_number;

                for (var x = 0, length_1 = results.length; x < length_1; x++){

                    for (var y = 0, length_2 = results[x].address_components.length; y < length_2; y++){

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

                $('#search-location').val(street_number + ', ' + city + ', ' + state);
                $('#address').val(street_number + ', ' + city + ', ' + state);

                $('.loader').fadeOut(150);
                $('#submit').removeAttr('disabled');
            }
        });

    }

    google.maps.event.addDomListener(window, 'load', loadMap);
});