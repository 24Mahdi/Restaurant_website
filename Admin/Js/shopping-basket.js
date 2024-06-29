document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.items');
    const priceElement = document.getElementById('price');
    const totalElement = document.getElementById('total');
    const shippingCost = 5.00;
    let price = 0.00;

    function calculateTotal() {
        price = 0.00;
        items.forEach(item => {
            const id = item.dataset.id;
            const qty = parseFloat(item.querySelector('.qty').value) || 0; // Ensure qty is a number
            const prodPrice = parseFloat(item.querySelector('.prodTotal p').innerText.replace('IQ ', ''));
            price += qty * prodPrice;
            localStorage.setItem(`itemQty_${id}`, qty); // Save quantity for each item
        });
        localStorage.setItem('cartPrice', price.toFixed(2));
        localStorage.setItem('cartTotal', (price + shippingCost).toFixed(2));
        priceElement.innerText = `IQ ${price.toFixed(2)}`;
        totalElement.innerText = `IQ ${(price + shippingCost).toFixed(2)}`;
    }

    items.forEach(item => {
        const id = item.dataset.id;
        const input = item.querySelector('.qty');
        const savedQty = localStorage.getItem(`itemQty_${id}`);
        if (savedQty !== null) {
            input.value = savedQty;
        }
        input.addEventListener('change', () => {
            if (input.value < 0) {
                input.value = 0; // Ensure non-negative values
            }
            calculateTotal();
        });
    });

    function loadFromLocalStorage() {
        const savedPrice = localStorage.getItem('cartPrice');
        const savedTotal = localStorage.getItem('cartTotal');
        if (savedPrice !== null) {
            priceElement.innerText = `IQ ${savedPrice}`;
        }
        if (savedTotal !== null) {
            totalElement.innerText = `IQ ${savedTotal}`;
        }
    }

    loadFromLocalStorage();
    calculateTotal();
});