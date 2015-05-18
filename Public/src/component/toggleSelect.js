define(function(require) {
    var $ = require('jquery');

    'use strict';

    function ToggleSelect(element) {
        this.$element = $(element);
        this.string = this.$element.find('selected').text();

        this.$element.bind('change', {context: this}, this.toggle)
                     .trigger('change');
    }

    ToggleSelect.prototype.toggle = function(e) {
        var string = e.data.context.getString(this);
        $('.select-container .select-text').text(string);
    }

    ToggleSelect.prototype.getString = function(element) {
        return $(element).find(':selected').text();
    }

    $.fn.toggleSelect = function() {
        return this.each(function() {
            new ToggleSelect(this);
        });
    }

    $('.select-container select').toggleSelect();
});