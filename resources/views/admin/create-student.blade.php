<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="bg-white">
                        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">

                            <x-alerts />

                            <form action="{{ route('admin.students.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <div class="flex flex-row w-full items-center space-x-4">
                                            <div class="flex shrink-0">
                                                <img id="student_image_preview"
                                                    class="rounded-full w-24 h-24 sm:w-32 sm:h-32 object-cover"
                                                    src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg"
                                                    alt="Student Avatar">
                                            </div>

                                            <div class="flex-1 w-full">

                                                <label class="block mb-2 text-sm font-medium text-gray-900"
                                                    for="student_image">Upload file</label>
                                                <input
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50focus:outline-none"
                                                    id="student_image" name="student_image" type="file"
                                                    accept="image/*">
                                            </div>
                                        </div>

                                        <x-input-error :messages="$errors->get('student_image')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="first_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                                        <input type="text" name="first_name" id="first_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="First Name" required="" value="{{ old('first_name') }}">
                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="middle_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Middle Name</label>
                                        <input type="text" name="middle_name" id="middle_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Middle Name" value="{{ old('middle_name') }}">
                                        <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
                                    </div>

                                    <div class="w-full">
                                        <label for="last_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                                        <input type="text" name="last_name" id="last_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Last Name" required="" value="{{ old('last_name') }}">
                                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Email" required="" value="{{ old('email') }}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label for="gender"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Gender</label>
                                        <select id="gender" name="gender"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                            <option value="" @selected(old('gender') === null || old('gender') === '')>Select gender</option>
                                            <option value="1" @selected(old('gender') == '1')>Male</option>
                                            <option value="2" @selected(old('gender') == '2')>Female</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>
                                    <div class="w-full">
                                        <label for="birthdate"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Birthdate</label>
                                        <input type="date" name="birthdate" id="birthdate"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Birthdate" required="" value="{{ old('birthdate') }}">
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
                                                    {{ old('program') == $program->program_id ? 'selected' : '' }}>

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
                                            value="{{ old('student_number') }}">
                                        <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                                    </div>
                                    <div class="flex flex-row space-x-2 w-full">
                                        <div class="w-full">
                                            <label for="year_level"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Year
                                                Level</label>
                                            <select id="year_level" name="year_level"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                {{-- Year Level Dropdown --}}
                                                <option value="" @selected(old('year_level') == '')>Select year level
                                                </option>
                                                <option value="1" @selected(old('year_level') == '1')>1st Year</option>
                                                <option value="2" @selected(old('year_level') == '2')>2nd Year</option>
                                                <option value="3" @selected(old('year_level') == '3')>3rd Year</option>
                                                <option value="4" @selected(old('year_level') == '4')>4th Year</option>
                                                <option value="5" @selected(old('year_level') == '5')>5th Year</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
                                        </div>

                                        <div class="w-full">
                                            <label for="student_status"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Student
                                                Status</label>
                                            <select id="student_status" name="student_status"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                {{-- Student Status Dropdown --}}
                                                <option value="" @selected(old('student_status') == '')>Student status
                                                </option>
                                                <option value="1" @selected(old('student_status') == '1')>Active</option>
                                                <option value="2" @selected(old('student_status') == '2')>Inactive</option>
                                                <option value="3" @selected(old('student_status') == '3')>Graduate</option>
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
                                        placeholder="Your notes here">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />

                                </div>

                                <div class="flex w-full justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200">
                                        Create Student
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
