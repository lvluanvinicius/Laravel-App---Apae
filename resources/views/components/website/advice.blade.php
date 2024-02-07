<section class="flex justify-center">
    <div class="apae-container">

        <div class="apae-advice-content">
            <ul>
                @foreach ($advices as $advice)
                    <li class="apae-advice-list">
                        <span class="text-[1.3rem] font-bold"> {{$advice['office']}}: </span>
                        <div class="flex flex-wrap flex-col gap-2">
                            @foreach ($advice['names'] as $name)
                                <span class="text-[1rem] ml-4">{{$name}}</span>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</section>
