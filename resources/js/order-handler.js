export default class OrderHandler {
    constructor() {
        this.price = document.querySelector('#order-price');
        this.priceInput = document.querySelector('input[name="total_amount"]');
        this.priceModifiers = document.querySelectorAll('input[data-price]');
    }

    getPrice(element) {
        const parsedPrice = parseFloat(element.getAttribute('data-price'));

        return !isNaN(parsedPrice) ? parsedPrice : 0.00;
    }

    observePrice() {
        this.price.innerHTML = '0.00';

        this.priceModifiers.forEach((modifier) => {
            if (modifier.checked) {
                const actualPrice = parseFloat(this.price.innerHTML);
                const newPrice = actualPrice + this.getPrice(modifier);

                this.price.innerHTML = newPrice.toFixed(2);
            }
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
