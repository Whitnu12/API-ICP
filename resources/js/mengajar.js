import { getApiUrl } from "./api.js";
import { showAlert } from "./toast.js";

// Event listener untuk menghandle submit form penambahan mata pelajaran
function addJadwal() {
    const namaMapel = document.getElementById("nama_mapel").value;
    const kelas = document.getElementById("kelas").value;
    const guru = document.getElementById("guru").value;
    const hari = document.getElementById("hari").value;
    const jamMulai = document.getElementById("jam_mulai").value;
    const jamBelajar = document.getElementById("jam_belajar").value;

    const jadwalData = {
        kode_mapel: namaMapel,
        id_kelas: kelas,
        id_guru: guru,
        hari: hari,
        jam_mulai: jamMulai,
        jam_belajar: jamBelajar,
    };

    fetch(getApiUrl("jadwal-mengajar"), {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(jadwalData),
    })
        .then((response) => {
            if (response.ok) {
                // Tampilkan pesan sukses
                showAlert("Jadwal Mengajar berhasil ditambahkan", "success");
                console.log("Jadwal Mengajar berhasil ditambahkan");
                getDataMengajar();
            } else {
                // Tangkap pesan error dari respons JSON jika ada
                response.json().then((error) => {
                    showAlert(
                        "Gagal menambahkan Jadwal Mengajar: " + error.message,
                        "error"
                    );
                    console.error(
                        "Gagal menambahkan Jadwal Mengajar:",
                        error.message
                    );
                });
            }
        })
        .catch((error) => {
            // Tampilkan pesan error
            showAlert("Terjadi kesalahan: " + error.message, "error");
            console.error("Terjadi kesalahan:", error);
        });
}

// Fungsi untuk menghapus mata pelajaran
function deleteJadwal(id) {
    fetch(getApiUrl(`jadwal-mengajar/${id}`), {
        method: "DELETE",
        headers: {},
    })
        .then((response) => {
            if (response.ok) {
                // Tampilkan pesan sukses
                getDataMengajar(); // Memperbarui tabel setelah berhasil menambahkan mata pelajaran
                showAlert("Mata pelajaran berhasil dihapus");
                console.log("Mata pelajaran berhasil dihapus");
            } else {
                // Tampilkan pesan error
                showAlert("Gagal menghapus mata pelajaran");
                console.error("Gagal menghapus mata pelajaran");
            }
        })
        .catch((error) => {
            // Tampilkan pesan error
            showAlert("Terjadi kesalahan");
            console.error("Terjadi kesalahan:", error);
        });
}

//Fungsi untuk memperbarui mata pelajaran
function updateJadwal() {
    const id = document.getElementById("id_mengajar2").value;
    const namaMapel = document.getElementById("nama_mapel2").value;
    const kelas = document.getElementById("kelas2").value;
    const guruSelect = document.getElementById("guru2").value;
    const jamMulai = document.getElementById("jam_mulai2").value;
    const jamBelajar = document.getElementById("jam_belajar2").value;
    const hari = document.getElementById("hari2").value;

    const jadwalData = {
        kode_mapel: namaMapel,
        id_kelas: kelas,
        id_guru: guruSelect,
        jam_mulai: jamMulai,
        jam_belajar: jamBelajar,
        hari: hari,
    };

    fetch(getApiUrl(`jadwal-mengajar/${id}`), {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(jadwalData),
    })
        .then((response) => {
            if (response.ok) {
                // Handle success response
                showAlert("Data berhasil diperbarui", "success");
                console.log("Data berhasil diperbarui");
                getDataMengajar();
            } else {
                // Handle error response
                showAlert("Gagal memperbarui data", "error");
                console.error("Gagal memperbarui data");
            }
        })
        .catch((error) => {
            // Handle error
            showAlert("Terjadi kesalahan", "error");
            console.error("Terjadi kesalahan:", error);
        });
}

let mengajarData = [];

function getDataMengajar() {
    fetch(getApiUrl("jadwal-mengajar"))
        .then((response) => response.json())
        .then((data) => {
            mengajarData = data;
            renderMengajar(data);
        })
        .catch((error) => {
            console.error("Terjadi kesalahan:", error);
        });
}

