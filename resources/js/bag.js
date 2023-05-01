document.addEventListener("DOMContentLoaded", async () => {
    let bag_btn = document.getElementById('add-bag');
    let books = await getBooks();

    if (books)
        setBagIcon(books.length);

    if (!bag_btn)
        return;


    bag_btn.addEventListener('click', updateBag, true);

    document.querySelector('button.number-input-button[data-btn-quantity="+"]').addEventListener('click', addQuantity, true);
    document.querySelector('button.number-input-button[data-btn-quantity="-"]').addEventListener('click', subtractQuantity, true);


}, false);

function addQuantity() {
    var current_value = parseInt(document.getElementById("quantity").value);
    if (current_value >= parseInt(document.getElementById("quantity").max))
        return;
    var new_value = current_value - (-1); //Evitando Concatenacoes
    document.getElementById("quantity").value = new_value;
}

function subtractQuantity() {
    var current_value = document.getElementById("quantity").value;
    if (current_value < 2)
        return;
    var new_value = current_value - 1;
    document.getElementById("quantity").value = new_value;
}

const BooksKey = 'books-bag';
async function getBooks() {
    let books_json = localStorage.getItem(BooksKey);

    if (!books_json)
        return [];

    return await JSON.parse(books_json);
}
async function setBooks(books) {
    localStorage.setItem(BooksKey, JSON.stringify(books));
}
async function setBagIcon(content) {
    if (!parseInt(content)) {
        document.getElementById('bag-count').classList.add('d-none');
        return;
    }
    document.getElementById('bag-count').classList.remove('d-none');
    document.getElementById('bag-count').innerHTML = content;
}
async function updateBag(e) {
    const input_quantity = document.getElementById('quantity');
    const idExist = (book, i, array) => {
        index = i;
        return book.id == new_book.id;
    };



    let new_book = {
        id: e.target.getAttribute('data-book-id'),
        quantity: input_quantity.value,
    };

    let books = await getBooks();
    let index;

    if (books)
        if (books.some(idExist))
            books[index] = new_book;
        else
            books.push(new_book);
    else
        books = [new_book];


    setBooks(books);
    setBagIcon(books.length);
    showMessage('Book added!');
}
async function removeBag(index) {
    let book = await getBooks();

    book.splice(index, 1);
    setBooks(book);
}
async function fetchBooks() {
    let books = await fetch(location.protocol + '//' + location.hostname +
        '/api/books/?books=[' + await getBooks().join(',') + ']');
}

function showMessage(message) {
    const box = document.getElementById('message');

    if (box.classList.contains('fade-out'))
        return;

    box.innerHTML = message;
    box.classList.remove('fade-out');
    box.classList.add('fade-out');
    setTimeout(() => box.classList.remove('fade-out'), 5 * 1000);
}

