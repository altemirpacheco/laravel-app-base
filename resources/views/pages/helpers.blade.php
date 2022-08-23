<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Helpers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 bg-white">
                    {{ __("You're logged in!") }}
                </div> --}}
                <div class="">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Métodos
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Respostas
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $linhas = 0; @endphp
                                @forelse ($resultados as $indice => $resultado)
                                    @if ($linhas % 2)
                                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        @else
                                        <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                                    @endif
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $indice }}
                                    </th>
                                    <td class="py-4 px-6">
                                        <p>
                                            <span class="text-green-700">{{ $descricao[$indice] ?? null }}</span><br>
                                            @forelse ($resultado as $key => $value)
                                                <strong>{{ $key }}</strong>:
                                                @if (is_array($value))
                                                    {{-- {{ implode(', ', $value) }} --}}
                                                    {{-- {{ print_r($value) }} --}}
                                                    @dump($value)
                                                @else
                                                    {{ $value }}
                                                @endif
                                                <br>
                                            @empty
                                                -- Nada encontrado...
                                            @endforelse
                                        </p>
                                    </td>
                                    </tr>
                                    @php $linhas++ @endphp
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            Nada encontrado!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
