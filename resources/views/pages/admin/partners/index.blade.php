<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="grid grid-cols-12 w-full">

                <div class="col-span-12">
                    <div class="px-5">
                        <a href="{{ route('admin.partners.create') }}"
                            class="px-6 py-1 shadow-md bg-apae-green dark:bg-apae-gray-dark text-apae-white rounded-sm">
                            Novo Parceiro
                        </a>
                    </div>
                </div>

                @foreach($partners as $partner)
                    
                    <div class="col-span-12 md:col-span-3 p-6">                        
                        <a href="{{ route('admin.partners.show', ['partnerID' => $partner->id]) }}">
                            <div class="bg-apae-gray-dark h-56 relative">
                                <img src="{{ Vite::partnersImages($partner->partner_image) }}" alt="" class="w-full h-full opacity-90">
                                <div class="absolute text-apae-white bg-apae-gray-dark/50 w-full bottom-0 left-0 text-center py-4">
                                    {{ $partner->partner_name }}
                                </div>
                            </div> 
                        </a>                       
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
</x-admin.app-default>
