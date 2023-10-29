<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            
            <div class="dark:bg-apae-gray-dark dark:text-apae-white text-apae-gray-dark bg-apae-white shadow-md p-6">
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap">
                        <label for="partner_name" class="">Nome do Parceiro: </label>
                        <input type="text" name="partner_name" id="partner_name"
                            class="bg-apae-gray/10 px-2 py-1 w-full !border-none !outline-none"
                            value="{{ old('partner_name') }}">
                    </div>

                    <div class="flex flex-wrap py-6">
                        <label for="partner_image" class="border p-4 w-full border-dashed text-center text-apae-gray/80 cursor-pointer">Selecione a Capa</label>
                        <input type="file" id="partner_image" name="partner_image" class="hidden" value="{{ old('partner_image') }}">
                    </div>

                    <div class="flex flex-wrap ">
                        <img src="" alt="" id="preview-image" class="">
                    </div>

                    <div class="flex flex-wrap py-3 gap-4">
                        <button
                            class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">
                            Salvar
                        </button>
                            <a href="{{ route('admin.partners.index') }}"
                                class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">
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
