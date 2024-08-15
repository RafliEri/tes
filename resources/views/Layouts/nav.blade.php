<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&display=swap');

      body {
         font-family: Dosis;
      }
   </style>
</head>
<body>
    <!-- Navbar -->
<nav class="fixed top-0 z-50 border-b border-gray-200 w-full dark:border-gray-700" style="z-index: 0; background-color:#D9D9D9; left: 17vw; width: 83vw;">
    <div class="px-3 py-3 lg:px-5 lg:pl-3 m-1">
      <div class="flex items-center justify-between">
      <div class="text-lg" style="display: flex; flex-direction: row;">
          <img src="../image/logo.png" class="w-24 md:w-24 max-w-full max-h-full pr-3" style="border-right: 1px solid; border-color: #1b6608;">
          <div class="pl-3">
            <p style="color: #276C0E;">Djalaludin Pane</p>
            <p style="color: #FEA400;">Fondation</p>
          </div>
      </div>
        <div class="flex items-center justify-start rtl:justify-end">
        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
              <div>
                <button type="button" class="h-8 pr-2" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <a href="{{ url('/logout') }}" class="text-black-300 hover:bg-red-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="size-5 opacity-75"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                  >
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                  />
                  </svg>
                  Logout</a>
                </button>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Sidebar -->
  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r sm:translate-x-0 bg-gray-800 dark:border-gray-700" style="width: 17vw; z-index: 1;" aria-label="Sidebar">
      <div class="role py-10 text-white text-center justify-center text-2xl uppercase" style="background-color: #375900;">
          <h1>{{ (Auth::user()->role ) }}</h1>
      </div>
  <div class="h-full px-3 pb-4 pt-5 overflow-y-auto bg-gray-800">
        <ul class="space-y-2.5 font-medium">
            <li>
                <a href="{{ url('home') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>

                   <span class="ms-3">Home</span>
                </a>
             </li>

              <!-- Menu User -->
             <li>
             @if (Auth::user()->role == 'superadmin')
                <a href="{{ url('user') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "User") ? 'bg-gray-700 text-white' : ''}}">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "User") ? 'text-white' : ''}}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                   <span class="ms-3">User</span>
                </a>
              @else
              @endif
             </li>
             <!-- End Menu User -->

             <!-- Menu Karyawan -->
             @if (Auth::user()->role == 'superadmin')
             <li>
                <a href="{{ url('karyawan') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Karyawan") ? 'bg-gray-700 text-white' : ''}}">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Karyawan") ? 'text-white' : ''}}"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                   <span class="ms-3">Karyawan</span>
                </a>
                @elseif (Auth::user()->role == 'pembina')
             <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                   <span class="ms-3">Karyawan</span>
                </a>
                @elseif (Auth::user()->role == 'pengawas')
             <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                   <span class="ms-3">Karyawan</span>
                </a>
                @elseif (Auth::user()->role == 'pengurus')
             <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                   <span class="ms-3">Karyawan</span>
                </a>
                @elseif (Auth::user()->role == 'dps')
             <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                   <span class="ms-3">Karyawan</span>
                </a>
                @elseif (Auth::user()->role == 'ceo')
             <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                   <span class="ms-3">Karyawan</span>
                </a>
                @elseif (Auth::user()->role == 'hrd')
             <li>
                <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                   <span class="ms-3">Karyawan</span>
                </a>
                @else
              @endif
             </li>
             <!-- End Menu Karyawan -->

             <!-- Menu Digital Content -->
             <li>
             @if (Auth::user()->role == 'divisi_digital_konten')
                <a href="{{ url('digitalkonten') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Digital Konten") ? 'bg-gray-700 text-white' : ''}}">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Digital Konten") ? 'text-white' : ''}}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
                   <span class="ms-3">Digital Content</span>
                </a>
              @elseif (Auth::user()->role == 'superadmin')
                  <a href="{{ url('digitalkonten') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Digital Konten") ? 'bg-gray-700 text-white' : ''}}">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Digital Konten") ? 'text-white' : ''}}"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                  </svg>
                     <span class="ms-3">Digital Content</span>
                  </a>
              @else
              @endif
             </li>

              <!-- Menu Divisi Marketing -->
             <li>
              @if (Auth::user()->role == 'divisi_marketing')
                <a href="{{ url('marketing') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
                   <span class="ms-3">Marketing</span>
                </a>
              @elseif (Auth::user()->role == 'superadmin')
                  <a href="{{ url('marketing') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Marketing") ? 'bg-gray-700 text-white' : ''}}">
                  <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Marketing") ? 'text-white' : ''}}"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                  </svg>
                  <span class="ms-3">Marketing</span>
                  </a>
              @else
              @endif
             </li>

             <!-- Menu Divisi IT -->
             <li>
              @if (Auth::user()->role == 'divisi_IT')
              <a href="{{ url('it') }}" class="flex items-center p-2 rounded-lg text-white bg-gray-700 group">
                <svg class="w-6 h-6 transition duration-75 group-text-gray-900 text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                    <span class="ms-3">IT</span>
                </a>
              @elseif (Auth::user()->role == 'superadmin')
              <a href="{{ url('it') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "IT") ? 'bg-gray-700 text-white' : ''}}">
               <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "IT") ? 'text-white' : ''}}"
               xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
               </svg>

               <!-- <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "IT") ? 'text-white' : ''}}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg> -->
                    <span class="ms-3">IT</span>
                </a>
              @else
              @endif
              </li>


             <li>
             @if (Auth::user()->role == 'divisi_program')
                <a href="{{ url('program') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="w-6 h-6 transition duration-75 group-text-gray-900 text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                </svg>
                   <span class="ms-3">Program</span>
                </a>
              @elseif (Auth::user()->role == 'superadmin')
                <a href="{{ url('program') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Program") ? 'bg-gray-700 text-white' : ''}}">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Program") ? 'text-white' : ''}}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                </svg>
                   <span class="ms-3">Program</span>
                 </a>
              @else
              @endif
             </li>
             <!-- End Menu Program -->

             <!-- Menu Finance -->
             <li>
             @if (Auth::user()->role == 'divisi_finance')
                <a href="{{ url('finance') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
                   <span class="ms-3">Finance</span>
                </a>
              @elseif (Auth::user()->role == 'superadmin')
                <a href="{{ url('finance') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Finance") ? 'bg-gray-700 text-white' : ''}}">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Finance") ? 'text-white' : ''}}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
                   <span class="ms-3">Finance</span>
                </a>
              @else
              @endif
             </li>
             <!-- End Menu Finance -->

             <!-- Menu Fundraising -->
             <li>
             @if (Auth::user()->role == 'divisi_Fundraising')
                <a href="{{ url('fundraising') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                   <span class="ms-3">Fundraising</span>
                </a>
              @elseif (Auth::user()->role == 'superadmin')
                <a href="{{ url('fundraising') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Fundraising") ? 'bg-gray-700 text-white' : ''}}">
                <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Fundraising") ? 'text-white' : ''}}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                   <span class="ms-3">Fundraising</span>
                </a>
              @else
              @endif
             </li>
             <!-- End Menu Fundraising  -->

            <!-- Menu Mitra -->
             <li>
             @if (Auth::user()->role == 'superadmin')
             <a href="{{ url('mitra') }}" class="flex items-center p-2 rounded-lg text-white group hover:bg-gray-700 group {{ ($title === "Mitra") ? 'bg-gray-700 text-white' : ''}}">
             <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white {{ ($title === "Mitra") ? 'text-white' : ''}}"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
             <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
             </svg>
                   <span class="ms-3">Mitra</span>
               </a>
            @elseif (Auth::user()->role == 'ceo')
            <a href="{{ url('mitra') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
             <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
             <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
             </svg>
                   <span class="ms-3">Mitra</span>
               </a>
            @elseif (Auth::user()->role == 'hrd')
            <a href="{{ url('mitra') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
             <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
             <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
             </svg>
                   <span class="ms-3">Mitra</span>
               </a>
            @else
            @endif
             </li>
             <!-- End Menu Mitra -->
        </ul>
     </div>
  </aside>
  <!-- End Sidebar -->
</body>
</html>
