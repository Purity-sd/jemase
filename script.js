let stockList = [];

function addProduct() {
    const name = document.getElementById("productName").value;
    const quantity = document.getElementById("productQuantity").value;
    const supplier = document.getElementById("supplierName").value;

    if (name && quantity) {
        const product = {
            id: Date.now(),
            name: name,
            quantity: parseInt(quantity),
            supplier: supplier
        };
        
        stockList.push(product);
        displayStock();
        
        // Clear input fields
        document.getElementById("productName").value = "";
        document.getElementById("productQuantity").value = "";
        document.getElementById("supplierName").value = "";
    } else {
        alert("Please fill out Product Name and Quantity.");
    }
}

function deleteProduct(id) {
    stockList = stockList.filter(product => product.id !== id);
    displayStock();
}

function editProduct(id) {
    const product = stockList.find(item => item.id === id);
    document.getElementById("productName").value = product.name;
    document.getElementById("productQuantity").value = product.quantity;
    document.getElementById("supplierName").value = product.supplier;

    deleteProduct(id);
}

function displayStock() {
    const stockTable = document.getElementById("stockList");
    stockTable.innerHTML = "";

    stockList.forEach((product) => {
        const row = document.createElement("tr");
        
        row.innerHTML = `
            <td>${product.name}</td>
            <td>${product.quantity}</td>
            <td>${product.supplier || "N/A"}</td>
            <td class="actions">
                <button class="edit-btn" onclick="editProduct(${product.id})">Edit</button>
                <button class="delete-btn" onclick="deleteProduct(${product.id})">Delete</button>
            </td>
        `;
        
        stockTable.appendChild(row);
    });
}

// Fetch products and display them in the table
function fetchProducts() {
    fetch('fetch_products.php')
        .then(response => response.json())
        .then(data => {
            const stockTable = document.getElementById("stockList");
            stockTable.innerHTML = "";

            data.forEach(product => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td>${product.quantity}</td>
                    <td>${product.supplier || "N/A"}</td>
                    <td class="actions">
                        <button class="edit-btn" onclick="editProduct(${product.id})">Edit</button>
                        <button class="delete-btn" onclick="deleteProduct(${product.id})">Delete</button>
                    </td>
                `;
                stockTable.appendChild(row);
            });
        });
}

// Add product function
function addProduct() {
    const name = document.getElementById("productName").value;
    const quantity = document.getElementById("productQuantity").value;
    const supplier = document.getElementById("supplierName").value;

    fetch('add_product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, quantity, supplier })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        fetchProducts();
    });
}

// Delete product function
function deleteProduct(id) {
    fetch('delete_product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    })
    .then(response => response.json())
    .then(data => {
        fetchProducts();
    });
}

// Update product function (similar to add but calls update_product.php)
// Display an alert when the "Add Product" button is clicked
function addProduct() {
    alert("Add Product button clicked!");
}

// Submit form event (to simulate adding a product)
document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from refreshing the page

    const productName = document.getElementById('productName').value;
    const productCategory = document.getElementById('productCategory').value;
    const productQuantity = document.getElementById('productQuantity').value;
    const productPrice = document.getElementById('productPrice').value;

    // Simple validation check
    if (productName && productCategory && productQuantity && productPrice) {
        alert(`Product Added!\nName: ${productName}\nCategory: ${productCategory}\nQuantity: ${productQuantity}\nPrice: ${productPrice}`);
    } else {
        alert("Please fill in all fields.");
    }
});
