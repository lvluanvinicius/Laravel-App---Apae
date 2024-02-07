<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-2 mt-4 md:mx-8">
            <div class="w-full">

                <div class="mb-2 flex justify-between">
                    <div></div>
                    <div class="">
                        <button onclick="deletePartner()"
                            class="rounded-sm bg-apae-green px-4 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            <i class="fa-solid fa-trash mr-2 text-apae-danger"></i>
                            Excluir Parceiro
                        </button>
                    </div>
                </div>

                <div class="bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                    <form action="{{ route('admin.partners.update', ['partnerID' => $partner->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap">
                            <label for="partner_name" class="">Nome do Parceiro: </label>
                            <input type="text" name="partner_name" id="partner_name"
                                class="w-full !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
                                value="{{ old('partner_name') ? old('partner_name') : $partner->partner_name }}">
                        </div>

                        <div class="flex flex-wrap py-6">
                            <label for="partner_image"
                                class="w-full cursor-pointer border border-dashed p-4 text-center text-apae-gray/80">
                                Selecione a Capa
                            </label>
                            <input type="file" id="partner_image" name="partner_image" class="hidden"
                                value="{{ old('partner_image') }}">
                        </div>

                        <div class="flex flex-wrap">
                            <img src="{{ asset('images/partners/' . $partner->partner_image) }}" alt=""
                                id="preview-image" class="h-52">
                        </div>

                        <div class="flex flex-wrap gap-4 py-3">
                            <button
                                class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">
                                Atualizar
                            </button>
                            <a href="{{ route('admin.partners.index') }}"
                                class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">
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
