define(function(require) {
    var $ = require('jquery');

        var StarRating = {

        data: {
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
                self.addHighlight(event);
            });

            $(this.data.element).on('mouseout', function(event) {
                self.removeHighlight(event);
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

        addHighlight: function(event) {
            if(this.isEnabled()) {
                var rating = $(event.target).attr('data-rating');

                if(rating) {
                    //$(event.target).nextAll().andSelf().removeClass('rating-active')
                    $(event.target).prevAll().andSelf().addClass('rating-hover')
                }
            }
        },

        removeHighlight: function(event) {
            var rating = $(event.target).attr('data-rating');

            if(rating) {
                //$(this.data.element).children("span:lt("+number+")").addClass('rating-active');
                $(event.target).prevAll().andSelf().removeClass('rating-hover');
            }
        },

        submitRating: function(event) {
            if(this.isEnabled()) {
                var rating = $(event.target).attr('data-rating');
                var self = this;

                if(typeof rating !== "undefined") {
                    $.ajax({
                        type: 'POST',
                        contentType: 'JSON',
                        url: '/2014/urban/rating/submit/' + rating,
                        success: function(response) {
                            if(response.success) {
                                self.complete(event);
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
            $(event.target).parent().find('.rating-success').remove();
            $(event.target).parent().append(template);
        },

        isEnabled: function() {
            return true;
        }
    };

    $.fn.starrating = function() {
        return this.each(function() {
            StarRating.init(this);
        });
    }

    $(document).ready(function() {
        $('.star-rating').starrating();
    });
});