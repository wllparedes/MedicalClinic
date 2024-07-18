<div class="text-sm">
    @forelse ($subcategories as $sub)
        <li> {{ $sub->name }} </li>
    @empty
        <x-badge outline red label="Sin subcategorias." />
    @endforelse
</div>
