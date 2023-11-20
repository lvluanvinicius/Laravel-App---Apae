<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            
            <div class="grid grid-cols-12 w-full">

                <div class="col-span-12">
                    <div class="px-5">
                        <a href="{{ route('admin.sliders.create') }}"
                            class="px-6 py-1 shadow-md bg-apae-green dark:bg-apae-gray-dark text-apae-white rounded-sm">
                            Novo Slider
                        </a>
                    </div>
                </div>
            

            @foreach ($sliders as $slider)
            <div class="col-span-6 md:col-span-6 p-6 ">
                <div class="relative shadow-md shadow-apae-dark rounded h-[15rem]">
                    <img src="{{ Vite::slidersImages($slider->sliders_image) }}" alt="" class="h-full w-full">

                    <div
                        class="absolute bottom-0 left-0 w-full bg-apae-gray-dark/50 py-2 px-2 flex flex-wrap items-center justify-between text-apae-white text-[1rem]">
                        <button onclick="activeAndDeactive({{ $slider->id }})">
                            @if ($slider->sliders_active)
                                <i class="fa-regular fa-circle-xmark text-apae-danger"></i>
                            @else
                                <i class="fa-regular fa-circle-check text-apae-teal"></i>
                            @endif
                        </button>
                         <button onclick="deleteSlider({{ $slider->id }})">
                            <i class="fa-solid fa-trash text-apae-danger "></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            
        </div>
    @endsection

    @section('js-content')
    <script>
        /**
         * Deleta um slider.
         * 
         * @param sliderId string
         * 
         * @author Luan Santos <lvluansantos@gmail.com>
         * @return void
        */
        function deleteSlider(sliderId) {
            if (confirm('Deseja realmente excluír esse slider?')) {
                const deletePath = "{{ route('admin.sliders.destroy', ['sliderId' => '__ID_SLIDER__']) }}".replace('__ID_SLIDER__', sliderId);

                const FormDelete = document.createElement('form');
                FormDelete.action = deletePath;
                FormDelete.method = 'POST';

                const InputMethod = document.createElement('input');
                InputMethod.value = 'DELETE';
                InputMethod.name = '_method';
                InputMethod.type = 'hidden';

                const InputCSRFToken = document.createElement('input');
                InputCSRFToken.value = "{{ csrf_token() }}";
                InputCSRFToken.name = '_token';
                InputCSRFToken.type = 'hidden';

                FormDelete.appendChild(InputMethod);
                FormDelete.appendChild(InputCSRFToken);

                document.body.appendChild(FormDelete);
                FormDelete.submit();
            }
        }

        /**
         * Ativa ou desativa um slider.
         * 
         * @param sliderId string 
         * 
         * @author Luan Santos <lvluansantos@gmail.com>
         * @return void
        */
        function activeAndDeactive(sliderId) {
            if (confirm('Deseja realmente prosseguir com essa alteração no slider?')) {
                const activeDeactivePath = "{{ route('admin.sliders.active-and-deactive', ['sliderId' => '__ID_SLIDER__']) }}".replace('__ID_SLIDER__', sliderId);

                const FormActiveDeactive = document.createElement('form');
                FormActiveDeactive.action = activeDeactivePath;
                FormActiveDeactive.method = 'POST';

                const InputMethod = document.createElement('input');
                InputMethod.value = 'PUT';
                InputMethod.name = '_method';
                InputMethod.type = 'hidden';

                const InputCSRFToken = document.createElement('input');
                InputCSRFToken.value = "{{ csrf_token() }}";
                InputCSRFToken.name = '_token';
                InputCSRFToken.type = 'hidden';

                FormActiveDeactive.appendChild(InputMethod);
                FormActiveDeactive.appendChild(InputCSRFToken);

                document.body.appendChild(FormActiveDeactive);
                FormActiveDeactive.submit();

            }
        }
    </script>
@endsection
</x-admin.app-default>
