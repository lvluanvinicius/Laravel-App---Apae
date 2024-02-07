<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-2 mt-4 md:mx-8">

            <div class="grid w-full grid-cols-12">

                <div class="col-span-12">
                    <div class="px-5">
                        <a href="{{ route('admin.sliders.create') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            Novo Slider
                        </a>
                    </div>
                </div>


                @foreach ($sliders as $slider)
                    <div class="col-span-6 p-6 md:col-span-6">
                        <div class="relative h-[15rem] rounded shadow-md shadow-apae-dark">
                            <img src="{{ asset('images/sliders/' . $slider->sliders_image) }}" alt=""
                                class="h-full w-full">

                            <div
                                class="absolute bottom-0 left-0 flex w-full flex-wrap items-center justify-between bg-apae-gray-dark/50 px-2 py-2 text-[1rem] text-apae-white">
                                <button onclick="activeAndDeactive({{ $slider->id }})">
                                    @if ($slider->sliders_active)
                                        <i class="fa-regular fa-circle-xmark text-apae-danger"></i>
                                    @else
                                        <i class="fa-regular fa-circle-check text-apae-teal"></i>
                                    @endif
                                </button>
                                <button onclick="deleteSlider({{ $slider->id }})">
                                    <i class="fa-solid fa-trash text-apae-danger"></i>
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
                    const deletePath = "{{ route('admin.sliders.destroy', ['sliderId' => '__ID_SLIDER__']) }}".replace(
                        '__ID_SLIDER__', sliderId);

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
                    const activeDeactivePath =
                        "{{ route('admin.sliders.active-and-deactive', ['sliderId' => '__ID_SLIDER__']) }}".replace(
                            '__ID_SLIDER__', sliderId);

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
