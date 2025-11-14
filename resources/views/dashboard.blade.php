<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                    <x-alerts />

                    {{-- Form for Filters --}}
                    <form method="GET" action="{{ url()->current() }}">

                        <div class="flex flex-col sm:flex-row mb-4 sm:justify-between sm:items-end gap-2">

                            {{-- Search Input  --}}
                            <div class="w-full sm:w-80">
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

                                    <input type="text" id="table-search-students" name="search"
                                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Search for students" value="{{ request('search') }}">
                                </div>
                            </div>


                            <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-2">
                                <div class="grid grid-cols-2 xs:grid-cols-3 sm:flex sm:flex-row gap-2">
                                    {{-- Program Filter Dropdown --}}
                                    <div>
                                        <button id="programFilter" data-dropdown-toggle="dropdownProgramFilter"
                                            class="w-full sm:w-auto text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center justify-center"
                                            type="button">Programs <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>

                                        <div id="dropdownProgramFilter"
                                            class="z-10 hidden w-36 bg-white divide-y divide-gray-100 rounded-lg shadow-lg">
                                            <ul class="p-3 space-y-3 text-sm text-gray-700 max-h-48 overflow-y-auto"
                                                aria-labelledby="dropdownProgramFilter">
                                                @foreach ($programs as $program)
                                                    <li class="hover:bg-gray-100 rounded-md transition-colors">
                                                        <label for="program-item-{{ $program->program_id }}"
                                                            class="flex items-center space-x-2 p-1 cursor-pointer">
                                                            <input id="program-item-{{ $program->program_id }}"
                                                                type="checkbox" value="{{ $program->program_id }}"
                                                                name="programs[]" @checked(in_array($program->program_id, (array) request('programs')))
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                            <span
                                                                class="text-gray-900">{{ $program->program_Code }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Year Level Filter Dropdown --}}
                                    <div>
                                        <button id="yearFilter" data-dropdown-toggle="dropdownYearFilter"
                                            class="w-full sm:w-auto text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center justify-center"
                                            type="button">Year Level <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>

                                        <div id="dropdownYearFilter"
                                            class="z-10 hidden w-36 bg-white divide-y divide-gray-100 rounded-lg shadow-lg">
                                            <ul class="p-3 space-y-3 text-sm text-gray-700 max-h-48 overflow-y-auto"
                                                aria-labelledby="dropdownYearFilter">
                                                @php
                                                    $yearLevels = [1, 2, 3, 4, 5, 6];
                                                    $yearLabels = [
                                                        '1st Year',
                                                        '2nd Year',
                                                        '3rd Year',
                                                        '4th Year',
                                                        '5th Year',
                                                        '6th Year',
                                                    ];
                                                @endphp
                                                @foreach ($yearLevels as $index => $year)
                                                    <li class="hover:bg-gray-100 rounded-md transition-colors">
                                                        <label for="year-item-{{ $year }}"
                                                            class="flex items-center space-x-2 p-1 cursor-pointer">
                                                            <input id="year-item-{{ $year }}" type="checkbox"
                                                                value="{{ $year }}" name="years[]"
                                                                @checked(in_array($year, (array) request('years')))
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                            <span
                                                                class="text-gray-900">{{ $yearLabels[$index] }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Status Filter Dropdown --}}
                                    <div>
                                        <button id="statusFilter" data-dropdown-toggle="dropdownStatusFilter"
                                            class="w-full sm:w-auto text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center justify-center"
                                            type="button">Status <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>

                                        <div id="dropdownStatusFilter"
                                            class="z-10 hidden w-36 bg-white divide-y divide-gray-100 rounded-lg shadow-lg">
                                            <ul class="p-3 space-y-3 text-sm text-gray-700 max-h-48 overflow-y-auto"
                                                aria-labelledby="dropdownStatusFilter">
                                                @php
                                                    $statuses = [
                                                        1 => 'Active',
                                                        2 => 'Inactive',
                                                        3 => 'Graduated',
                                                    ];
                                                @endphp

                                                @foreach ($statuses as $value => $label)
                                                    <li class="hover:bg-gray-100 rounded-md transition-colors">
                                                        <label for="status-item-{{ $value }}"
                                                            class="flex items-center space-x-2 p-1 cursor-pointer">
                                                            <input id="status-item-{{ $value }}"
                                                                type="checkbox" value="{{ $value }}"
                                                                name="statuses[]" @checked(in_array($value, (array) request('statuses')))
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                            <span class="text-gray-900">{{ $label }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="flex flex-row gap-2 w-full sm:w-auto">
                                    {{-- Clear Filters Button --}}
                                    <a href="{{ url()->current() }}"
                                        class="w-1/2 sm:w-auto text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center justify-center h-9">
                                        Clear
                                    </a>

                                    {{-- Apply Filters Button  --}}
                                    <button
                                        class="w-1/2 sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center justify-center h-9"
                                        type="submit">
                                        Apply Filters
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Table for Desktop / Card View for Mobile --}}
                    <div class="overflow-hidden">

                        {{-- Standard Table View (visible on screens 'sm' and up) --}}
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 hidden sm:table">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Program</th>
                                    <th scope="col" class="px-6 py-3">Year Level</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($students->isEmpty())
                                    <tr>
                                        <td colspan="5">
                                            <div class="flex flex-col items-center justify-center mt-24 mb-24">
                                                <div class="p-6 bg-gray-100 rounded-full">
                                                    <svg class="w-24 h-24 text-black" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="2"
                                                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                                    </svg>
                                                </div>
                                                <p class="mt-2 text-xl font-bold text-center text-black">
                                                    No Students Found
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($students as $student)
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                            {{-- Student Info (Name, Email, Student Number, Image --}}
                                            <th scope="row"
                                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                                <img class="w-10 h-10 rounded-full object-cover"
                                                    src="{{ $student->student_Image ? asset('storage/' . $student->student_Image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg' }}"
                                                    alt="{{ $student->student_Fname }}-image">
                                                <div class="ps-3">
                                                    <div class="text-base font-semibold">
                                                        {{ $student->student_FullName }}
                                                    </div>
                                                    <div class="font-normal text-gray-500">
                                                        {{ $student->student_Email }}
                                                    </div>
                                                    <div class="font-normal text-gray-500">
                                                        {{ $student->student_Number }}
                                                    </div>
                                                </div>
                                            </th>
                                            {{-- Program --}}
                                            <td class="px-6 py-4">{{ $student->programs->program_Title }}</td>
                                            {{-- Year Level --}}
                                            <td class="px-6 py-4">{{ $student->student_YearLevel }}</td>
                                            {{-- Status --}}
                                            <td class="px-6 py-4">
                                                @if ($student->student_Status == 1)
                                                    <div class="flex items-center text-green-700 font-medium">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                        Active
                                                    </div>
                                                @elseif ($student->student_Status == 2)
                                                    <div class="flex items-center text-yellow-700 font-medium">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-yellow-400 me-2"></div>
                                                        Inactive
                                                    </div>
                                                @else
                                                    <div class="flex items-center text-blue-700 font-medium">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div>
                                                        Graduated
                                                    </div>
                                                @endif
                                            </td>
                                            {{-- Action --}}
                                            <td class="px-6 py-4">

                                                <div class="flex flex-row gap-2">
                                                    <div x-data="{ tooltip: 'View Student Information' }">
                                                        <a href="{{ route('admin.students.show', $student->student_id) }}"
                                                            x-tooltip="tooltip" type="button"
                                                            class="inline-flex items-center p-1 text-sm font-medium text-center text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>

                                                        </a>
                                                    </div>

                                                    <div x-data="{ tooltip: 'Edit Student Information' }">
                                                        <a href="{{ route('admin.students.edit', $student->student_id) }}"
                                                            x-tooltip="tooltip" type="button"
                                                            class="inline-flex items-center p-1 text-sm font-medium text-center text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        {{-- Card View (visible only on small screens) --}}
                        <div class="sm:hidden space-y-4">
                            @foreach ($students as $student)
                                <div class="bg-white border border-gray-200 rounded-lg shadow p-4">

                                    {{-- Student Info (Name, Email, Student Number, Image --}}
                                    <div class="flex items-start mb-3">
                                        <img class="w-12 h-12 rounded-full object-cover mr-4"
                                            src="{{ $student->student_Image ? asset('storage/' . $student->student_Image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg' }}"
                                            alt="{{ $student->student_Fname }}-image">
                                        <div>
                                            <p class="text-lg font-bold text-gray-900">
                                                {{ $student->student_FullName }}</p>
                                            <p class="text-sm text-gray-500">{{ $student->student_Email }}</p>
                                            <p class="text-sm text-gray-500">{{ $student->student_Number }}</p>
                                        </div>
                                    </div>

                                    <hr class="my-3 border-gray-100">


                                    <div class="grid grid-cols-2 gap-3 text-sm">
                                        {{-- Program --}}
                                        <div>
                                            <p class="font-semibold text-gray-700">Program</p>
                                            <p class="text-gray-900">{{ $student->programs->program_Title }}</p>
                                        </div>
                                        {{-- Year Level --}}
                                        <div>
                                            <p class="font-semibold text-gray-700">Year Level</p>
                                            <p class="text-gray-900">{{ $student->student_YearLevel }}</p>
                                        </div>
                                        {{-- Status --}}
                                        <div class="col-span-2">
                                            <p class="font-semibold text-gray-700 mb-1">Status</p>
                                            @if ($student->student_Status == 1)
                                                <div class="flex items-center text-green-700 font-medium">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                    Active
                                                </div>
                                            @elseif ($student->student_Status == 2)
                                                <div class="flex items-center text-yellow-700 font-medium">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-yellow-400 me-2"></div>
                                                    Inactive
                                                </div>
                                            @else
                                                <div class="flex items-center text-blue-700 font-medium">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div>
                                                    Graduated
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <hr class="my-3 border-gray-100">

                                    {{-- Action buttons --}}
                                    <div class="flex justify-end gap-2">
                                        <div class="flex flex-row gap-2">
                                            <div x-data="{ tooltip: 'View Student Information' }">
                                                <a href="{{ route('admin.students.show', $student->student_id) }}"
                                                    x-tooltip="tooltip" type="button"
                                                    class="inline-flex items-center p-1 text-sm font-medium text-center text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>

                                                </a>
                                            </div>

                                            <div x-data="{ tooltip: 'Edit Student Information' }">
                                                <a href="{{ route('admin.students.edit', $student->student_id) }}"
                                                    x-tooltip="tooltip" type="button"
                                                    class="inline-flex items-center p-1 text-sm font-medium text-center text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-1 p-2">
                            {{ $students->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
