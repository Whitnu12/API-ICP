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

function getApiUrl(endpoint) {
    const apiUrl = "https://managementservice-smkn1kobi.my.id/api/";
    return apiUrl + endpoint;
}

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
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", () => {
            deleteMapel(mataPelajaran.kode_mapel);
        });
        deleteCell.appendChild(deleteButton);
        row.appendChild(deleteCell);

        // Kolom Action - Tombol Update
        const updateCell = document.createElement("td");
        updateCell.classList.add("tableCellAction");
        const updateButton = document.createElement("button");
        updateButton.textContent = "Update";
        updateButton.addEventListener("click", () => {
            // Mengisi nilai form dengan data mata pelajaran yang akan diperbarui
            fillFormWithMataPelajaranData(mataPelajaran.kode_mapel);
        });
        updateCell.appendChild(updateButton);
        row.appendChild(updateCell);

        table.appendChild(row);
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

getDataKelas();
populateJurusanDropdown();

document
    .getElementById("tambahKelas")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        addKelas();
    });

$(document).ready(function () {
    $("#jurusan").select2();
});

$(document).ready(function () {
    $("#tahunDropdown").select2();
});
