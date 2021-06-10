export default class PlacesHandler {
    constructor() {
        this.places = document.querySelectorAll('.place');
        this.rowInput = document.querySelector('input[name="row"]');
        this.placeNumberInput = document.querySelector('input[name="place_number"]');
        this.orderBtn = document.querySelector('#order-btn');
        this.form = document.querySelector('form#order-ticket');
    }

    handlePlacesData(element, forceClear = false) {
        const {rowInput, placeNumberInput, orderBtn} = this;

        if (forceClear) {
            rowInput.value = '';
            placeNumberInput.value = '';
            orderBtn.classList.add('disabled');

            return;
        }

        const row = element.getAttribute('data-row');
        const placeNumber = element.getAttribute('data-place-number');

        rowInput.value = row;
        placeNumberInput.value = placeNumber;
        orderBtn.classList.remove('disabled');
    }

    handlePlaceSelected(element) {
        const alreadySelected = document.querySelector('.place.selected');

        if (!alreadySelected) {
            element.classList.add('selected');
            this.handlePlacesData(element);

            return;
        }

        if (alreadySelected === element) {
            element.classList.remove('selected');
            this.handlePlacesData(element, true);

            return;
        }

        alreadySelected.classList.remove('selected');
        element.classList.add('selected');
        this.handlePlacesData(element);
    }

    handleSelected() {
        const {places} = this;

        places.forEach((place) => {
            place.addEventListener('click', (e) => {
                this.handlePlaceSelected(e.currentTarget);
            });
        });
    }

    validateForm() {
        const {form, rowInput, placeNumberInput} = this;

        form.addEventListener('submit', (e) => {
            if (!rowInput.value || !placeNumberInput.value) {
                e.preventDefault();
            }
        });
    }

    init() {
        if (!this.places.length) {
            return;
        }

        this.handleSelected();
        this.validateForm();
        // trzeba pomyślec nad obsługą kilku miejsc na raz
        // dodać sprawdzanie fetchem czy miejsce jest juz zarezerwowane przez kogoś innego
    }
}
