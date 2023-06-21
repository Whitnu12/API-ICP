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

function getApiUrl(endpoint) {
    const apiUrl = "https://managementservice-smkn1kobi.my.id/api/";
    return apiUrl + endpoint;
}

function getDataGuru() {
    fetch(getApiUrl("guru"))
        .then((response) => response.json())
        .then((data) => {
            if (data && data.status === "success" && Array.isArray(data.data)) {
                const guruData = data.data;

                // Menghapus semua baris yang ada di dalam tbody
                guruBody.innerHTML = "";

                // Mengisi tabel dengan data guru
                guruData.forEach((guru, index) => {
                    const row = document.createElement("tr");

                    // Kolom No
                    const noCell = document.createElement("td");
                    noCell.classList.add("tableCellid");
                    noCell.textContent = index + 1;
                    row.appendChild(noCell);

                    // Kolom ID
                    const idCell = document.createElement("td");
                    idCell.classList.add("tableCellid");
                    idCell.textContent = guru.user_id;
                    row.appendChild(idCell);

                    // Kolom NPP
                    const nppCell = document.createElement("td");
                    nppCell.classList.add("tableCellMapel");
                    nppCell.textContent = guru.npp;
                    row.appendChild(nppCell);

                    // Kolom Nama
                    const namaCell = document.createElement("td");
                    namaCell.classList.add("tableCellMapel");
                    namaCell.textContent = guru.nama;
                    row.appendChild(namaCell);

                    // Kolom Email
                    const emailCell = document.createElement("td");
                    emailCell.classList.add("tableCellMapel");
                    emailCell.textContent = guru.email;
                    row.appendChild(emailCell);

                    // Kolom Jabatan
                    const jabatanCell = document.createElement("td");
                    jabatanCell.classList.add("tableCellMapel");
                    jabatanCell.textContent = guru.jabatan;
                    row.appendChild(jabatanCell);

                    // Kolom Action - Tombol Delete
                    const deleteCell = document.createElement("td");
                    deleteCell.classList.add("tableCellAction");
                    const deleteButton = document.createElement("button");
                    deleteButton.textContent = "Delete";
                    deleteButton.addEventListener("click", () => {
                        hapusGuru(guru.user_id);
                    });
                    deleteCell.appendChild(deleteButton);
                    row.appendChild(deleteCell);

                    // Kolom Action - Tombol Update
                    const updateCell = document.createElement("td");
                    updateCell.classList.add("tableCellAction");
                    const updateButton = document.createElement("button");
                    updateButton.textContent = "Update";
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

                guruTable.style.display =
                    guruData.length > 0 ? "table" : "none";
            } else {
                console.error("Invalid response data:", data);
            }
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
            } else {
                console.error("Error:", data);
            }
        })
        .catch((error) => console.error("Error:", error));
}

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
                return response.json();
            } else {
                // Handle error response
                throw new Error("Error: " + response.status);
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
