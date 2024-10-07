@extends('admin.layout.header')

@section('container')
<h2
      class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
      Kelola Matkul
    </h2>
    <div class="flex justify-start">
        <a href="{{ route('matkul.create') }}" class="inline-block">
            <button
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Tambah Mata Kuliah
          </button>
        </a>
    </div>
    <form action="{{ route('matkul.index') }}" method="GET" class="mt-4 w-1/2">
        <!-- Input untuk pencarian berdasarkan kode atau nama matkul -->
        <input type="text" name="search" placeholder="Cari berdasarkan kode atau nama matkul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ request()->get('search') }}">

        <!-- Dropdown untuk memilih semester -->
        <select name="semesterId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
            <option value="">-- Pilih Semester --</option>
            @foreach($semesters as $semester)
                <option value="{{ $semester->id }}" {{ request()->get('semesterId') == $semester->id ? 'selected' : '' }}>
                    Semester {{ $semester->semester }}
                </option>
            @endforeach
        </select>

        <!-- Tombol submit -->
        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Cari</button>
    </form>

<div class="w-full mt-2 overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-y-auto ">
        <table class="md:table-fixed whitespace-no-wrap">
            <thead>
                <tr class="text-l font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">No.</th>
                    <th class="px-4 py-3">Kode Matkul</th>
                    <th class="px-4 py-3">Nama Matkul</th>
                    <th class="px-4 py-3">Total SKS</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                @php
                    $i = 1;
                @endphp

                <!-- Looping melalui setiap kelompok berdasarkan semester -->
                @foreach ($groupedMatkuls as $semester => $matkuls)
                    <!-- Header untuk setiap semester -->
                    <tr>
                        <td colspan="7" class="text-lg font-semibold bg-gray-100 dark:bg-gray-700 text-center">
                            Semester {{ $semester }}
                        </td>
                    </tr>

                    <!-- Looping mata kuliah dalam setiap semester -->
                    @foreach ($matkuls as $matkul)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">{{ $i++ }}</td>
                            <td class="px-4 py-3">{{ $matkul->kodeMatkul }}</td>
                            <td class="px-4 py-3">{{ $matkul->namaMatkul }}</td>
                            <td class="px-4 py-3">{{ $matkul->totalSks }}</td>
                            <td class="px-4 py-3">{{ $matkul->typeMatkul ? $matkul->typeMatkul->sifat : 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <a class="btn btn-outline-warning" href="{{ route('matkul.edit', $matkul->id) }}">
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </button>
                                    </a>

                                    <form id="deleteForm" action="{{ route('matkul.destroy', $matkul->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" @click="openModal" class="btn btn-outline-danger flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                @endforeach
            </tbody>
        </table>

    </div>
</div>
<div
  x-show="isModalOpen"
  x-transition:enter="transition ease-out duration-150"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition ease-in duration-150"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0"
  class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
>
  <div
    x-show="isModalOpen"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 transform translate-y-1/2"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0  transform translate-y-1/2"
    @click.away="closeModal"
    @keydown.escape="closeModal"
    class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
    role="dialog"
    id="modal"
  >
    <!-- Modal header -->
    <header class="flex justify-end">
      <button
        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
        aria-label="close"
        @click="closeModal"
      >
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
          <path
            fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
    </header>

      <!-- Modal Body -->
      <div class="mt-4 mb-6">
        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
          Hapus Mata Kuliah
        </p>
        <p class="text-sm text-gray-700 dark:text-gray-400">
          Apakah Anda yakin ingin menghapus mata kuliah ini? Tindakan ini tidak dapat diurungkan.
        </p>
      </div>

      <!-- Modal Footer with Delete Form -->
      <footer
        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
      >
        <button
          @click="closeModal"
          class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
        >
          Cancel
        </button>

        <!-- Form for Deleting the Matkul -->
        <form action="{{ route('matkul.destroy', $matkul->id) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button
            type="submit"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Hapus
          </button>
        </form>
      </footer>
  </div>
</div>


@endsection
