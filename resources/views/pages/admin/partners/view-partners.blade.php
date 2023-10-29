<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="w-full">

                <div class="mb-2 flex justify-between">
                    <div></div>
                    <div class="">
                        <button onclick="deletePartner()"
                            class="px-4 py-1 shadow-md bg-apae-green dark:bg-apae-gray-dark text-apae-white rounded-sm">
                            <i class="fa-solid fa-trash text-apae-danger mr-2"></i>
                            Excluir Parceiro
                        </button>
                    </div>
                </div>

                <div class="dark:bg-apae-gray-dark dark:text-apae-white text-apae-gray-dark bg-apae-white shadow-md p-6">
                    <form action="{{ route('admin.partners.update', ['partnerID' => $partner->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap">
                            <label for="partner_name" class="">Nome do Parceiro: </label>
                            <input type="text" name="partner_name" id="partner_name"
                                class="bg-apae-gray/10 px-2 py-1 w-full !border-none !outline-none"
                                value="{{ old('partner_name') ? old('partner_name') : $partner->partner_name }}">
                        </div>

                        <div class="flex flex-wrap py-6">
                            <label for="partner_image"
                                class="border p-4 w-full border-dashed text-center text-apae-gray/80 cursor-pointer">
                                Selecione a Capa
                            </label>
                            <input type="file" id="partner_image" name="partner_image" class="hidden"
                                value="{{ old('partner_image')  }}">
                        </div>

                        <div class="flex flex-wrap ">
                            <img src="{{ Vite::partnersImages($partner->partner_image) }}" alt="" id="preview-image"
                                class="h-52">
                        </div>

                        <div class="flex flex-wrap py-3 gap-4">
                            <button
                                class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">
                                Atualizar
                            </button>
                            <a href="{{ route('admin.partners.index') }}"
                                class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>

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

            // Função efetua a exclusão do parceiro.
            async function deletePartner() {
                if (confirm('Deseja realmente excluír esse parceiro?')) {
                    // Recuperando rota de exclusão.
                    const deleteRoute = `{{ route('admin.partners.destroy', ['partnerID' => $partner->id]) }}`;

                    // Criando formulário de exclusão.
                    const FormDeletePartner = document.createElement('form');
                    FormDeletePartner.action = deleteRoute;
                    FormDeletePartner.method = 'POST';

                    // Criando input de metodo. 
                    const InputMethod = document.createElement('input');
                    InputMethod.value = 'DELETE';
                    InputMethod.name = '_method';
                    InputMethod.type = 'hidden';

                    // Criando input para csrf-token.
                    const InputCSRFToken = document.createElement('input');
                    InputCSRFToken.value = `{{ csrf_token() }}`;
                    InputCSRFToken.name = '_token';
                    InputCSRFToken.type = 'hidden';

                    FormDeletePartner.appendChild(InputMethod);
                    FormDeletePartner.appendChild(InputCSRFToken);

                    // Adicionando formulario no documento da pagina.
                    document.body.appendChild(FormDeletePartner);
                    FormDeletePartner.submit();

                }
            }
        </script>
    @endsection
</x-admin.app-default>
