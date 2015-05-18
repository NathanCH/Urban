define(function(require) {

    var Dropdown            = require('component/dropdown');
    var ToggleCheckBox      = require('component/toggleCheckBox');
    var ToggleSelect        = require('component/toggleSelect');
    var StarRating          = require('component/starRating');
    var FileUpload          = require('component/fileUpload');
    var ScrapMap            = require('component/scrapMap');

    function InterfaceController() {
        this.dropdown = new Dropdown();
    }

    return InterfaceController;
});