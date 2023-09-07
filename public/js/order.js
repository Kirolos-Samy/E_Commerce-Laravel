// Find all quantity control containers on the page
const quantityControls = document.querySelectorAll('.quantity-control');

quantityControls.forEach((control) => {
    const decrementBtn = control.querySelector('.quantity-decrement');
    const incrementBtn = control.querySelector('.quantity-increment');
    const quantityInput = control.querySelector('.quantity-input');

    decrementBtn.addEventListener('click', () => {
        // Decrease the quantity by 1, but ensure it's not less than the minimum value (1)
        let currentQuantity = parseInt(quantityInput.value, 10);
        if (currentQuantity > quantityInput.min) {
            currentQuantity--;
            quantityInput.value = currentQuantity;
        }
    });

    incrementBtn.addEventListener('click', () => {
        // Increase the quantity by 1
        let currentQuantity = parseInt(quantityInput.value, 10);
        if(currentQuantity < quantityInput.max){
            currentQuantity++;
            quantityInput.value = currentQuantity;
        }
    });


});
