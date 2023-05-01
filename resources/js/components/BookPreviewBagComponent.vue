<template>
    <div class="d-flex flex-column d-lg-grid book-details border mb-4">
        <img class="m-auto book-details-image fill-available"
            src="{{ book.image != null ? book.image : '/img/default-book.png' }}"
            style="max-height: 11em; max-width: -webkit-fill-available" alt="{{ book.title }}">
        <div class="book-details-content p-3 flex-grow-1">
            <h3 class="mb-2">{{ book.title }}</h3>
            <hr>
            <h6>Author:
                <a class="text-decoration-none fw-normal" href="/details/author/{{ book.author.id }}">
                    {{ book.author.name }}
                </a>
            </h6>
            <h6>Genre:
                <a class="text-decoration-none fw-normal" href="/details/genre/{{ book.genre.id }}">
                    {{ book.genre.name }}
                </a>
            </h6>
            <h6>ISBN: <span class="fw-normal">{{ book.isbn }}</span></h6>
        </div>
        <div class="book-details-shop p-3 text-center">

            <div v-if="book.quantity != 0">
                <h6 class="mb-3 fw-light">Available: {{ book.calcQuantity() }}</h6>

                <div v-if="book.sale != []">
                    <h5 class="text-decoration-line-through">U${{ book.calcBasePrice() }}</h5>
                    <h3 class="mt-2 fw-bold">U${{ book.calcPrice() }}</h3>
                    <span class="py-1 px-2 m-1 bg-secondary fw-bold text-white rounded-2">
                        {{ book.sale.percentage * 100 }}%
                    </span>
                </div>
                <h3 v-else class="mt-2 fw-bold">U${{ book.price }}</h3>
            </div>
            <a v-else class="d-block p-3 px-5 mb-4 rounded-2 btn-dead text-white text-decoration-none fw-semibold"
                href="#button">
                Unavailable
            </a>
        </div>
    </div>
</template>

<script>
async function load() {
    let response = await fetch('/api/books/' + id);
    let book = await response.json();
}

export default {
    props: ['id'],
}

</script>