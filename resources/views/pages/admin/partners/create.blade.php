<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-2 mt-4 md:mx-8">

            <div class="bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap">
                        <label for="partner_name" class="">Nome do Parceiro: </label>
                        <input type="text" name="partner_name" id="partner_name"
                            class="w-full !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
                            value="{{ old('partner_name') }}">
                    </div>

                    <div class="flex flex-wrap py-6">
                        <label for="partner_image"
                            class="w-full cursor-pointer border border-dashed p-4 text-center text-apae-gray/80">Selecione a
                            Capa</label>
                        <input type="file" id="partner_image" name="partner_image" class="hidden"
                            value="{{ old('partner_image') }}">
                    </div>

                    <div class="flex flex-wrap">
                        <img src="" alt="" id="preview-image" class="">
                    </div>

                    <div class="flex flex-wrap gap-4 py-3">
                        <button
                            class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">
                            Salvar
                        </button>
                        <a href="{{ route('admin.partners.index') }}"
                            class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

        </div>
    @endsection

    @section('js-content')
        <script>
            // Seleciona o input da imagem de capa.
            document.getElementById('partner_image').addEventListener('change', function(event) {
                const file = event.target.files[0]; // Busca o arquivo para upload.

                // Verifica se existe arquivo.
                if (file) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        const previewImage = document.querySelector('#preview-image');
                        previewImage.classList.add('h-52');
                        previewImage.src = e.target.result;
                    };

                    reader.readAsDataURL(file); // Carrega o arquivo como URL de dados.
                }
            });
        </script>
    @endsection
</x-admin.app-default>
