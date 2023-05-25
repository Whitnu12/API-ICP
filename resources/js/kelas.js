var dropdown = document.getElementById("tahunDropdown");

// Inisialisasi array tahun
var tahunList = [2020, 2021, 2022, 2023];

// Mengisi dropdown dengan opsi tahun
function populateDropdown() {
    // Menghapus opsi yang ada sebelumnya
    dropdown.innerHTML = "";

    // Menambahkan opsi tahun ke dropdown
    for (var i = 0; i < tahunList.length; i++) {
        var option = document.createElement("option");
        option.text = tahunList[i];
        dropdown.add(option);
    }
}

// Menambahkan tahun ke array dan mengupdate dropdown
function tambahTahun() {
    // Mendapatkan tahun terbaru
    var tahunTerbaru = tahunList[tahunList.length - 1] + 1;

    // Menambahkan tahun ke array
    tahunList.push(tahunTerbaru);

    // Menghapus tahun terlama jika melebihi rentang
    if (tahunList.length > 5) {
        tahunList.shift();
    }

    // Memperbarui dropdown dengan tahun baru
    populateDropdown();
}

// Memanggil fungsi populateDropdown() saat halaman dimuat
populateDropdown();

function fetchJurusanData(idJurusan, callback) {
    fetch(`http://192.168.100.6/laravel-icp2/public/api/jurusan/${idJurusan}`)
        .then((response) => response.json())
        .then((data) => {
            const jurusan = data.data;
            callback(jurusan);
        })
        .catch((error) => {
            console.error("Error:", error);
            callback("");
        });
}

function getDataKelas() {
    fetch(`http://192.168.100.6/laravel-icp2/public/api/kelas`)
        .then((response) => response.json())
        .then((data) => {
            renderKelasDataTable(data);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function renderKelasDataTable(data) {
    const table = document.getElementById("kelasBody");
    table.innerHTML = "";

    const kelasData = data.data;

    kelasData.forEach((kelas, index) => {
        const row = document.createElement("tr");

        const noCell = document.createElement("td");
        noCell.classList.add("tableCellid");
        noCell.textContent = index + 1;
        row.appendChild(noCell);

        //nomor
        const no = document.createElement("td");
        no.classList.add("tableCellid");
        no.textContent = kelas.id_kelas;
        row.appendChild(no);

        //kelas
        const kelasCell = document.createElement("td");
        kelasCell.classList.add("tableCellMapel");
        kelasCell.textContent = kelas.nama_kelas;
        row.appendChild(kelasCell);

        //jumlah murid
        const jumlahMurid = document.createElement("td");
        jumlahMurid.classList.add("tableCellMapel");
        jumlahMurid.textContent = kelas.jumlahMurid;
        row.appendChild(jumlahMurid);

        //jurusan
        const idJurusan = kelas.id_jurusan;
        const idJurusanCell = document.createElement("td");
        idJurusanCell.classList.add("tableCellMapel");
        // idJurusanCell.textContent = idJurusan;

        // Mendapatkan nama jurusan berdasarkan ID
        fetchJurusanData(idJurusan, (jurusan) => {
            idJurusanCell.textContent = jurusan
                ? jurusan.nama_jurusan
                : "Tidak ditemukan";
        });
        row.appendChild(idJurusanCell);

        // Mendapatkan nama jurusan berdasarkan ID
        // fetchJurusanData(idJurusan, (namaJurusan) => {
        //     idJurusanCell.textContent = namaJurusan;
        // });

        //tahun
        const tahun = document.createElement("td");
        tahun.classList.add("tableCellMapel");
        tahun.textContent = kelas.angkatan;
        row.appendChild(tahun);

        //aksi
        // const aksi = document.createElement("td");
        // aksi.classList.add("tableCell");
        // aksi.innerHTML = `<button class="btn btn-warning" onclick="editKelas(${kelas.id})">Edit</button>
        // <button class="btn btn-danger" onclick="deleteKelas(${kelas.id})">Delete</button>`;
        // row.appendChild(aksi);

        table.appendChild(row);
    });
}

function populateJurusanDropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch("http://192.168.100.6/laravel-icp2/public/api/jurusan")
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("jurusan");
            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih Jurusan"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih Jurusan";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.data.forEach((jurusan) => {
                const option = document.createElement("option");
                option.value = jurusan.id_jurusan;
                option.text = jurusan.nama_jurusan;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}

getDataKelas();
populateJurusanDropdown();

$(document).ready(function () {
    $("#jurusan").select2();
});

$(document).ready(function () {
    $("#tahunDropdown").select2();
});
