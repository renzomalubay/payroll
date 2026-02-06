@extends('layouts.app')
@section('content')
  <div class="p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Employees</p>
        <p class="text-3xl font-bold text-gray-800">128</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Active Shifts</p>
        <p class="text-3xl font-bold text-green-600">42</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Leave Requests</p>
        <p class="text-3xl font-bold text-blue-600">12</p>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
      <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800">Recent Hires</h2>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
          + Add Employee
        </button>
      </div>
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-sm font-semibold text-gray-600">Name</th>
            <th class="px-6 py-4 text-sm font-semibold text-gray-600">Department</th>
            <th class="px-6 py-4 text-sm font-semibold text-gray-600">Status</th>
            <th class="px-6 py-4 text-sm font-semibold text-gray-600">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 flex items-center space-x-3">
              <div
                class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold text-xs">
                JD</div>
              <span class="text-gray-700">John Doe</span>
            </td>
            <td class="px-6 py-4 text-gray-600">Engineering</td>
            <td class="px-6 py-4">
              <span
                class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full uppercase font-bold">Full-time</span>
            </td>
            <td class="px-6 py-4">
              <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
            </td>
          </tr>
          <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 flex items-center space-x-3">
              <div
                class="w-8 h-8 bg-pink-100 text-pink-700 rounded-full flex items-center justify-center font-bold text-xs">
                SS</div>
              <span class="text-gray-700">Sarah Smith</span>
            </td>
            <td class="px-6 py-4 text-gray-600">Marketing</td>
            <td class="px-6 py-4">
              <span
                class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full uppercase font-bold">Contract</span>
            </td>
            <td class="px-6 py-4">
              <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
