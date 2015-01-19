/*  components.js
 *  nathancharrois@gmail.com
 *
 *  stand alone site components and elements.
 *
 *
 *  File Upload Component
 *
 *  <div class="file-upload" data-event="select-file">
 *      Upload File
 *  </div>
 *  <input data-target="browse-file" type="file" class="hide" />
 */

    (function($){

        var FileUpload = {

            config: {
                filePath:       null,
                fileUpload:     $('.file-upload'),
                selectFile:     $('[data-event*="select-file"]'),
                dropZone:       $('[data-event*="drop-zone"]')
            },

            init: function(element, config) {
                if(typeof config === 'object') {
                    this.config = config;
                }

                this.config.fileInput = $(element);
                this.setup();
            },

            setup: function() {
                this.bindEvents();
                this.subscriptions();
                this.displayImage();
            },

            displayImage: function() {
                if (this.config.filePath != null) {
                    this.config.fileUpload.hide();
                    $('.file-preview').remove();

                    var imagePreview = $('<img class="file-preview" data-event="select-file">');
                    imagePreview.attr('src', this.config.filePath);
                    imagePreview.appendTo('.file-preview-container');
                }
            },

            bindEvents: function() {

                var el = this.config;

                $('body').on('click', el.selectFile, function(event) {
                    if($(event.target).is('[data-event*="select-file"]')) {
                        event.preventDefault();
                        $.publish('FileUpload/select-file');
                    }
                });

                el.fileInput.on('change', function(event) {
                    $.publish('FileUpload/file-ready');
                });

                // Drag and Drop Events.
                el.dropZone.on('drop dragover dragenter', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    el.selectFile.addClass('active');
                })

                .on('dragleave', function(){
                    el.selectFile.removeClass('active');
                })

                .on('drop', function(event) {
                    el.selectFile.removeClass('active');

                    el.droppedFile = event.originalEvent.dataTransfer.files;

                    $.publish('FileUpload/file-ready');
                });
            },

            subscriptions: function() {
                $.subscribe('FileUpload/select-file', this.browseForFile);
                $.subscribe('FileUpload/file-ready', this.uploadFile);
            },

            getFileData: function() {
                var el = FileUpload.config;

                if(el.droppedFile != null) {
                    return el.droppedFile[0];
                }

                return el.fileInput[0].files[0];
            },

            browseForFile: function() {
                FileUpload.config.fileInput.click();
            },

            uploadFile: function() {

                var formData = new FormData();
                var file = FileUpload.getFileData();

                formData.append('files', file);

                $.ajax({
                    type: 'POST',
                    /* live: url: '/file/add_profile_photo', */
                    url: window.Urbn.config.rootPath + 'file/add_profile_photo',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function() {
                        FileUpload.renderLoader();
                    },
                    success: function(response) {
                        if(response.length) {
                            FileUpload.config.filePath = response;
                            FileUpload.displayImage();
                            FileUpload.config.droppedFile = null;
                        }

                        else{
                            FileUpload.renderError();
                        }
                    }
                });
            },

            renderLoader: function() {
                var fileUpload = FileUpload.config;
                fileUpload.fileUpload.find('i').attr('class', 'fa fa-spinner fa-spin');
                fileUpload.selectFile.show();
                $('.file-preview').remove();
            },

            renderError: function() {
                var fileUpload = FileUpload.config;
                fileUpload.selectFile.addClass('error');
                fileUpload.fileUpload.find('i').attr('class', 'fa fa-exclamation-triangle');
                fileUpload.fileInput.val('');
                fileUpload.selectFile.show();
                $('.file-preview').remove();
            }
        };

        $.fn.fileupload = function(config) {
            return this.each(function() {
                window.FileUpload = FileUpload.init(this, config);
            });
        }

        window.Urbn = window.Urbn || {};

    })(jQuery);

/*  Star Ratings Component
 *
 *  <div class="star-rating">
 *      <span class="fa fa-star" data-rating="1"></span>
 *      <span class="fa fa-star" data-rating="2"></span>
 *      <span class="fa fa-star" data-rating="3"></span>
 *      <span class="fa fa-star" data-rating="4"></span>
 *      <span class="fa fa-star" data-rating="5"></span>
 *      <input type="hidden" name="rating-value" value="3">
 *  </div>
 */

    (function($){

        var StarRating = {

            data: {
                enabled: true,
                element: null,
                rating: null,
                category: null,
                maxRating: 5
            },

            init: function(element) {
                this.data.element = element;
                this.data.rating = $(element).attr('data-rating');
                this.data.category = $(element).attr('data-category');
                this.data.item = $(element).attr('data-item');
                this.setup();
            },

            setup: function() {
                this.bindEvents();
                this.createStars();
                this.setRating();
            },

            bindEvents: function() {
                var self = this;

                $(this.data.element).on('click', function(event) {
                    self.submitRating(event);
                });

                $(this.data.element).on('mouseover', function(event) {
                    self.highlightStars(event);
                });

                $(this.data.element).on('mouseout', function(event) {
                    self.unHighlightStars(event);
                });
            },

            createStars: function() {
                for (var i = 0; i < this.data.maxRating; i++) {
                    var template = jQuery('<span />', {
                        'class': 'fa fa-star rating',
                        'data-rating': (i + 1)
                    });

                    $(this.data.element).append(template);
                };
            },

            setRating: function(rating) {
                var number = rating || this.data.rating;
                $(this.data.element).children("span:lt("+number+")").addClass('rating-active');
            },

            highlightStars: function(event) {
                if(this.data.enabled) {
                    var rating = $(event.target).attr('data-rating');

                    if(rating) {
                        //$(event.target).nextAll().andSelf().removeClass('rating-active')
                        $(event.target).prevAll().andSelf().addClass('rating-hover')
                    }
                }
            },

            unHighlightStars: function(event) {
                var rating = $(event.target).attr('data-rating');

                if(rating) {
                    //$(this.data.element).children("span:lt("+number+")").addClass('rating-active');
                    $(event.target).prevAll().andSelf().removeClass('rating-hover');
                }
            },

            submitRating: function(event) {
                if(this.data.enabled) {
                    var rating = $(event.target).attr('data-rating');
                    var self = this;

                    if(rating !== "undefined") {
                        $.ajax({
                            type: 'POST',
                            contentType: 'JSON',
                            url: window.Urbn.config.rootPath + 'rating/submit/' + rating,
                            success: function(response) {
                                if(response.success) {
                                    self.complete(event);
                                    self.disable();
                                }
                            }
                        });
                    }
                }
            },

            complete: function(event) {
                var template = jQuery('<span />', {
                    'class': 'fa fa-check-circle rating-success'
                });
                $(event.target).siblings().removeClass('rating-active');
                $(event.target).prevAll().andSelf().addClass('rating-active');
                $(event.target).parent().append(template);
            },

            disable: function(event) {
                this.data.enabled = false;
            }
        };

        $.fn.starrating = function() {
            return this.each(function() {
                window.StarRating = StarRating.init(this);
            });
        }

        window.Urbn = window.Urbn || {};

    })(jQuery);

/*  Google Maps Component
 *
 *  <div id="map"></div>
 */
    $(function(){

        /**
         *  Get map event.
         *
         *  <div id="map" data-map-event="pan"></div>
         */
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

        /*  Get map event.
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

        /*  Set map components
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

        /*  Get map options.
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

        /*  Get (random) city coordinates.
         */
            function getCityCoordinates() {

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

        /*  Create marker at center location.
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

        /*  Get address.
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

        // Load the map when the page has loaded.
        google.maps.event.addDomListener(window, 'load', loadMap);
    });
