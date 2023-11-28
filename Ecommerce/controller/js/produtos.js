// Function to get products from local storage or use a default list
function getProducts() {
    var storedProducts = JSON.parse(localStorage.getItem('products'));
    return storedProducts || [
        { id: 'produto1', name: 'Microondas Embutir Song 33 Litros Crissair', price: 'R$99,99' },
        { id: 'produto2', name: 'Micro-ondas Continental Prata 34 Litros (MC34S)', price: 'R$149,99' },
        { id: 'produto3', name: 'Forno Micro-ondas LG MS3097AR | 30 Litros - Fujioka', price: 'R$199,99' }
    ];
}

// Function to save products to local storage
function saveProducts(products) {
    localStorage.setItem('products', JSON.stringify(products));
}

// Function to display products on the page
function displayProducts() {
    var productsGrid = document.getElementById('produtosGrid');
    productsGrid.innerHTML = ''; // Clear existing content

    getProducts().forEach(function (product) {
        var productDiv = document.createElement('div');
        productDiv.className = 'produtos';
        productDiv.id = product.id;

        productDiv.innerHTML = `
            <img class="imagem" src="../img/${product.id}.png" alt="${product.name}">
            <h2>${product.name}</h2>
            <p class="preco">${product.price}</p>
            <button onclick="editProduct('${product.id}')">Editar</button>
            <button onclick="removeProduct('${product.id}')">Remover</button>
        `;

        productsGrid.appendChild(productDiv);
    });
}

// Call the displayProducts function to initially render products
displayProducts();

// Function to edit a product
function editProduct(productId) {
    var newName = prompt('Enter the new name for the product:');
    var newPrice = prompt('Enter the new price for the product:');

    var products = getProducts();
    var editedProduct = products.find(product => product.id === productId);

    if (editedProduct) {
        editedProduct.name = newName || editedProduct.name;
        editedProduct.price = newPrice || editedProduct.price;
        saveProducts(products); // Save the updated products
        displayProducts(); // Update the display after editing
    }
}

// Function to remove a product
function removeProduct(productId) {
    var products = getProducts();
    var indexToRemove = products.findIndex(product => product.id === productId);

    if (indexToRemove !== -1) {
        products.splice(indexToRemove, 1);
        saveProducts(products); // Save the updated products
        displayProducts(); // Update the display after removal
    }
}

// Function to add a new product
function addProduct() {
    var newName = prompt('Enter the name for the new product:');
    var newPrice = prompt('Enter the price for the new product:');

    if (newName && newPrice) {
        var newProductId = 'produto' + (getProducts().length + 1);
        var newProduct = {
            id: newProductId,
            name: newName,
            price: newPrice
        };

        var products = getProducts();
        products.push(newProduct);
        saveProducts(products); // Save the updated products
        displayProducts(); // Update the display after addition
    }
}
