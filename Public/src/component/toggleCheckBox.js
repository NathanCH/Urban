define(function(require) {

    var $ = require('jquery');

    'use strict';

    /**
     * Toggle Checkbox
     *
     * <input type="hidden" name="my-checkbox" data-input="unique_name" value="0" />
     * <label class="input-checkbox-label">
     *     <span class="input-checkbox" data-input="unique_name"></span>
     *     Remember Me?
     * </label>
     */
    function ToggleCheckBox(element){

        this.$element = $(element);
        this.uniqueID = this.getElementID();
        this.$input = $('input[data-input="'+this.uniqueID+'"]');
        this.toggleValue = (this.$input.val() == 0) ? 1 : 0;

        this.bindEvents();
    }

    ToggleCheckBox.prototype.bindEvents = function() {

        var self = this;

        self.$element.on('click', function(e) {
            self.setStatus(self.toggleValue);
        });
    }

    ToggleCheckBox.prototype.getElementID = function() {
        this.$element.children('span').attr('data-input');
    }

    ToggleCheckBox.prototype.setStatus = function(status) {
        this.$input.val(status);
        this.$element.find('.input-checkbox').toggleClass('active');
    }

    $.fn.toggleCheckBox = function() {
        return this.each(function() {
            new ToggleCheckBox(this);
        });
    }

    $('.input-checkbox-label').toggleCheckBox();
});