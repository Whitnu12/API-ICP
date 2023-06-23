import { getApiUrl } from "./api.js";

function showAlert(message) {
    const alertElement = document.getElementById("toast-alert");
    const messageElement = document.getElementById("pesan");
    messageElement.textContent = message;

    alertElement.classList.remove("invisible");
    alertElement.classList.add("visible");

    setTimeout(() => {
        alertElement.classList.remove("visible");
        alertElement.classList.add("invisible");
    }, 3000);
}

var dropdown = document.getElementById("tahunDropdown");
var dropdown2 = document.getElementById("tahunDropdown2");
var tahunList = [2020, 2021, 2022, 2023];

function populateDropdown() {
    dropdown.innerHTML = "";

    for (var i = 0; i < tahunList.length; i++) {
        var option = document.createElement("option");
        option.text = tahunList[i];
        dropdown.add(option);
    }
}

function populateDropdown2() {
    dropdown2.innerHTML = "";

    // Menambahkan opsi tahun ke dropdown
    for (var i = 0; i < tahunList.length; i++) {
        var option = document.createElement("option");
        option.text = tahunList[i];
        dropdown2.add(option);
    }
}

function tambahTahun() {
    var tahunTerbaru = tahunList[tahunList.length - 1] + 1;
    tahunList.push(tahunTerbaru);

    if (tahunList.length > 5) {
        tahunList.shift();
    }
    populateDropdown();
    populateDropdown2();
}

// Memanggil fungsi populateDropdown() saat halaman dimuat
populateDropdown();
populateDropdown2();

function addKelas() {
    const namaKelas = document.getElementById("nama_kelas").value;
    const jurusan = document.getElementById("jurusan").value;
    const jumlah_murid = document.getElementById("jumlah_murid").value;
    const angkatan = document.getElementById("tahunDropdown").value;

    const kelasData = {
        nama_kelas: namaKelas,
        id_jurusan: jurusan,
        jumlahMurid: jumlah_murid,
        angkatan: angkatan,
    };

    fetch(getApiUrl("kelas"), {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(kelasData),
    })
        .then((response) => {
            if (response.ok) {
                // Tampilkan pesan sukses
                showAlert("kelas berhasil ditambahkan", "success");
                console.log("kelas berhasil ditambahkan");
                getDataKelas();
            } else {
                // Tangkap pesan error dari respons JSON jika ada
                response.json().then((error) => {
                    showAlert(
                        "Gagal menambahkan kelas: " + error.message,
                        "error"
                    );
                    console.error("Gagal menambahkan kelas:", error.message);
                });
            }
        })
        .catch((error) => {
            // Tampilkan pesan error
            showAlert("Terjadi kesalahan: " + error.message, "error");
            console.error("Terjadi kesalahan:", error);
        });
}

function fetchJurusanData(idJurusan, callback) {
    fetch(getApiUrl(`jurusan/${idJurusan}`))
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
    fetch(getApiUrl(`kelas`))
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

    if (kelasData.length === 0) {
        const row = document.createElement("tr");
        const notFoundCell = document.createElement("td");
        notFoundCell.setAttribute("colspan", "6");
        notFoundCell.textContent = "Tidak ada Data Kelas";
        row.appendChild(notFoundCell);
        table.appendChild(row);
        return;
    }

    kelasData.forEach((kelas, index) => {
        const row = document.createElement("tr");
        row.classList.add(`hover:bg-gray-100`, `bg-white`);

        //Nomor
        const noCell = document.createElement("td");
        noCell.classList.add("tableCellid");
        noCell.textContent = index + 1;
        row.appendChild(noCell);

        //ID
        // const no = document.createElement("td");
        // no.classList.add("tableCellid");
        // no.textContent = kelas.id_kelas;
        // row.appendChild(no);

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

        // Mendapatkan nama jurusan berdasarkan ID
        fetchJurusanData(idJurusan, (jurusan) => {
            idJurusanCell.textContent = jurusan
                ? jurusan.nama_jurusan
                : "Tidak ditemukan";
        });
        row.appendChild(idJurusanCell);

        //tahun
        const tahun = document.createElement("td");
        tahun.classList.add("tableCellMapel");
        tahun.textContent = kelas.angkatan;
        row.appendChild(tahun);

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
            deleteKelas(kelas.id_kelas);
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
            // Mengisi nilai form dengan data kelas yang akan diperbarui
            fillFormWithKelasData(kelas);
        });
        updateCell.appendChild(updateButton);
        row.appendChild(updateCell);

        table.appendChild(row);
    });
}

