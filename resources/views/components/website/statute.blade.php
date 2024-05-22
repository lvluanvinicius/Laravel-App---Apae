<section class="flex justify-center">
    <div class="apae-container">

        <div class="statute-page w-full">
            @if ($statute)
                <iframe class="h-[100vh] w-full" src="{{ asset('storage/statute/' . $statute->file_name) }}"></iframe>
            @endif
        </div>

    </div>
</section>
