export default class PlacesHandler {
    constructor() {
        this.placesContainer = document.querySelectorAll('.place');
        this.places = document.querySelector('input[name="places"]');
        this.orderBtn = document.querySelector('#order-btn');
        this.form = document.querySelector('form#order-ticket');
        this.selectedPlaces = [];
    }

    handlePlacesData(element, forceClear = false) {
        const {orderBtn, places} = this;

        const row = element.getAttribute('data-row');
        const placeNumber = element.getAttribute('data-place-number');
        const key = `${row}:${placeNumber}`;

        if (forceClear) {
            this.selectedPlaces = this.selectedPlaces.filter((value) => value !== key);
        } else {
            this.selectedPlaces.push(key);
        }

        places.value = this.selectedPlaces;

        orderBtn.classList.toggle('disabled', !places.value);
    }

    handlePlaceSelected(element) {
        const alreadySelected = document.querySelectorAll('.place.selected');

        if (element.classList.contains('taken')) {
            return;
        }

        if ([...alreadySelected].includes(element)) {
            element.classList.remove('selected');
            this.handlePlacesData(element, true);

            return;
        }

        element.classList.add('selected');
        this.handlePlacesData(element);
    }

    handleSelected() {
        const {placesContainer} = this;

        placesContainer.forEach((place) => {
            place.addEventListener('click', (e) => {
                this.handlePlaceSelected(e.currentTarget);
            });
        });
    }

    validateForm() {
        const {form, places} = this;

        form.addEventListener('submit', (e) => {
            if (!places.value) {
                e.preventDefault();
            }
        });
    }

    init() {
        if (!this.placesContainer.length) {
            return;
        }

        this.handleSelected();
        this.validateForm();
    }
}
