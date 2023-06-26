<head>
    @vite(['resources/js/sekolah.js', 'resources/js/jurusan.js'])
</head>

@extends('layout.admin_layout')
@section('content')
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="tabExample"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="profile-tab-example" type="button" role="tab" aria-controls="profile-example"
                    aria-selected="false">Jurusan</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab-example" type="button" role="tab" aria-controls="dashboard-example"
                    aria-selected="false">Kelas</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-tab-example" type="button" role="tab" aria-controls="settings-example"
                    aria-selected="false">Settings</button>
            </li>
            <li role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="contacts-tab-example" type="button" role="tab" aria-controls="contacts-example"
                    aria-selected="false">Contacts</button>
            </li>
        </ul>
    </div>
    <div id="tabContentExample">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile-example" role="tabpanel"
            aria-labelledby="profile-tab-example">
            <div class="flex gap-10 justify-around">
                <div>
                    <table id="jurusanTable" class=" text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="tableCellid py-2">No</th>
                                <th class="tableCellMapel">Jurusan</th>
                                <th class="tableCellAction" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="jurusanBody" class="">

                        </tbody>
                    </table>
                </div>
                <form id="addJurusan" class="bg-green-200 py-2 px-5">
                    <h1 class="text-2xl pb-2 font-semibold"> Tambah Jurusan</h1>
                    @csrf
                    <div>
                        <label for="jurusan" class="pb-3">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" placeholder="Tambah Jurusan" required
                            class="shadow appearance-none border-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <button type="submit"
                        class="bg-green-400 text-white text-lg px-10 py-2 mt-4 block w-full ">Tambah</button>
                </form>
            </div>



            {{-- <label for="grade">Grade:</label>
        <select id="grade">
          <option value="IX">IX</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
        <label for="value">Value:</label>
        <input type="text" id="value" />
      
        <script>
          var gradeDropdown = document.getElementById("grade");
          var valueInput = document.getElementById("value");
      
          gradeDropdown.addEventListener("change", function() {
            var selectedGrade = gradeDropdown.value;
            var selectedValue = valueInput.value;
            var result = selectedGrade + " " + selectedValue;
            console.log(result); // Outputkan hasil ke konsol (untuk keperluan debugging)
          });
        </script> --}}
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard-example" role="tabpanel"
            aria-labelledby="dashboard-tab-example">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>.
                Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to
                control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings-example" role="tabpanel"
            aria-labelledby="settings-tab-example">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to
                control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts-example" role="tabpanel"
            aria-labelledby="contacts-tab-example">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to
                control
                the content visibility and styling.</p>
        </div>
    </div>
@endsection
