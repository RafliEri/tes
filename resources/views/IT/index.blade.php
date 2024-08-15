@extends('layouts.nav')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>

  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
  <style>
    .modal {
        display: none;
        position: fixed;
        z-index: 2;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 70%;
        border-radius: 10px;
        left: 24vw;
        position: absolute;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
  </style>
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
                   <a href="{{ url('it/create') }}" method="POST" class="text-black-300 hover:bg-sky-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
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
                         Nama File
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Pratinjau
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Create At
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Create By
                     </th>
                     <th scope="col" class="px-6 py-3">
                         Action
                     </th>
                 </tr>
             </thead>
             <tbody>
               @foreach ($its as $item)
                 <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-fit">
                      <td class="w-4 p-4">
                         <div class="flex items-center pl-1">
                         {{ $item->id }}
                         </div>
                     </td>
                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $item->nama_file }}
                     </th>
                     <td class="px-6 py-4">
                         @if (in_array(pathinfo($item->preview_media, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png' , 'JPG']))
                             <img src="{{ $item->file_url }}" class="w-16 md:w-20 max-w-full max-h-full rounded-md cursor-pointer" alt="Image Preview" onclick="openModal('{{ $item->file_url }}', 'image')">
                         @elseif (pathinfo($item->preview_media, PATHINFO_EXTENSION) == 'pdf')
                             <a href="{{ $item->file_url }}" target="_blank" class="text-black-300 hover:text-red-600 px-3 py-2 rounded-md text-xl font-medium flex">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                              </svg>
                             </a>
                         @elseif (in_array(pathinfo($item->preview_media, PATHINFO_EXTENSION), ['txt', 'doc', 'docx']))
                               <a href="{{ $item->file_url }}" target="_blank" class="text-black-300 hover:text-blue-400 px-3 py-2 rounded-md text-xl font-medium flex">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                              </svg>
                              </a>
                         @elseif (pathinfo($item->preview_media, PATHINFO_EXTENSION) == 'xlsx')
                               <a href="{{ $item->file_url }}" target="_blank" class="text-black-300 hover:text-green-400 px-3 py-2 rounded-md text-xl font-medium flex">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                              </svg>
                              </a>
                         @elseif (in_array(pathinfo($item->preview_media, PATHINFO_EXTENSION), ['mp4', 'webm', 'ogg']))
                              <div class="flex justify-center items-center w-fit">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="z-index: 2" class="text-gray-800 size-6 absolute cursor-pointer">
                              <path onclick="openModal('{{ $item->file_url }}', 'video')" fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                              </svg>
                              <div class="flex justify-center items-center w-fit blur-sm hover:blur-none">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="z-index: 2" class="text-gray-800 size-6 absolute cursor-pointer">
                              <path onclick="openModal('{{ $item->file_url }}', 'video')" fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                              </svg>
                                <video src="{{ $item->file_url }}" class="w-16 md:w-20 max-w-full max-h-full rounded-md cursor-pointer" alt="Video Preview" onclick="openModal('{{ $item->file_url }}', 'video')">
                              </div>
                              </div>

                         @else
                             <a href="{{ $item->file_url }}" target="_blank" class="text-blue-600 hover:underline">Unduh</a>
                         @endif
                     </td>
                     <td class="px-6 py-4">
                         {{ $item->created_at }}
                     </td>
                     <td class="px-10 py-4">
                         {{ $username = $item->users ? $item->users->username : 'User telah dihapus' }}
                     </td>
                     <td class="py-7 my-10 flex items-center">
                        <form action="{{ route('it.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-black-300 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-4.318-.518m-11.16.684c.34-.06.68-.114 1.022-.166m0 0L5.84 19.673A2.25 2.25 0 0 0 8.084 21.75h7.832a2.25 2.25 0 0 0 2.244-2.077L19.23 5.79m-14.456 0a48.67 48.67 0 0 1 4.318-.518m5.478 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                      <a href="{{ route('it.edit', ['it' => $item->id]) }}" class="text-black-300 hover:text-yellow-400 px-3 py-2 rounded-md text-sm font-medium flex">
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

 <!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <div class="flex items-start">
      <span class="close text-black hover:bg-red-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
      </svg>
        Back
      </span>
    </div>
    <img id="modalImage" src="" class="w-full hidden rounded-lg pt-2">
    <video id="modalVideo" controls class="w-full hidden rounded-lg pt-2">
        <source id="modalVideoSource" src="" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <a id="downloadLink" href="" download class="mt-2 flex justify-center text-black-300 hover:bg-sky-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">Download</a>
  </div>
</div>

<script>
  function openModal(fileUrl, fileType) {
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImage");
    var modalVideo = document.getElementById("modalVideo");
    var modalVideoSource = document.getElementById("modalVideoSource");
    var downloadLink = document.getElementById("downloadLink");

    modal.style.display = "block";
    downloadLink.href = fileUrl;

    if (fileType === 'image') {
      modalImg.src = fileUrl;
      modalImg.classList.remove("hidden");
      modalVideo.classList.add("hidden");
    } else if (fileType === 'video') {
      modalVideoSource.src = fileUrl;
      modalVideo.load();
      modalVideo.classList.remove("hidden");
      modalImg.classList.add("hidden");
    }
  }

  var span = document.getElementsByClassName("close")[0];

  span.onclick = function() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
</body>
</html>
    