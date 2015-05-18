define(function(require) {

    var $ = require('jquery');

    'use strict';

    /**
     * Dropdown Component
     * @author nathancharrois@gmail.com
     */
    function Dropdown() {
        this.$viewPort = $(window);
        this.$toggle = $('.dropdown');
        this.$menu = $('.dropdown-menu');
        this.menu = '.dropdown-menu';

        this.bindEvents();
    }

    Dropdown.prototype.bindEvents = function() {
        var self = this;

        self.$toggle.on('click', function(e) {

            var $thisMenu = $(this).find(self.menu);

            // Hide other open menus.
            self.$menu.not($thisMenu).hide();
            $thisMenu.toggle();

            return false;
        });

        self.$menu.on('click', function(e) {
            e.stopPropagation();
        });

        self.$viewPort.on('click resize', function() {
            self.$menu.hide();
        });
    }

    return Dropdown;
});