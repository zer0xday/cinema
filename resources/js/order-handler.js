export default class OrderHandler {
    constructor() {
        this.price = document.querySelector('#order-price');
        this.priceInput = document.querySelector('input[name="total_amount"]');
        this.priceModifiers = document.querySelectorAll('input[data-price]');
        this.selectedPlaces = document.querySelectorAll('.selected-places');
    }

    getPrice(element) {
        const parsedPrice = parseFloat(element.getAttribute('data-price'));

        return !isNaN(parsedPrice) ? parsedPrice : 0.00;
    }

    observePrice() {
        const { selectedPlaces } = this;
        const checkedModifiers = document.querySelectorAll('input[data-price]:checked');
        let newPrice = 0.00;
        let ticketsPrice = 0.00;
        let deliveryPrice = 0.00;

        checkedModifiers.forEach((modifier) => {
            if (modifier.name === 'ticket_type') {
                ticketsPrice = (selectedPlaces.length * this.getPrice(modifier));
            }

            if (modifier.name === 'delivery_method') {
                deliveryPrice = this.getPrice(modifier);
            }

            newPrice = ticketsPrice + deliveryPrice;
            this.price.innerHTML = newPrice.toFixed(2);
        });
    }

    calculateTotalAmount() {
        const {priceModifiers} = this;

        priceModifiers.forEach((priceModifier) => {
            priceModifier.addEventListener('click', () => {
                this.observePrice();
            });
        });
    }

    init() {
        if (!document.querySelector('#order-form')) {
            return;
        }

        this.observePrice();
        this.calculateTotalAmount();
    }
}
