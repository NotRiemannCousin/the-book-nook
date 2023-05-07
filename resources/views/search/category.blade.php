<div class="grid-expand" data-grid-expanded>
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="d-inline">{{ str_plural(ucwords($name)) }}</h2>
        <span class="grid-expand-btn float-end"></span>
    </div>
    <section class="p-2 p-md-5 w-fill">
        @include('layouts.book.book-collection-expanded', [
            'collection' => $books,
        ])
    </section>
</div>


<h2>{{ str_plural(ucwords($name)) }}</h2>
<section class="p-2 p-md-5 pt-md-2 w-fill">
    @isset($callback)
    @else
        @forelse ($collection as $element)
            @if ($loop->first)
                <ul class="sla">
            @endif

            <li>
            <a class="text-decoration-none fw-normal"
                href="/details/{{ $name }}/{{ $element->id }}">{{ $element->name }}</a><br>
</li>
            @if ($loop->last)
                <ul>
            @endif
        @empty
            @include('layouts.util.nothing')
        @endforelse
    @endisset
</section>
