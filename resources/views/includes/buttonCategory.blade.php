<div class="d-flex mx-3 p-3 justify-content-start flex-wrap gap-4">
    <a href="{{ route('categories') }}"
        class="category-btn {{ Route::currentRouteName() == 'categories' ? 'active' : '' }}">All</a>
    @foreach ($categories as $category)
        <a href="{{ route('category', $category->id) }}"
            class="category-btn {{ $category->id == @$item->id || $category->id == @$product->category->id ? 'active' : '' }}">{{ $category->name }}</a>
    @endforeach
</div>
