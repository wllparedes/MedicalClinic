<div class="{{ $attributes->get('class') ?? '' }} mb-[30px]">

    <div class="p-4 rounded-lg shadow-md bg-white">

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">

                {{ $slot }}

            </ol>
        </nav>

    </div>
</div>
