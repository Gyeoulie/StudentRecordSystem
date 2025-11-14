<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Programs List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                    <x-alerts />

                    {{-- Form for Filters --}}

                    <div class="flex flex-col sm:flex-row mb-4 sm:justify-between sm:items-end gap-2">

                        {{-- Search Input  --}}
                        <form method="GET" action="{{ url()->current() }}" class="w-full sm:w-80">
                            <label for="table-search-students" class="sr-only">Search</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>

                                <input type="text" id="table-search-programs" name="search"
                                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Search for programs" value="{{ request('search') }}">
                            </div>
                        </form>


                        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-2">


                            <div class="flex flex-row gap-2 w-full sm:w-auto">
                                {{-- Clear Filters Button --}}

                                {{-- Apply Filters Button  --}}
                                <button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'add-program')"
                                    class="w-1/2 sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center justify-center h-9">
                                    Add Programs
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-6 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>


                    {{-- Table for Desktop / Card View for Mobile --}}
                    <div class="overflow-hidden">

                        @if ($programs->isEmpty())
                            {{-- No Program Found message (visible on all screens) --}}
                            <div class="flex flex-col items-center justify-center mt-24 mb-24">
                                <div class="p-6 bg-gray-100 rounded-full">
                                    <svg class="w-24 h-24 text-black" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <p class="mt-2 text-xl font-bold text-center text-black">
                                    No Program Found
                                </p>
                            </div>
                        @else
                            {{-- 1. Desktop/Tablet Table View (Visible on sm screens and up) --}}
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 hidden sm:table">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Program Code</th>
                                        <th scope="col" class="px-6 py-3">Program Title</th>
                                        <th scope="col" class="px-6 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programs as $program)
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                            {{-- Program Code --}}
                                            <td class="px-6 py-4">{{ $program->program_Code }}</td>
                                            {{-- Program Title --}}
                                            <td class="px-6 py-4 text-black-900 font-bold">{{ $program->program_Title }}
                                            </td>

                                            {{-- Action --}}
                                            <td class="px-6 py-4">
                                                <div x-data="{ tooltip: 'Edit Program Information' }">
                                                    <button x-tooltip="tooltip" type="button"
                                                        x-on:click.prevent="
                                        $dispatch('open-modal', 'edit-program');
                                        $dispatch('edit-program-data', {
                                            id: {{ $program->program_id }},
                                            title: '{{ $program->program_Title }}',
                                            code: '{{ $program->program_Code }}'
                                        });
                                    "
                                                        class="inline-flex items-center p-1 text-sm font-medium text-center text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- 2. Mobile Card View (Hidden on sm screens and up) --}}
                            <div class="sm:hidden space-y-3 p-2">
                                @foreach ($programs as $program)
                                    <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                        {{-- Program Code --}}
                                        <div class="flex justify-between items-center mb-2 pb-1 border-b">
                                            <span class="text-xs font-semibold uppercase text-gray-500">Program
                                                Code</span>
                                            <span
                                                class="text-base font-bold text-gray-900">{{ $program->program_Code }}</span>
                                        </div>

                                        {{-- Program Title --}}
                                        <div class="mb-3">
                                            <span class="block text-xs font-semibold uppercase text-gray-500">Program
                                                Title</span>
                                            <span
                                                class="block text-sm text-black-900 font-bold">{{ $program->program_Title }}</span>
                                        </div>

                                        {{-- Action --}}
                                        <div class="flex justify-end pt-2 border-t">
                                            <div x-data="{ tooltip: 'Edit Program Information' }">
                                                <button x-tooltip="tooltip" type="button"
                                                    x-on:click.prevent="
                                    $dispatch('open-modal', 'edit-program');
                                    $dispatch('edit-program-data', {
                                        id: {{ $program->program_id }},
                                        title: '{{ $program->program_Title }}',
                                        code: '{{ $program->program_Code }}'
                                    });
                                "
                                                    class="inline-flex items-center px-3 py-1 text-sm font-medium text-center text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 me-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Pagination --}}
                        <div class="mt-4 p-2">
                            {{ $programs->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- Add Program Modal --}}
    <x-modal name="add-program" :show="$errors->has('program_Code') || $errors->has('program_Title')" focusable>


        <form method="post" action="{{ route('admin.programs.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 mb-4">
                {{ __('Add Program') }}
            </h2>

            <div>
                <x-input-label for="program_Title" :value="__('Program Title')" />
                <x-text-input id="program_Title" class="block mt-1 w-full" type="text" name="program_Title"
                    :value="old('program_Title')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="program_Code" :value="__('Program Code')" />

                <x-text-input id="program_Code" class="block mt-1 w-full" type="text" name="program_Code"
                    required :value="old('program_Code')" />

                <x-input-error :messages="$errors->get('program_Code')" class="mt-2" />
            </div>


            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Add Program') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>


    <x-modal name="edit-program" :show="$errors->has('edit_program_Code') || $errors->has('edit_program_Title')" focusable>

        <form method="post" x-data="{
            programId: '',
            programTitle: '{{ old('edit_program_Title') }}', // Default to old value on error
            programCode: '{{ old('edit_program_Code') }}', // Default to old value on error
            actionUrl: '{{ route('admin.programs.update', 'REPLACE_ID') }}'
        }"
            x-on:edit-program-data.window="
        programId = $event.detail.id;
        if (!'{{ old('edit_program_Title') }}' && !'{{ old('edit_program_Code') }}') {
            programTitle = $event.detail.title;
            programCode = $event.detail.code;
        }
        $el.action = actionUrl.replace('REPLACE_ID', programId);
    "
            :action="actionUrl.replace('REPLACE_ID', programId)" class="p-6">
            @csrf
            @method('patch')

            <h2 class="text-lg font-medium text-gray-900 mb-4">
                {{ __('Edit Program') }}
            </h2>



            <div>
                <x-input-label for="edit_program_Title" :value="__('Program Title')" />
                <x-text-input id="edit_program_Title" class="block mt-1 w-full" type="text"
                    name="edit_program_Title" required autofocus x-model="programTitle" /> <x-input-error
                    :messages="$errors->get('edit_program_Title')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="edit_program_Code" :value="__('Program Code')" />
                <x-text-input id="edit_program_Code" class="block mt-1 w-full" type="text"
                    name="edit_program_Code" required x-model="programCode" /> <x-input-error :messages="$errors->get('edit_program_Code')"
                    class="mt-2" />
            </div>


            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Save Program') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
