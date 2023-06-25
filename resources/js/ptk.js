import { getApiUrl } from "./api.js";
import { showAlert } from "./toast.js";

function getDataGuru() {
    fetch(getApiUrl("guru"))
        .then((response) => response.json())
        .then((data) => {
            if (
                data &&
                data.status === "success" &&
                Array.isArray(data.data) &&
                data.data.length > 0
            ) {
                const guruData = data.data;

                // Menghapus semua baris yang ada di dalam tbody
                guruBody.innerHTML = "";

                // Mengisi tabel dengan data guru
                guruData.forEach((guru, index) => {
                    const row = document.createElement("tr");
                    row.classList.add(`hover:bg-gray-100`, `bg-white`);

                    // Kolom No
                    const noCell = document.createElement("td");
                    noCell.classList.add(`tableCellMapel`);
                    noCell.textContent = index + 1;
                    row.appendChild(noCell);

                    // Kolom ID
                    // const idCell = document.createElement("td");
                    // idCell.classList.add(`tableCellMapel`,);
                    // idCell.textContent = guru.user_id;
                    // row.appendChild(idCell);

                    // Kolom NPP
                    const nppCell = document.createElement("td");
                    nppCell.classList.add(`tableCellMapel`);
                    nppCell.textContent = guru.npp;
                    row.appendChild(nppCell);

                    // Kolom Nama
                    const namaCell = document.createElement("td");
                    namaCell.classList.add(`tableCellMapel`);
                    namaCell.textContent = guru.nama;
                    row.appendChild(namaCell);

                    // Kolom Email
                    const emailCell = document.createElement("td");
                    emailCell.classList.add(`tableCellMapel`);
                    emailCell.textContent = guru.email;
                    row.appendChild(emailCell);

                    // Kolom Jabatan
                    const jabatanCell = document.createElement("td");
                    jabatanCell.classList.add(`tableCellMapel`);
                    jabatanCell.textContent = guru.jabatan;
                    row.appendChild(jabatanCell);

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
                        hapusGuru(guru.user_id);
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
                        // Mengisi nilai form dengan data guru yang akan diperbarui
                        document.getElementById("npp_2").value = guru.npp;
                        document.getElementById("nama_2").value = guru.nama;
                        document.getElementById("email_2").value = guru.email;
                        document.getElementById("jabatan_2").value =
                            guru.jabatan;
                        document.getElementById("id_2").value = guru.user_id;
                    });
                    updateCell.appendChild(updateButton);
                    row.appendChild(updateCell);

                    // Menambahkan baris ke dalam tbody
                    guruBody.appendChild(row);
                });
            } else {
                guruBody.innerHTML =
                    '<tr><td colspan="6">Tidak ada data guru</td></tr>';
                guruTable.style.display = "table";
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

// Memanggil fungsi untuk mendapatkan dan menampilkan data guru saat halaman dimuat
getDataGuru();

function tambahGuru() {
    const nama = document.getElementById("nama").value;
    const npp = document.getElementById("NPP").value;
    const email = document.getElementById("email").value;
    const jabatan = document.getElementById("jabatan").value;
    const password = document.getElementById("password").value;

    const guruData = {
        nama: nama,
        npp: npp,
        email: email,
        jabatan: jabatan,
        password: password,
    };

    fetch(getApiUrl("guru/register"), {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(guruData),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data && data.status === "success") {
                showAlert("Berhasil menambah guru");

                document.getElementById("nama").value = "";
                document.getElementById("NPP").value = "";
                document.getElementById("email").value = "";
                document.getElementById("jabatan").value = "";
                document.getElementById("password").value = "";

                getDataGuru();
            } else if (data && data.status === "error") {
                const errors = data.message;

                // Menampilkan pesan kesalahan berdasarkan field
                Object.keys(errors).forEach((field) => {
                    const errorMessages = errors[field];

                    // Menampilkan pesan kesalahan menggunakan showAlert
                    errorMessages.forEach((errorMessage) => {
                        showAlert(errorMessage);
                    });
                });
            } else {
                console.error("Error:", data);
            }
        })
        .catch((error) => console.error("Error:", error));
}

// Event listener for form submission

document
    .getElementById("tambahGuru")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        tambahGuru();
    });

function hapusGuru(id) {
    fetch(getApiUrl(`guru/${id}`), {
        method: "DELETE",
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "success") {
                showAlert("guru berhasil dihapus");
                getDataGuru();
                // Lakukan tindakan lain setelah penghapusan guru berhasil
            } else {
                showAlert("gagal menghapus guru");
                // Lakukan tindakan lain jika terjadi kesalahan saat menghapus guru
            }
        })
        .catch((error) => console.error("Error:", error));
}

// Function to handle form submission
function rubahGuru() {
    const id = document.getElementById("id_2").value;
    const password = document.getElementById("password_2").value;
    const nama = document.getElementById("nama_2").value;
    const npp = document.getElementById("npp_2").value;
    const email = document.getElementById("email_2").value;
    const jabatan = document.getElementById("jabatan_2").value;

    // Prepare the request data
    const data = new URLSearchParams();
    data.append("id", id);
    data.append("password_lama", password);

    // Add fields to data if they have changed
    if (nama !== "") {
        data.append("nama", nama);
    }
    if (npp !== "") {
        data.append("npp", npp);
    }
    if (email !== "") {
        data.append("email", email);
    }
    if (jabatan !== "") {
        data.append("jabatan", jabatan);
    }

    // Send the request to the API
    fetch(getApiUrl(`guru/${id}`), {
        method: "PUT",
        body: data,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    })
        .then((response) => {
            if (response.ok) {
                // Handle success response
                getDataGuru();
                showAlert("Data berhasil dirubah");
                return response.json();
            } else {
                response.json().then((error) => {
                    showAlert("Data gagal dirubah: " + error.message);
                });
                // Handle error response
                console.error("gagal merubah data: " + error.message);
            }
        })
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.error(error);
        });
}

// Event listener for form submission
const form = document.getElementById("rubahGuru");
form.addEventListener("submit", function (event) {
    event.preventDefault();
    rubahGuru();
});