function renderMengajar(data) {
    const mengajarBody = document.getElementById("mengajarBody");

    // Menghapus semua baris yang ada di dalam tbody
    mengajarBody.innerHTML = "";

    // Mengisi tabel dengan data mata pelajaran
    if (data && data.length > 0) {
        data.forEach((mengajar, index) => {
            const row = document.createElement("tr");
            row.classList.add(`hover:bg-gray-100`, `bg-white`);

            // Kolom No
            const noCell = document.createElement("td");
            noCell.classList.add("tableCellid");
            noCell.textContent = index + 1;
            row.appendChild(noCell);

            // Kolom Nama Mata Pelajaran
            const namaMapelCell = document.createElement("td");
            namaMapelCell.classList.add("tableCellMapel");
            namaMapelCell.textContent = mengajar.mapel.nama_mapel;
            row.appendChild(namaMapelCell);

            // Kolom Kelas
            const kelasCell = document.createElement("td");
            kelasCell.classList.add("tableCellMapel");
            kelasCell.textContent = mengajar.kelas.kode_kelas;
            row.appendChild(kelasCell);

            // Kolom Pengajar
            const pengajarCell = document.createElement("td");
            pengajarCell.classList.add("tableCellMapel");

            const badge = document.createElement("span");
            badge.classList.add(`bg-green-100`);
            badge.classList.add(`text-green-800`);
            badge.classList.add(`text-sm`);
            badge.classList.add(`font-medium`);
            badge.classList.add(`mr-2`);
            badge.classList.add(`px-2.5`);
            badge.classList.add(`py-0.5`);
            badge.classList.add(`rounded`);
            badge.textContent = mengajar.guru.nama;

            pengajarCell.appendChild(badge);
            row.appendChild(pengajarCell);

            // Kolom Hari
            const hariCell = document.createElement("td");
            hariCell.classList.add("tableCellMapel");
            hariCell.textContent = mengajar.hari;
            row.appendChild(hariCell);

            // Kolom Mulai
            const mulaiCell = document.createElement("td");
            mulaiCell.classList.add("tableCellMapel");
            mulaiCell.textContent = mengajar.jam_mulai;
            row.appendChild(mulaiCell);

            // Kolom Selesai
            const selesaiCell = document.createElement("td");
            selesaiCell.classList.add("tableCellMapel");
            selesaiCell.textContent = mengajar.jam_selesai;
            row.appendChild(selesaiCell);

            // Kolom Jam Belajar
            const jamBelajarCell = document.createElement("td");
            jamBelajarCell.classList.add("tableCellMapel");
            jamBelajarCell.textContent = mengajar.jam_belajar;
            row.appendChild(jamBelajarCell);

            // Kolom Action - Tombol Delete
            const deleteCell = document.createElement("td");
            deleteCell.classList.add("tableCellAction");
            const deleteButton = document.createElement("button");
            deleteButton.innerHTML = `
                    <div class="bg-red-50 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500  m-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    </div>
                  `;
            deleteButton.addEventListener("click", () => {
                deleteJadwal(mengajar.id_mengajar);
            });
            deleteCell.appendChild(deleteButton);
            row.appendChild(deleteCell);

            // Kolom Action - Tombol Update
            const updateCell = document.createElement("td");
            updateCell.classList.add("tableCellAction");
            const updateButton = document.createElement("button");
            updateButton.innerHTML = `
                    <div class="bg-green-50 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"class="w-5 h-5 text-green-500  m-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>

                    </div>
                  `;
            updateButton.addEventListener("click", () => {
                fillFormWithJadwal(mengajar.id_mengajar);
            });
            updateCell.appendChild(updateButton);
            row.appendChild(updateCell);

            // Menambahkan event listener untuk pemilihan baris mata pelajaran
            row.addEventListener("click", () => {
                const rows = document.querySelectorAll(".tableRow");
                rows.forEach((row) => {
                    row.classList.remove("selected");
                });
                row.classList.add("selected");
            });

            // Menambahkan baris ke dalam tbody
            mengajarBody.appendChild(row);
        });
    } else {
        // Tidak ada data yang diterima
        const row = document.createElement("tr");
        const emptyCell = document.createElement("td");
        emptyCell.setAttribute("colspan", "8");
        emptyCell.textContent = "Tidak ada data mata pelajaran";
        row.appendChild(emptyCell);
        mengajarBody.appendChild(row);
    }
}

