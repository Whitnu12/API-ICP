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
            <form id="addJurusan">
                @csrf
                <div>
                    <label for="jurusan">Jurusan:</label>
                    <input type="text" name="jurusan" id="jurusan" placeholder="Jurusan" required>
                </div>
                <button type="submit">Tambah</button>
            </form>




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
                    class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings-example" role="tabpanel"
            aria-labelledby="settings-tab-example">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts-example" role="tabpanel"
            aria-labelledby="contacts-tab-example">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking
                another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
                the content visibility and styling.</p>
        </div>
    </div>
@endsection
