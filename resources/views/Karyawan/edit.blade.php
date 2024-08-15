<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan | Edit Data</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>
<body style="height: 100vh;">
<section class="bg-white flex items-center justify-center" style="padding-bottom: 3rem">
  <div class="py-8 px-4 lg:py-16" style="width: 40vw;">
      <h2 class="mb-4 text-5xl font-bold text-gray-900">Edit Data</h2>
      <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 pb-10">
              <div class="sm:col-span-2">
                  <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                  <input type="text" value="{{ $karyawan->nama }}" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" placeholder="Masukan Nama" required="" style="background-color:#D9D9D9;">
              </div>

              <div class="sm:col-span-2">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                  <input type="email" value="{{ $karyawan->email}}" name="email" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" placeholder="Masukan Email" required="" style="background-color:#D9D9D9;">
              </div>

              <div class="sm:col-span-2">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">No Telepon</label>
                  <input type="number" value="{{ $karyawan->no_telp }}" name="no_telp" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full [&::-webkit-inner-spin-button]:appearance-none [appearance:textfield]" placeholder="Masukan No.Telepon" required="" style="background-color:#D9D9D9;">
              </div>

              <div class="sm:col-span-2">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Jabatan</label>
                  <input type="text"  value="{{ $karyawan->jabatan }}" name="jabatan" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" placeholder="Pilih Jabatan" required="" style="background-color:#D9D9D9;">
              </div>

              <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 " for="large_size">Upload Foto</label>
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
                name="foto"
                value="{{ $karyawan->foto }}">
                </label>
              </div>

              <!-- <div class="sm:col-span-2">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 ">Role</label>
                    <select type="text" name="role" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full" placeholder="Masukan" required="" style="background-color:#D9D9D9;">
                        {{-- <option selected disabled>Pilih Role</option> --}}
                        <option value="superadmin">Super Admin</option>
                        <option value="pembina">Pembina</option>
                        <option value="pengurus">Pengurus</option>
                        <option value="dps">DPS</option>
                        <option value="ceo">CEO</option>
                        <option value="hrd">HRD</option>
                        <option value="divisi_digital_konten">Divisi Digital Konten</option>
                        <option value="divisi_marketing">Divisi Marketing</option>
                        <option value="divisi_IT">Divisi IT</option>
                        <option value="divisi_program">Divisi Program</option>
                        <option value="divisi_finance">Divisi Finance</option>
                        <option value="divisi_fundraising">Divisi Fundraising</option>
                    </select>
                </div> -->
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
              <a href="{{ url('karyawan') }}" class="text-black-300 hover:bg-red-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex">
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
