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

// Event listener untuk menghandle submit form penambahan mata pelajaran
function addMataPelajaran() {
    const namaMapel = document.getElementById("namaMapel").value;
    const jurusan = document.getElementById("jurusan").value;
    const kelas = document.getElementById("kelas").value;
    const guru = document.getElementById("guru").value;

    const mapelData = {
        nama_mapel: namaMapel,
        id_jurusan: jurusan,
        id_kelas: kelas,
        id_guru: guru,
    };

    fetch("http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran/add", {
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
    fetch(`http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran/${id}`, {
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
    const namaMapel = document.getElementById("namaMapel_2").value;
    const jurusan = document.getElementById("jurusan_2").value;
    const kelas = document.getElementById("kelas_2").value;
    const guru = document.getElementById("guru_2").value;

    // Prepare the request data
    const data = new URLSearchParams();
    // data.append("nama_mapel", namaMapel);
    // data.append("id_jurusan", jurusan);
    // data.append("id_kelas", kelas);
    // data.append("id_guru", guru);

    if (namaMapel !== "") {
        data.append("nama_mapel", namaMapel);
    }
    if (jurusan !== "") {
        data.append("id_jurusan", jurusan);
    }
    if (kelas !== "") {
        data.append("id_kelas", kelas);
    }
    if (guru !== "") {
        data.append("id_guru", guru);
    }

    // Send the request to the API
    fetch(`http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran/${id}`, {
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
                getDataMataPelajaran();
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

// Fungsi untuk mendapatkan data mata pelajaran dari API dan mengisi tabel
function getDataMataPelajaran() {
    fetch("http://192.168.100.6/laravel-icp2/public/api/mata-pelajaran")
        .then((response) => response.json())
        .then((data) => {
            // Menghapus semua baris yang ada di dalam tbody
            mataPelajaranBody.innerHTML = "";

            // Mengisi tabel dengan data mata pelajaran
            data.forEach((mataPelajaran, index) => {
                // Membuat elemen-elemen untuk setiap kolom data
                const row = document.createElement("tr");
                row.classList.add("tableRow");

                // Kolom No
                const noCell = document.createElement("td");
                noCell.classList.add("tableCellid");
                noCell.textContent = index + 1;
                row.appendChild(noCell);

                const idCell = document.createElement("td");
                idCell.classList.add("tableCellid");
                idCell.textContent = mataPelajaran.kode_mapel;
                row.appendChild(idCell);

                // Kolom Nama Mata Pelajaran
                const namaMapelCell = document.createElement("td");
                namaMapelCell.classList.add("tableCellMapel");
                namaMapelCell.textContent = mataPelajaran.nama_mapel;
                row.appendChild(namaMapelCell);

                // Kolom Jurusan
                const jurusanCell = document.createElement("td");
                jurusanCell.classList.add("tableCellJurusan");
                jurusanCell.textContent = mataPelajaran.jurusan.nama_jurusan; // Menggunakan atribut nama_jurusan dari objek jurusan
                row.appendChild(jurusanCell);

                // Kolom Kelas
                const kelasCell = document.createElement("td");
                kelasCell.classList.add("tableCellKelas");
                kelasCell.textContent = mataPelajaran.kelas.nama_kelas; // Menggunakan atribut nama_kelas dari objek kelas
                row.appendChild(kelasCell);

                // Kolom Pengajar
                const pengajarCell = document.createElement("td");
                pengajarCell.classList.add("tableCellKelas");
                pengajarCell.textContent = mataPelajaran.guru.nama; // Menggunakan atribut nama dari objek guru
                row.appendChild(pengajarCell);

                // Kolom Action - Tombol Delete
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
                    document.getElementById("namaMapel_2").value =
                        mataPelajaran.nama_mapel;
                    document.getElementById("jurusan_2").value =
                        mataPelajaran.jurusan.id_jurusan; // Menggunakan atribut id_jurusan dari objek jurusan
                    document.getElementById("kelas_2").value =
                        mataPelajaran.kelas.id_kelas; // Menggunakan atribut id_kelas dari objek kelas
                    document.getElementById("id_2").value =
                        mataPelajaran.kode_mapel;
                    document.getElementById("guru_2").value =
                        mataPelajaran.id_guru;
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

            // Menampilkan tabel jika terdapat data mata pelajaran
            mataPelajaranTable.style.display =
                data.length > 0 ? "table" : "none";
        })
        .catch((error) => console.error("Error:", error));
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

function populateKelasDropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch("http://192.168.100.6/laravel-icp2/public/api/kelas")
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("kelas");

            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih kelas"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih kelas";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.data.forEach((kelas) => {
                const option = document.createElement("option");
                option.value = kelas.id_kelas;
                option.text = kelas.nama_kelas;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}

function populateGuruDropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch("http://192.168.100.6/laravel-icp2/public/api/guru")
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
    fetch("http://192.168.100.6/laravel-icp2/public/api/jurusan")
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("jurusan_2");
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

function populateKelas2Dropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch("http://192.168.100.6/laravel-icp2/public/api/kelas")
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("kelas_2");

            // Menghapus opsi sebelumnya
            dropdown.innerHTML = "";

            // Menambahkan opsi "Pilih kelas"
            const option = document.createElement("option");
            option.value = "null";
            option.text = "Pilih kelas";
            dropdown.appendChild(option);

            // Menambahkan opsi dari data API
            data.data.forEach((kelas) => {
                const option = document.createElement("option");
                option.value = kelas.id_kelas;
                option.text = kelas.nama_kelas;
                dropdown.appendChild(option);
            });
        })
        .catch((error) => {
            console.log("Terjadi kesalahan:", error);
        });
}

function populateGuru2Dropdown() {
    // Ganti URL_API dengan URL API yang sesuai
    fetch("http://192.168.100.6/laravel-icp2/public/api/guru")
        .then((response) => response.json())
        .then((data) => {
            const dropdown = document.getElementById("guru_2");

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
populateKelasDropdown();
populateJurusanDropdown();
populateGuruDropdown();

populateKelas2Dropdown();
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
