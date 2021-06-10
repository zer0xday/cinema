require('./bootstrap');
import PlacesHandler from "./places-handler";
import OrderHandler from "./order-handler";

class App {
    init() {
        new PlacesHandler().init();
        new OrderHandler().init();
    }
}

new App().init();
