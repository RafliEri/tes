<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra | Edit Data</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>
<body>
<section class="bg-white flex items-center justify-center" style="height: 100vh; padding-bottom: 3rem">
  <div class="py-8 px-4 lg:py-16" style="width: 40vw;">
      <h2 class="mb-4 text-5xl font-bold text-gray-900">Edit Data</h2>

      <form action="{{ route('mitra.update', $mitras->id) }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pb-10">
              <div class="sm:col-span-2">
                  <label for="nama_file" class="block mb-2 text-sm font-medium text-gray-900 ">Name File</label>
                  <input type="text" name="nama_file" id="nama_konten" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" placeholder="Masukkan Nama File" required="" style="background-color:#D9D9D9;"
                  value="{{ $mitras->nama_file }}">
              </div>
              <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 " for="preview_media">Upload Data</label>
              <input type="file" class="block w-full text-sm text-gray-500
                file:me-4 file:py-2 file:px-4
                file:rounded-lg file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-600 file:text-white
                hover:file:bg-blue-700
                file:disabled:opacity-50 file:disabled:pointer-events-none
                dark:text-neutral-500
                dark:file:bg-blue-500
                dark:hover:file:bg-blue-400
                rounded-lg" style="background-color:#D9D9D9;"
                name="preview_media" id="preview_media"
                value="{{ $mitras->preview_media }}">
                </label>
              </div>
          </div>
          <button type="submit" class="rounded-md text-black mr-2" aria-expanded="false" data-dropdown-toggle="dropdown-user" style="background-color:#D9D9D9;">
              <a class="text-black-300 hover:bg-yellow-400 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
                <svg class="size-3 opacity-75 mr-2 mt-1 w-3 h-3"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
                Edit Data
              </a>
          </button>

          <button type="button" class="rounded-md text-black" aria-expanded="false" data-dropdown-toggle="dropdown-user" style="background-color:#D9D9D9;">
              <a href="{{ url('mitra') }}" class="text-black-300 hover:bg-red-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
                <svg class="size-3 opacity-75 mr-2 mt-1 w-3 h-3"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                Cancel
               </a>
          </button>
      </form>
  </div>
</section>
</body>
</html>
