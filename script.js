const products = [
  {
    id: 1,
    title: "Chaussure de sport",
    description: "Confortable et stylée, parfaite pour courir.",
    price: 59.99,
    image: "https://via.placeholder.com/250x150"
  },
  {
    id: 2,
    title: "Veste légère",
    description: "Idéale pour le printemps.",
    price: 89.99,
    image: "https://via.placeholder.com/250x150"
  }
];

let cart = [];

const container = document.getElementById('product-container');
const cartItemsContainer = document.getElementById('cart-items');
const cartTotal = document.getElementById('cart-total');

function saveCartToLocalStorage() {
  localStorage.setItem('monPanier', JSON.stringify(cart));
}
function loadCartFromLocalStorage() {
  const savedCart = localStorage.getItem('monPanier');
  if (savedCart) {
    cart = JSON.parse(savedCart);
  }
}
function showToast(message) {
  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.textContent = message;
  document.body.appendChild(toast);
  setTimeout(() => toast.remove(), 3000);
}
function updateCartCount() {
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
  const countElement = document.getElementById('cart-count');
  countElement.textContent = `🛒 ${totalItems} article${totalItems > 1 ? 's' : ''}`;
}
function addToCart(product) {
  const existing = cart.find(item => item.id === product.id);
  if (existing) {
    existing.quantity += 1;
    showToast(`Quantité mise à jour : ${product.title}`);
  } else {
    cart.push({ ...product, quantity: 1 });
    showToast(`Ajouté au panier : ${product.title}`);
  }
  saveCartToLocalStorage();
  updateCartDisplay();
  updateCartCount();
}
function removeFromCart(productId) {
  const product = cart.find(item => item.id === productId);
  if (product) {
    showToast(`Supprimé du panier : ${product.title}`);
  }
  cart = cart.filter(item => item.id !== productId);
  saveCartToLocalStorage();
  updateCartDisplay();
  updateCartCount();
}
function updateQuantity(productId, newQty) {
  const item = cart.find(i => i.id === productId);
  if (!item) return;
  const qty = parseInt(newQty);
  if (isNaN(qty) || qty < 1) {
    removeFromCart(productId);
  } else {
    item.quantity = qty;
    saveCartToLocalStorage();
    updateCartDisplay();
    updateCartCount();
  }
}
function updateCartDisplay() {
  cartItemsContainer.innerHTML = "";
  let total = 0;

  cart.forEach(item => {
    const itemTotal = item.price * item.quantity;
    total += itemTotal;

    const div = document.createElement("div");
    div.className = "cart-item";
    div.innerHTML = `
      <span>${item.title}</span>
      <input class="quantity-input" type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${item.id}, this.value)">
      <span>${itemTotal.toFixed(2)}€</span>
      <button onclick="removeFromCart(${item.id})">❌</button>
    `;
    cartItemsContainer.appendChild(div);
  });

  cartTotal.textContent = `Total : ${total.toFixed(2)}€`;
}

document.getElementById('clear-cart-btn').addEventListener('click', () => {
  if (cart.length === 0) {
    showToast("Le panier est déjà vide.");
    return;
  }

  if (confirm("Voulez-vous vraiment vider le panier ?")) {
    cart = [];
    saveCartToLocalStorage();
    updateCartDisplay();
    updateCartCount();
    showToast("Panier vidé !");
  }
});

function renderProducts() {
  if (!container) return;
  products.forEach(product => {
    const card = document.createElement("div");
    card.className = "product-card";
    card.innerHTML = `
      <img src="${product.image}" alt="${product.title}" class="product-image">
      <h3>${product.title}</h3>
      <p>${product.description}</p>
      <p><strong>${product.price.toFixed(2)}€</strong></p>
      <button class="btn-add-to-cart">Ajouter au panier</button>
    `;
    card.querySelector("button").addEventListener("click", () => addToCart(product));
    container.appendChild(card);
  });
}

loadCartFromLocalStorage();
renderProducts();
updateCartDisplay();
updateCartCount();
