<header class="apae-header w-full shadow-md py-2 px-3 bg-apae-white dark:bg-apae-gray dark:text-apae-white">
    <div class="flex justify-between items-center">
        <button class="px-2" id="class-toggle-sidebar">
            {{-- <i class="fa-solid fa-bars"></i> --}}
        </button>
        <div class="">
            <button id="class-change-theme" class="px-2">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
        </div>
    </div>
</header>


@section('js-content')
    <script>
 
        // Ação para alterar o tema visual da aplicação.
        document.querySelector('#class-change-theme').addEventListener('click', () => {
            const FormChangeTheme = document.createElement('form');
            FormChangeTheme.action = `{{ route('admin.iThemes') }}`;
            FormChangeTheme.method = "POST";
            
            const FormInputMethod = document.createElement('input');
            FormInputMethod.value = 'PUT';
            FormInputMethod.name = '_method';
            FormInputMethod.type = 'hidden';
            

            const FormInputToken = document.createElement('input');
            FormInputToken.value = `{{ csrf_token() }}`;
            FormInputToken.name = '_token';
            FormInputToken.type = 'hidden';

            FormChangeTheme.appendChild(FormInputMethod);
            FormChangeTheme.appendChild(FormInputToken);

            document.body.appendChild(FormChangeTheme);
            FormChangeTheme.submit(); // Enviando requisição.
        });
    </script>
@endsection