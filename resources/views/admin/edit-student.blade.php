<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student Information') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="bg-white">
                        <x-alerts />

                        {{-- Back Button --}}
                        <div class="flex justify-between items-center">
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

                        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">

                            {{-- Form Start --}}
                            <form action="{{ route('admin.students.update', ['student' => $student->student_id]) }}"
                                method="POST"> @csrf
                                @method('PATCH')

                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">

                                        <div class="flex flex-row w-full justify-center items-center space-x-4">
                                            <div class="relative flex shrink-0 group">
                                                <img class="rounded-full w-24 h-24 sm:w-32 sm:h-32 object-cover transition-opacity duration-300"
                                                    src="{{ $student->student_Image ? asset('storage/' . $student->student_Image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg' }}"
                                                    alt="Student Avatar">

                                                {{-- For Modal --}}
                                                <div x-data="{ tooltip: 'Edit Student Image' }" x-tooltip="tooltip"
                                                    x-on:click.prevent="$dispatch('open-modal', 'edit-user-profile')"
                                                    class="cursor-pointer absolute inset-0 rounded-full bg-black opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                                                </div>

                                                <div
                                                    class="absolute  inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <x-input-error :messages="$errors->get('student_image')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="first_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                                        <input type="text" name="first_name" id="first_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="First Name" required=""
                                            value="{{ old('first_name', $student->student_Fname) }}">
                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="middle_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Middle Name</label>
                                        <input type="text" name="middle_name" id="middle_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Middle Name"
                                            value="{{ old('middle_name', $student->student_Mname) }}">
                                        <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
                                    </div>

                                    <div class="w-full">
                                        <label for="last_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                                        <input type="text" name="last_name" id="last_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Last Name" required=""
                                            value="{{ old('last_name', $student->student_Lname) }}">
                                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Email" required=""
                                            value="{{ old('email', $student->student_Email) }}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label for="gender"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Gender</label>
                                        <select id="gender" name="gender"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                            <option selected="">Select gender</option>
                                            <option value="">Select gender</option>
                                            <option value="1"
                                                {{ old('gender', $student->student_Gender) == 'Male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="2"
                                                {{ old('gender', $student->student_Gender) == 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="birthdate"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Birthdate</label>
                                        <input type="date" name="birthdate" id="birthdate"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Birthdate" required=""
                                            value="{{ old('birthdate', optional($student->student_Birthdate)->format('Y-m-d')) }}">
                                        <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="program"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Program</label>
                                        <select id="program" name="program"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">

                                            <option value="" selected>Select program</option>

                                            @foreach ($programs as $program)
                                                <option value="{{ $program->program_id }}"
                                                    {{ old('program', $student->program_id) == $program->program_id ? 'selected' : '' }}>

                                                    {{ $program->program_Title }} - {{ $program->program_Code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('program')" class="mt-2" />
                                    </div>


                                    <div>
                                        <label for="student_number"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Student
                                            Number</label>
                                        <input type="text" name="student_number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="####-######" required=""
                                            value="{{ old('student_number', $student->student_Number) }}">
                                        <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                                    </div>
                                    <div class="flex flex-row space-x-2 w-full">
                                        <div class="w-full">
                                            <label for="year_level"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Year
                                                Level</label>
                                            <select id="year_level" name="year_level"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                <option selected="">Year level</option>
                                                @for ($i = 1; $i <= 6; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('year_level', $student->student_YearLevel) == $i ? 'selected' : '' }}>
                                                        {{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }}
                                                        Year
                                                    </option>
                                                @endfor

                                            </select>
                                            <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
                                        </div>
                                        <div class="w-full">
                                            <label for="student_status"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Student
                                                Status</label>
                                            <select id="student_status" name="student_status"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                <option selected="">Student status</option>

                                                <option value="1"
                                                    {{ old('student_status', $student->student_Status) == '1' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="2"
                                                    {{ old('student_status', $student->student_Status) == '2' ? 'selected' : '' }}>
                                                    Inactive</option>
                                                <option value="3"
                                                    {{ old('student_status', $student->student_Status) == '3' ? 'selected' : '' }}>
                                                    Graduated</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('student_status')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>


                                <div class="sm:col-span-2 mt-2">
                                    <label for="notes"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Notes</label>
                                    <textarea id="notes" rows="8" name="notes"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Your notes here">{{ old('notes', $student->student_Notes) }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />

                                </div>
                        </div>
                        <div class="flex w-full justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200">
                                Save Changes
                            </button>
                        </div>
                        </form>
                </div>
                </section>
            </div>
        </div>
    </div>

    {{-- Edit Image Modal --}}
    <x-modal name="edit-user-profile" focusable>

        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-4">
                {{ __('Manage Profile Image') }}
            </h2>


            <div class="flex flex-col md:flex-row items-center gap-6">


                <div class="shrink-0 relative">

                    <img id="student_image_preview"
                        class="rounded-full w-32 h-32 md:w-40 md:h-40 object-cover ring-2 ring-indigo-500 ring-offset-2"
                        src="{{ $student->student_Image ? asset('storage/' . $student->student_Image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg' }}"{{-- Replace with actual user image source or a default --}}
                        alt="{{ __('Profile Avatar') }}">

                    {{-- Checks if user has a profile image --}}
                    @if ($student->student_Image)
                        {{-- Delete Profile Image --}}
                        <form method="post" action="{{ route('admin.students.deleteImage', $student) }}"
                            class="absolute bottom-0 right-0">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="rounded-full p-0 h-10 w-10 inline-flex items-center justify-center bg-red-600 text-white shadow-lg
               transform hover:scale-105 hover:bg-red-500 transition duration-150 outline-2 outline-red-400"
                                title="{{ __('Remove Current Image') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>

                        </form>
                    @endif
                </div>


                <div class="flex-1 w-full mt-4 md:mt-0">
                    {{-- Form Start for Updating Image --}}
                    <form method="post" action="{{ route('admin.students.updateImage', $student->student_id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h3 class="text-lg font-semibold text-gray-700 mb-2">
                            {{ __('Upload a New Image') }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-4">
                            {{ __('Choose a file (PNG, JPG) to replace your current profile picture.') }}
                        </p>

                        <label class="block mb-2 text-sm font-medium text-gray-900" for="student_image">
                            {{ __('Image File') }}
                        </label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150"
                            id="student_image" name="student_image" type="file"
                            accept="image/png, image/jpeg, image/jpg">
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')" type="button">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-primary-button class="ms-3">
                                {{ __('Save New Image') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </x-modal>



</x-app-layout>
