<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="bg-white">
                        {{-- Back Button --}}
                        <div class="flex justify-between items-center mb-6">
                            <a href="{{ route('admin.students.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Student List
                            </a>
                        </div>

                        <div class="mx-auto max-w-4xl">


                            <div class="relative bg-white p-0 sm:p-0 rounded-lg">

                                <div class="bg-gray-50 p-6 sm:p-8 rounded-t-lg border-b border-gray-200 shadow-md">

                                    {{-- Action Buttons --}}
                                    <div
                                        class="absolute top-6 right-6 flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-1">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.students.edit', $student->student_id) }}"
                                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 transition duration-150 ease-in-out">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                            <span class="hidden sm:inline">Edit Profile</span>
                                            <span class="sm:hidden">Edit</span>
                                        </a>

                                        {{-- Delete Button to open Modal --}}
                                        <button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-student-deletion')"
                                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-200 transition duration-150 ease-in-out">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            <span class="hidden sm:inline">Delete</span>
                                            <span class="sm:hidden">Del</span>
                                        </button>
                                    </div>

                                    {{-- Profile Details --}}
                                    <div
                                        class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                                        {{-- Image --}}
                                        <div class="flex-shrink-0">
                                            <img class="rounded-full w-32 h-32 object-cover ring-4 ring-blue-500 ring-offset-4 ring-offset-gray-50"
                                                src="{{ $student->student_Image ? asset('storage/' . $student->student_Image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg' }}"
                                                alt="{{ $student->student_Fname }}-image">
                                        </div>

                                        {{-- Name and Program --}}
                                        <div class="text-center md:text-left pt-2">
                                            <h1 class="text-4xl font-extrabold text-gray-900 leading-none mt-1">
                                                {{ $student->student_FullName }}
                                            </h1>
                                            <p class="text-sm font-medium text-gray-500 mt-1">
                                                Student Number: <span
                                                    class="font-bold">{{ $student->student_Number }}</span>
                                            </p>
                                            <p class="text-xl text-gray-600 font-semibold mt-2">
                                                {{ $student->programs->program_Title ?? 'No Program Assigned' }}
                                            </p>
                                            <p class="text-md text-gray-500">
                                                ({{ $student->programs->program_Code ?? 'N/A' }}) -
                                                {{ $student->student_YearLevel ?? 'N/A' }} Year
                                            </p>

                                            {{-- Status Badge --}}
                                            <span
                                                class="inline-flex items-center mt-3 px-4 py-1.5 text-sm font-bold tracking-wider rounded-full
                                                {{ $student->student_Status == 1 ? 'bg-green-100 text-green-800' : ($student->student_Status == 2 ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                <span
                                                    class="h-2.5 w-2.5 rounded-full me-2
                                                    {{ $student->student_Status == 1 ? 'bg-green-500' : ($student->student_Status == 2 ? 'bg-yellow-400' : 'bg-blue-500') }}"></span>
                                                {{ $student->student_Status == 1 ? 'Active' : ($student->student_Status == 2 ? 'Inactive' : 'Graduated') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="p-6 sm:p-8">
                                    <h2
                                        class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 inline-block pb-1">
                                        Personal & Contact Info
                                    </h2>
                                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-6 mt-4">
                                        <div class="border-b pb-4 border-gray-100">
                                            <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                            <dd class="mt-1 text-lg font-semibold text-gray-900">
                                                {{ $student->student_Email }}
                                            </dd>
                                        </div>
                                        <div class="border-b pb-4 border-gray-100">
                                            <dt class="text-sm font-medium text-gray-500">Gender</dt>
                                            <dd class="mt-1 text-lg font-semibold text-gray-900">
                                                {{ $student->student_Gender }}
                                            </dd>
                                        </div>
                                        <div class="border-b pb-4 border-gray-100">
                                            <dt class="text-sm font-medium text-gray-500">Birthdate</dt>
                                            <dd class="mt-1 text-lg font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($student->student_Birthdate)->format('F d, Y') }}
                                            </dd>
                                        </div>

                                        <div class="border-b pb-4 border-gray-100">
                                            <dt class="text-sm font-medium text-gray-500">Age</dt>
                                            <dd class="mt-1 text-lg font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($student->student_Birthdate)->age }} years old
                                            </dd>
                                        </div>

                                    </dl>

                                    <div class="mt-10 pt-6 border-t border-gray-200">
                                        <h2
                                            class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 inline-block pb-1">
                                            Administrative Info
                                        </h2>
                                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-6 mt-4">

                                            <div class="border-b pb-4 border-gray-100">
                                                <dt class="text-sm font-medium text-gray-500">Record Created On</dt>
                                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($student->created_at)->format('F d, Y') }}
                                                </dd>
                                            </div>
                                            <div class="border-b pb-4 border-gray-100">
                                                <dt class="text-sm font-medium text-gray-500">Record Updated On</dt>
                                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($student->updated_at)->format('F d, Y') }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>


                                    <div class="mt-10 pt-6 border-t border-gray-200">
                                        <h2
                                            class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 inline-block pb-1">
                                            Notes
                                        </h2>
                                        <div
                                            class="mt-4 text-base text-gray-700 p-4 bg-gray-50 border border-gray-300 rounded-lg whitespace-pre-wrap min-h-[100px]">
                                            {{ $student->student_Notes ?? 'No additional notes recorded for this student.' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <x-modal name="confirm-student-deletion" :show="$errors->isNotEmpty()" focusable>

        {{-- Delete Form --}}
        <form method="post" action="{{ route('admin.students.destroy', $student->student_id) }}" class="p-6">
            @csrf
            @method('delete')

            {{-- Hidden input for the student ID --}}
            <input type="hidden" name="student_id" value="{{ $student->student_id }}">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this student?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once deleted, all of this student\'s data will be permanently removed. This action cannot be undone.') }}
            </p>


            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Confirm Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
