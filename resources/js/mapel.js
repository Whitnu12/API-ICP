import { getApiUrl } from "./api.js";
import { showAlert } from "./toast.js";

// Event listener untuk menghandle submit form penambahan mata pelajaran
function addMataPelajaran() {
    const namaMapel = document.getElementById("namaMapel").value;
    const jurusan = document.getElementById("jurusan").value;
    const guru = Array.from(
        document.getElementById("guru").selectedOptions
    ).map((option) => option.value);

    const mapelData = {
        nama_mapel: namaMapel,
        id_jurusan: jurusan,
        id_guru: guru,
    };

    fetch(getApiUrl("mata-pelajaran/add"), {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(mapelData),
    })
        .then((response) => {
            if (response.ok) {
                // Tampilkan pesan sukses
                showAlert("Mata pelajaran berhasil ditambahkan", "success");
                console.log("Mata pelajaran berhasil ditambahkan");
                getDataMataPelajaran();
            } else {
                // Tangkap pesan error dari respons JSON jika ada
                response.json().then((error) => {
                    showAlert(
                        "Gagal menambahkan mata pelajaran: " + error.message,
                        "error"
                    );
                    console.error(
                        "Gagal menambahkan mata pelajaran:",
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
function deleteMapel(id) {
    fetch(getApiUrl(`mata-pelajaran/${id}`), {
        method: "DELETE",
        headers: {},
    })
        .then((response) => {
            if (response.ok) {
                // Tampilkan pesan sukses
                getDataMataPelajaran(); // Memperbarui tabel setelah berhasil menambahkan mata pelajaran
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
function updateMapel() {
    const id = document.getElementById("id_2").value;
    const namaMapel = document.getElementById("namaMapel2").value;
    const jurusan = document.getElementById("jurusan2").value;
    const guruSelect = document.getElementById("guru2");
    const selectedGurus = Array.from(
        guruSelect.selectedOptions,
        (option) => option.value
    );

    const mapelData = {
        nama_mapel: namaMapel,
        id_jurusan: jurusan,
        id_guru: selectedGurus,
    };

    fetch(getApiUrl(`mata-pelajaran/${id}`), {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(mapelData),
    })
        .then((response) => {
            if (response.ok) {
                // Handle success response
                showAlert("Data berhasil diperbarui", "success");
                console.log("Data berhasil diperbarui");
                getDataMataPelajaran();
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

let mataPelajaranData = [];

function getDataMataPelajaran() {
    fetch(getApiUrl("mata-pelajaran"))
        .then((response) => response.json())
        .then((data) => {
            mataPelajaranData = data;
            renderMataPelajaranTable(data);
            const updatedRowIndices = getUpdatedRowIndices(); // Implementasikan fungsi ini untuk mendapatkan baris yang berubah
            highlightUpdatedRows(updatedRowIndices);
        })
        .catch((error) => {
            console.error("Terjadi kesalahan:", error);
        });
}

function renderMataPelajaranTable(data) {
    const mataPelajaranBody = document.getElementById("mataPelajaranTableBody");

    // Menghapus semua baris yang ada di dalam tbody
    mataPelajaranBody.innerHTML = "";

    // Mengisi tabel dengan data mata pelajaran
    if (data && data.length > 0) {
        data.forEach((mataPelajaran, index) => {
            const row = document.createElement("tr");
            row.classList.add(`hover:bg-gray-100`, `bg-white`);

            // Kolom No
            const noCell = document.createElement("td");
            noCell.classList.add("tableCellid");
            noCell.textContent = index + 1;
            row.appendChild(noCell);

            // const idCell = document.createElement("td");
            // idCell.classList.add("tableCellid");
            // idCell.textContent = mataPelajaran.kode_mapel;
            // row.appendChild(idCell);

            // Kolom Nama Mata Pelajaran
            const namaMapelCell = document.createElement("td");
            namaMapelCell.classList.add("tableCellMapel");
            namaMapelCell.textContent = mataPelajaran.nama_mapel;
            row.appendChild(namaMapelCell);

            // Kolom Jurusan
            const jurusanCell = document.createElement("td");
            jurusanCell.classList.add("tableCellMapel");
            jurusanCell.textContent = mataPelajaran.jurusan.nama_jurusan; // Menggunakan atribut nama_jurusan dari objek jurusan
            row.appendChild(jurusanCell);

            // Kolom Kelas
            // const kelasCell = document.createElement("td");
            // kelasCell.classList.add("tableCellMapel");
            // kelasCell.textContent = mataPelajaran.kelas.nama_kelas; // Menggunakan atribut nama_kelas dari objek kelas
            // row.appendChild(kelasCell);

            // Kolom Pengajar
            const pengajarCell = document.createElement("td");
            pengajarCell.classList.add("tableCellMapel");

            mataPelajaran.guru.forEach((guru) => {
                const badge = document.createElement("span");
                badge.classList.add(`bg-green-100`);
                badge.classList.add(`text-green-800`);
                badge.classList.add(`text-sm`);
                badge.classList.add(`font-medium`);
                badge.classList.add(`mr-2`);
                badge.classList.add(`px-2.5`);
                badge.classList.add(`py-0.5`);
                badge.classList.add(`rounded`);

                badge.textContent = guru.nama; // Menggunakan atribut nama dari objek guru
                pengajarCell.appendChild(badge);
            });

            row.appendChild(pengajarCell);
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
                deleteMapel(mataPelajaran.kode_mapel);
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
                fillFormWithMataPelajaranData(mataPelajaran.kode_mapel);
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
            mataPelajaranBody.appendChild(row);
        });
    } else {
        // Tidak ada data yang diterima
        const row = document.createElement("tr");
        const emptyCell = document.createElement("td");
        emptyCell.setAttribute("colspan", "6");
        emptyCell.textContent = "Tidak ada data mata pelajaran";
        row.appendChild(emptyCell);
        mataPelajaranBody.appendChild(row);
    }
}

function fillFormWithMataPelajaranData(kodeMapel) {
    const mataPelajaran = mataPelajaranData.find(
        (item) => item.kode_mapel === kodeMapel
    );

    if (mataPelajaran) {
        document.getElementById("namaMapel2").value = mataPelajaran.nama_mapel;
        document.getElementById("jurusan2").value =
            mataPelajaran.jurusan.id_jurusan;
        document.getElementById("id_2").value = mataPelajaran.kode_mapel;
        document.getElementById("guru2").value = mataPelajaran.guru.map(
            (guru) => guru.id_guru
        );

        // Memperbarui tampilan dropdown Select2
        const jurusanSelect = $("#jurusan2");
        jurusanSelect.val(mataPelajaran.jurusan.id_jurusan).trigger("change");

        const guruSelect = $("#guru2");
        guruSelect
            .val(mataPelajaran.guru.map((guru) => guru.id_guru))
            .trigger("change");
    }
}

function populateJurusanDropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("jurusan"))
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
            option.text = "Pilih Guru";
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

function populateJurusan2Dropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch(getApiUrl("jurusan"))
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("jurusan2");
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
            option.text = "Pilih Guru";
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
// Memanggil fungsi untuk mendapatkan dan menampilkan data mata pelajaran saat halaman dimuat
getDataMataPelajaran();
populateJurusanDropdown();
populateGuruDropdown();

populateJurusan2Dropdown();
populateGuru2Dropdown();

const form = document.getElementById("updateMataPelajaranForm");
form.addEventListener("submit", function (event) {
    event.preventDefault();
    updateMapel();
});

document
    .getElementById("addMataPelajaranForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        addMataPelajaran();
    });

$(document).ready(function () {
    $("#jurusan").select2();
});

$(document).ready(function () {
    $("#guru").select2();
});

$(document).ready(function () {
    $("#jurusan2").select2();
});

$(document).ready(function () {
    $("#guru2").select2();
});