function deleteKelas(id) {
    fetch(getApiUrl(`kelas/${id}`), {
        method: "DELETE",
        headers: {},
    })
        .then((response) => {
            if (response.ok) {
                // Tampilkan pesan sukses
                getDataKelas(); // Memperbarui tabel setelah berhasil menambahkan mata pelajaran
                showAlert("kelas berhasil dihapus");
                console.log("kelas berhasil dihapus");
            } else {
                // Tampilkan pesan error
                showAlert("Gagal menghapus kelas");
                console.error("Gagal menghapus kelas");
            }
        })
        .catch((error) => {
            // Tampilkan pesan error
            showAlert("Terjadi kesalahan");
            console.error("Terjadi kesalahan:", error);
        });
}

function updateKelas() {
    const id = document.getElementById("id_kelas2").value;
    const namaKelas = document.getElementById("nama_kelas2").value;
    const jumlahMurid = document.getElementById("jumlah_murid2").value;
    const angkatan = document.getElementById("tahunDropdown2").value;
    const jurusan = document.getElementById("jurusan2").value;

    // Prepare the request data
    const data = new URLSearchParams();
    // data.append("nama_mapel", namaMapel);
    // data.append("id_jurusan", jurusan);
    // data.append("id_kelas", kelas);
    // data.append("id_guru", guru);

    if (namaKelas !== "") {
        data.append("nama_kelas", namaKelas);
    }
    if (jurusan !== "") {
        data.append("id_jurusan", jurusan);
    }
    if (jumlahMurid !== "") {
        data.append("jumlahMurid", jumlahMurid);
    }
    if (angkatan !== "") {
        data.append("angkatan", angkatan);
    }

    // Send the request to the API
    fetch(getApiUrl(`kelas/${id}`), {
        method: "PUT",
        body: data,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    })
        .then((response) => {
            if (response.ok) {
                // Handle success response
                showAlert("Data berhasil diperbarui");
                console.log("Data berhasil diperbarui");
                getDataKelas();
            } else {
                // Handle error response
                showAlert("Gagal memperbarui data");
                console.error("Gagal memperbarui data");
            }
        })
        .catch((error) => {
            // Handle error
            showAlert("Terjadi kesalahan");
            console.error("Terjadi kesalahan:", error);
        });
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

function populateJurusanDropdown2() {
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

getDataKelas();
populateJurusanDropdown();
populateJurusanDropdown2();

function fillFormWithKelasData(kelas) {
    document.getElementById("nama_kelas2").value = kelas.nama_kelas;
    document.getElementById("jumlah_murid2").value = kelas.jumlahMurid;
    document.getElementById("jurusan2").value = kelas.id_jurusan;
    document.getElementById("tahunDropdown2").value = kelas.angkatan;
    document.getElementById("id_kelas2").value = kelas.id_kelas;

    // Memperbarui tampilan dropdown Select2
    const jurusanSelect = $("#jurusan2");
    jurusanSelect.val(kelas.id_jurusan).trigger("change");

    const angkatanSelect = $("#tahunDropdown2");
    angkatanSelect.val(kelas.angkatan).trigger("change");
}

document
    .getElementById("tambahKelas")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        addKelas();
    });

document
    .getElementById("rubahKelas")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        updateKelas();
    });

$(document).ready(function () {
    $("#jurusan").select2();
});

$(document).ready(function () {
    $("#tahunDropdown").select2();
});

$(document).ready(function () {
    $("#jurusan2").select2();
});

$(document).ready(function () {
    $("#tahunDropdown2").select2();
});
