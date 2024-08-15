<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT | Create Data</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.3/resumable.min.js"></script>
</head>

<body>
    <section class="bg-white flex items-center justify-center" style="height: 100vh; padding-bottom: 3rem">
      <div class="py-8 px-4 lg:py-16" style="width: 40vw;">
          <h2 class="mb-4 text-5xl font-bold text-gray-900">Tambahkan Data</h2>

          <div class="card" style="width: 30rem; padding-bottom: 1rem">
            <div class="card-body">
              <h2>Silakan isi form dibawah ini kemudian submit untuk menambahkan data kedalam database.</h2>
            </div>
          </div>

          <form action="{{ route('it.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
              @csrf
              <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pb-10">
                  <div class="sm:col-span-2">
                      <label for="nama_file" class="block mb-2 text-sm font-medium text-gray-900 ">Name File</label>
                      <input type="text" name="nama_file" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" placeholder="Ketik nama file" required="" style="background-color:#D9D9D9;">
                  </div>
                  <div class="sm:col-span-2">
                  <label class="block mb-2 text-sm font-medium text-gray-900 " for="large_size">Upload Data</label>
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
                    name="preview_media">
                  </div>
              </div>
               <button type="submit" id="uploadBtn" class="rounded-md text-black mr-2" aria-expanded="false" data-dropdown-toggle="dropdown-user" style="background-color:#D9D9D9;">
                <a class="text-black-300 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
                <svg class="size-3 opacity-75 mr-2 mt-1 w-3 h-3"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
                Create
              </a>
          </button>

              <button type="button" class="rounded-md text-black" style="background-color:#D9D9D9;">
                  <a href="{{ url('it') }}" class="text-black-300 hover:bg-red-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
                    Cancel
                   </a>
              </button>
          </form>
      </div>
    </section>

    <script>
        // Inisialisasi Resumable.js
        var r = new Resumable({
            target: '{{ route('it.store') }}',
            query: function() {
                return {
                    _token: '{{ csrf_token() }}',
                    nama_file: document.getElementById('name').value,
                };
            },
            fileType: ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'txt', 'xlsx', 'mp4', 'webm', 'ogg'],
            chunkSize: 1 * 1024 * 1024, // 1MB per chunk
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        // Pilih file dari input
        r.assignBrowse(document.querySelector('[name="preview_media"]'));

        // Event ketika file ditambahkan
        r.on('fileAdded', function(file) {
            console.log('File added:', file);
            if (r.files.length > 0) {
                r.upload();
            } else {
                alert('Please select a file before uploading.');
            }
        });

        // Event ketika file berhasil diupload
        r.on('fileSuccess', function(file, response) {
            alert('File upload success!');
            window.location.href = '{{ route("it.index") }}';
        });

        // Event ketika file gagal diupload
        r.on('fileError', function(file, response) {
            alert('File upload failed.');
        });
    </script>

</body>
</html>

</body>
</html>
