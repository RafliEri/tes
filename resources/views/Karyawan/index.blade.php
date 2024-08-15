@extends('layouts.nav')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>

  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>
<body>
  <div class="absolute" style="height: 75vh; top: 10vh; left: 20vw; width: 63vw;">
    <div class="p-4 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14" style="width: 78vw">
 <div class="relative overflow-x-auto sm:rounded-lg">
     <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
         <div>
         <div class="flex items-center ms-3">
             <div >
               <button type="button" class="rounded-md text-black" aria-expanded="false" data-dropdown-toggle="dropdown-user" style="background-color:#D9D9D9;">
               <a href="{{ url('karyawan/create') }}" method="POST" class="text-black-300 hover:bg-sky-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
                <svg
                class="size-3 opacity-75 mr-2 mt-1 w-3 h-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 18 18"
                >
                <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 1v16M1 9h16"/>
                </svg>
                 Create
                </a>
               </button>
             </div>
           </div>
         </div>
         <label for="table-search" class="sr-only">Search</label>
         <div class="relative">
             <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                 <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
             </div>
             <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
         </div>
     </div>
         <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
             <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                 <tr>
                     <th scope="col" class="p-4">
                         No.
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Nama
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Email
                     </th>
                     <th scope="col" class="px-6 py-3">
                         No Telp
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Jabatan
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Foto
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Action
                     </th>
                 </tr>
             </thead>
             <tbody>
               @foreach ($karyawan as $item)
                 <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <td class="w-4 p-4">
                         <div class="flex items-center pl-1">
                         {{ $item->id }}
                         </div>
                     </td>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->nama }}
                     </th>
                     <td class="px-6 py-4">
                         {{ $item->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->no_telp }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->jabatan }}
                        </td>
                        <td class="py-4 px-3">
                            <img src="{{ asset('/storage/images/'.$item->foto) }}" class="w-14 h-14 object-cover rounded-full" alt="Image Preview">
                        </td>
                     <td class="px-1 py-10 flex">
                        <form action="{{ route('karyawan.destroy', ['karyawan' => $item->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-black-300 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                      <a href="{{ route('karyawan.edit', ['karyawan' => $item->id]) }}" class="text-black-300 hover:text-yellow-400 px-3 py-2 rounded-md text-sm font-medium flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                      </svg>
                      </a>
                  </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
    </div>
 </div>
</body>
</html>
