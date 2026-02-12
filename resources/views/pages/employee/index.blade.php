@extends('layouts.app')
@section('content')
  <div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Employee Management</h2>
      <button
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
        + Add Employee
      </button>
    </div>

    {{-- <div class="bg-black rounded-xl shadow-sm p-6 border border-gray-200">
      <table id="employeeTable" class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-black-50 border-b border-gray-200">
            <th class="px-4 py-3 text-black-600 font-semibold">ID</th>
            <th class="px-4 py-3 text-black-600 font-semibold">Name</th>
            <th class="px-4 py-3 text-black-600 font-semibold">Email</th>
            <th class="px-4 py-3 text-black-600 font-semibold w-24">Action</th>
          </tr>
        </thead>
      </table>
    </div> --}}

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 m-5">
      <table id="employeeTable" class="w-full text-sm text-left text-black">
        <thead class="bg-gray-50 text-black uppercase text-xs border-b border-gray-200">
          <tr>
            <th class="px-6 py-4 font-bold">Name</th>
            <th class="px-6 py-4 font-bold">Position</th>
            <th class="px-6 py-4 font-bold">Office</th>
            <th class="px-6 py-4 font-bold text-right">Salary</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
        </tbody>
      </table>
    </div>

  </div>
@endsection

@push('scripts')
  @vite('resources/views/pages/employee/index.ts')
@endpush
