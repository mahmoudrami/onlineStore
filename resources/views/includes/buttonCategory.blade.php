<div class="d-flex mx-3 p-3 justify-content-start flex-wrap">
    <button class="category-btn {{ Route::currentRouteName() == 'categories' ? 'active' : '' }}">All</button>
    @foreach ($categories as $category)
        <button class="category-btn {{ $category->id == @$item->id ? 'active' : '' }}">{{ $category->name }}</button>
    @endforeach
</div>
