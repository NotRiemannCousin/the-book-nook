document.addEventListener("DOMContentLoaded", async () => {
    let bag_btn = document.getElementById('add-bag');
    let books = await getBooks();
    Array.from(document.getElementsByClassName('show-bag')).forEach(element => element.addEventListener('click', showBag, true));
    Array.from(document.getElementsByClassName('hide-bag')).forEach(element => element.addEventListener('click', hideBag, true));
    Array.from(document.getElementsByClassName('clear-bag')).forEach(element => element.addEventListener('click', clearBag, true));

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
    let bagBookList = await getBooks();
    let books = [];
    for (let i = 0; i < await bagBookList.length; i++) {
        let data = await fetch('/api/books/' + bagBookList[i].id);
        books.push(await data.json());
    }

    return books;
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

async function showBag() {
    const bag_holder = document.getElementById('bag-holder');
    const element = document.getElementById('bag-wrapper');
    
    let books = Array.from(await fetchBooks());
    let list = [];
    element.innerHTML = books.length;

    bag_holder.classList.remove('d-none');

    books.forEach(book => {
        book = book.data;
        list.push(
            `<div class="d-flex flex-column d-lg-grid book-details border">
            <img
            class="m-auto book-details-image fill-available"
            src="${book.image != null ? book.image : '/img/default-book.png'}"
            style="max-height: 11em; max-width: -webkit-fill-available"
            alt="${book.title}"
            />
            <div class="book-details-content p-3 flex-grow-1">
                    <h3 class="mb-2">${book.title}</h3>
                    <hr />
                    <h6>
                        Author:
                        <a
                        class="text-decoration-none fw-normal"
                        href="/details/author/${book.author['id']}"
                        >
                            ${book.author['name']}
                        </a>
                        </h6>
                    <h6>
                        Genre:
                        <a
                            class="text-decoration-none fw-normal"
                            href="/details/genre/${book.genre.id}"
                        >
                            ${book.genre['name']}
                        </a>
                    </h6>
                    <h6>ISBN: <span class="fw-normal">${book.isbn}</span></h6>
                </div>
                <div class="book-details-shop p-3 text-center">
                    `+ (book.quantity != 0 ? `
                    <h6 class="mb-3 fw-light">Available: ${book.quantity}</h6>
                    `+ (book.sale ? `
                    <h5 class="text-decoration-line-through">U\$${book.real_price}</h5>
                    <h3 class="mt-2 fw-bold">U\$${book.price}</h3>
                    <span class="py-1 px-2 m-1 bg-secondary fw-bold text-white rounded-2">
                    ${book.sale.percentage * 100}%
                    </span>
                    `: `
                    <h3 v-else class="mt-2 fw-bold">U\$${book.price}</h3>
                    `) : `<p
                    class="d-block p-3 px-5 mb-4 rounded-2 text-decoration-none fw-semibold"
                        style="color: #555">
                        Unavailable
                    </p>
                    `) + `
                </div>
                </div>`);
    });
    element.innerHTML = list.join('<hr>');
}

function hideBag(event) {
    console.log('foo');
    if(event.target !== event.currentTarget) return;
    const bag_holder = document.getElementById('bag-holder');
    console.log('bar');
    bag_holder.classList.add('d-none');
}

function clearBag(){
    localStorage.removeItem(BooksKey);
    document.getElementsByClassName('hide-bag')[0].click();
    setBagIcon(0);
}