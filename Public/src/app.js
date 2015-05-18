define(function(require) {

    var InterfaceController = require('interfaceController');

    function App() {
        this.interface = new InterfaceController();
    }

    return App;
});