<div class="{{ $attributes->get('class') ?? 'p-4 sm:ml-64' }}">

    <div class="p-4 rounded-lg mt-20 shadow-md bg-white">

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">

                {{ $slot }}

            </ol>
        </nav>

    </div>
</div>