function fillFormWithJadwal(id_mengajar) {
    const mengajar = mengajarData.find(
        (item) => item.id_mengajar === id_mengajar
    );

    if (mengajar) {
        document.getElementById("guru2").value = mengajar.guru.nama;
        document.getElementById("kelas2").value = mengajar.kelas.kode_kelas;
        document.getElementById("id_mengajar2").value = mengajar.id_mengajar;
        document.getElementById("hari2").value = mengajar.hari;
        document.getElementById("nama_mapel2").value =
            mengajar.mapel.kode_mapel;
        document.getElementById("jam_mulai2").value = mengajar.jam_mulai;
        document.getElementById("jam_belajar2").value = mengajar.jam_belajar;

        // Memperbarui tampilan dropdown Select2
        const kelasSelect = $("#kelas2");
        kelasSelect.val(mengajar.kelas.id_kelas).trigger("change");

        const guruSelect = $("#guru2");
        guruSelect.val(mengajar.guru.id_guru).trigger("change");
        const hariSelect = $("#hari2");
        hariSelect.val(mengajar.hari).trigger("change");

        const mapelSelect = $("#nama_mapel2");
        mapelSelect.val(mengajar.mapel.kode_mapel).trigger("change");
    }
}

function populateKelasDropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("kelas"))
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("kelas");
            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih Jurusan"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih kelas";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.data.forEach((kelas) => {
                const option = document.createElement("option");
                option.value = kelas.id_kelas;
                option.text = kelas.kode_kelas;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}
function populateGuruDropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("guru"))
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("guru");
            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih Jurusan"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih guru";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.data.forEach((guru) => {
                const option = document.createElement("option");
                option.value = guru.id_guru;
                option.text = guru.nama;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}

function populateMapelDropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("mata-pelajaran"))
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("nama_mapel");

            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih Jurusan"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih Mapel";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.forEach((mataPelajaran) => {
                const option = document.createElement("option");
                option.value = mataPelajaran.kode_mapel;
                option.text = mataPelajaran.nama_mapel;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}

function populateKelas2Dropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("kelas"))
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("kelas2");
            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih Jurusan"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih kelas";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.data.forEach((kelas) => {
                const option = document.createElement("option");
                option.value = kelas.id_kelas;
                option.text = kelas.kode_kelas;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}
function populateGuru2Dropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("guru"))
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("guru2");
            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih Jurusan"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih guru";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.data.forEach((guru) => {
                const option = document.createElement("option");
                option.value = guru.id_guru;
                option.text = guru.nama;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}

function populateMapel2Dropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("mata-pelajaran"))
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("nama_mapel2");

            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih Jurusan"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih Mapel";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.forEach((mataPelajaran) => {
                const option = document.createElement("option");
                option.value = mataPelajaran.kode_mapel;
                option.text = mataPelajaran.nama_mapel;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}

// Memanggil fungsi untuk mendapatkan dan menampilkan data mata pelajaran saat halaman dimuat
getDataMengajar();
populateKelasDropdown();
populateMapelDropdown();
populateGuruDropdown();

populateKelas2Dropdown();
populateMapel2Dropdown();
populateGuru2Dropdown();

// populateJurusan2Dropdown();
// populateGuru2Dropdown();

const form = document.getElementById("rubahMengajar");
form.addEventListener("submit", function (event) {
    event.preventDefault();
    updateJadwal();
});

document
    .getElementById("tambahMengajar")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        addJadwal();
    });

$(document).ready(function () {
    $("#kelas").select2();
});

$(document).ready(function () {
    $("#guru").select2();
});

$(document).ready(function () {
    $("#nama_mapel").select2();
});

$(document).ready(function () {
    $("#hari").select2();
});

$(document).ready(function () {
    $("#kelas2").select2();
});

$(document).ready(function () {
    $("#guru2").select2();
});

$(document).ready(function () {
    $("#nama_mapel2").select2();
});

$(document).ready(function () {
    $("#hari2").select2();
});
