// search.js


document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('search');
    const searchResults = document.getElementById('search-results');
    const productDisplayContainer = document.getElementById('product-display-container');

    searchInput.addEventListener('input', function () {
        const query = this.value;

        // Make an AJAX request to your Laravel backend
        axios.get(`/search?q=${query}`)
            .then((response) => {
                const products = response.data;

                // Clear previous results
                searchResults.innerHTML = '';

                if (products.length === 0) {
                    searchResults.innerHTML = 'No results found.';
                } else {
                    // Hide the product display container when there are search results
                    productDisplayContainer.style.display = 'none';

                    products.forEach((product) => {
                        // Create a result item container
                        const resultItem = document.createElement('div');
                        resultItem.classList.add('item-card');

                        // Construct the HTML for each search result
                        resultItem.innerHTML = `
                            <img src="images/${product.image}" alt="" class="card-img">
                            <div class="card-content">
                                <p class="card-title">${product.name}</p>
                                <p class="card-desc">${product.desc}</p>
                                <div class="price-and-btn">
                                    ${product.quantity > 0 ? `
                                        ${product.in_cart ? `
                                            <p class="card-price-add">$${product.sell_price}</p>
                                            <form action="{{ route('products.rcart', ${product.id}) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button class="mybtn-add">Added to Cart</button>
                                            </form>
                                        ` : `
                                            <p class="card-price">$${product.sell_price}</p>
                                            <form action="${addToCartRoute.replace(':productId', product.id)}" method="POST">
                                                @csrf
                                                <button class="mybtn">Add to Cart</button>
                                            </form>
                                        `}
                                    ` : `
                                        <p class="card-price-err">$${product.sell_price}</p>
                                        <p class="err">Out of Stock</p>
                                    `}
                                </div>
                            </div>
                        `;

                        // Append the result item to the search results container
                        searchResults.appendChild(resultItem);
                    });
                }
            })
            .catch((error) => {
                console.error(error);
            });
    });
});









// function addToCart(productId) {
//     const form = document.createElement('form');
//     form.action = addToCartRoute.replace(':productId', productId);
//     form.method = 'POST';
//     form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}" />';

//     const button = document.createElement('button');
//     button.className = 'mybtn';
//     button.textContent = 'Add to Cart';

//     form.appendChild(button);
//     document.body.appendChild(form);
//     form.submit();
// }

// document.addEventListener("DOMContentLoaded", function () {
//     const searchInput = document.getElementById('search');
//     const searchResults = document.getElementById('search-results');
//     const addToCartRoute = "{{ route('products.cart', ['product' => ':productId']) }}";
//     productDisplayContainer = document.getElementById('product-container');

//     searchInput.addEventListener('input', function () {
//         const query = this.value;

//         // Make an AJAX request to your Laravel backend
//         axios.get(`/search?q=${query}`)
//             .then((response) => {
//                 const products = response.data;

//                 // Clear previous results
//                 searchResults.innerHTML = '';

//                 if (products.length === 0) {
//                     searchResults.innerHTML = 'No results found.';
//                 } else {
//                     productDisplayContainer.style.display = 'none';
//                     products.forEach((product) => {
//                         // Create a result item container
//                         const resultItem = document.createElement('div');
//                         resultItem.classList.add('item-card');

//                         // Construct the HTML for each search result
//                         resultItem.innerHTML = `
//     <img src="images/${product.image}" alt="" class="card-img">
//     <div class="card-content">
//         <p class="card-title">${product.name}</p>
//         <p class="card-desc">${product.desc}</p>
//         <div class="price-and-btn">
//             ${product.quantity > 0 ? `
//                 ${product.in_cart ? `
//                     <p class="card-price-add">$${product.sell_price}</p>
//                     <form action="{{ route('products.rcart', ${product.id}) }}" method="POST">
//                         @method('PUT')
//                         @csrf
//                         <button class="mybtn-add">Added to Cart</button>
//                     </form>
//                 ` : `
//                     <p class="card-price">$${product.sell_price}</p>
//                     <form method="POST">
//                         @csrf
//                         <button class="mybtn" onclick="addToCart(${product.id})">Add to Cart</button>
//                     </form>
//                 `}
//             ` : `
//                 <p class="card-price-err">$${product.sell_price}</p>
//                 <p class="err">Out of Stock</p>
//             `}
//         </div>
//     </div>
// `;


//                         // Append the result item to the search results container
//                         searchResults.appendChild(resultItem);
//                     });
//                 }
//             })
//             .catch((error) => {
//                 console.error(error);
//             });
//     });
// });

// document.addEventListener("DOMContentLoaded", function () {
//     const searchInput = document.getElementById('search');
//     const productContainer = document.getElementById('product-container');
//     const addToCartRoute = "{{ route('products.cart', ['product' => ':productId']) }}";

//     searchInput.addEventListener('input', function () {
//         const query = this.value;

//         // Make an AJAX request to your Laravel backend
//         axios.get(`/search?q=${query}`)
//             .then((response) => {
//                 const products = response.data;

//                 // Clear existing product cards
//                 productContainer.innerHTML = '';

//                 if (products.length === 0) {
//                     productContainer.innerHTML = 'No results found.';
//                 } else {
//                     products.forEach((product) => {
//                         // Create a result item container
//                         const resultItem = document.createElement('div');
//                         resultItem.classList.add('item-card');

//                         // Construct the HTML for each search result
//                         resultItem.innerHTML = `
//                             <img src="images/${product.image}" alt="" class="card-img">
//                             <div class="card-content">
//                                 <p class="card-title">${product.name}</p>
//                                 <p class="card-desc">${product.desc}</p>
//                                 <div class="price-and-btn">
//                                     ${product.quantity > 0 ? `
//                                         ${product.in_cart ? `
//                                             <p class="card-price-add">$${product.sell_price}</p>
//                                             <form action="{{ route('products.rcart', ${product.id}) }}" method="POST">
//                                                 @method('PUT')
//                                                 @csrf
//                                                 <button class="mybtn-add">Added to Cart</button>
//                                             </form>
//                                         ` : `
//                                             <p class="card-price">$${product.sell_price}</p>
//                                             <form action="${addToCartRoute.replace(':productId', product.id)}" method="POST">
//                                                 @csrf
//                                                 <button class="mybtn">Add to Cart</button>
//                                             </form>
//                                         `}
//                                     ` : `
//                                         <p class="card-price-err">$${product.sell_price}</p>
//                                         <p class="err">Out of Stock</p>
//                                     `}
//                                 </div>
//                             </div>
//                         `;

//                         // Append the result item to the product container
//                         productContainer.appendChild(resultItem);
//                     });
//                 }
//             })
//             .catch((error) => {
//                 console.error(error);
//             });
//     });
// });


