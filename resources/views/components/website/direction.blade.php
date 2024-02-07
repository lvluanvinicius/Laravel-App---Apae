<section class="flex justify-center">
    <div class="apae-container">

        <div class="apae-direction-content">
            <ul>
                @foreach ($directions as $direction)
                    <li class="apae-direction-list">
                        <span class="text-[.9rem] font-bold"> {{$direction['office']}}: </span>
                        <span class="text-[1rem]">{{$direction['name']}}</span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</section>
