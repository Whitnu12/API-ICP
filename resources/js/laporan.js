import { getApiUrl } from "./api.js";
import { showAlert } from "./toast.js";

function getLaporan() {
    fetch(getApiUrl("laporan"))
        .then((response) => response.json())
        .then((data) => {
            handleResponse(data);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function handleResponse(data) {
    // Dapatkan elemen laporanBody
    const laporanBody = document.getElementById("laporanBody");
    laporanBody.innerHTML = "";

    // Pastikan data adalah array
    if (Array.isArray(data.data)) {
        const laporanArray = data.data;

        // Loop melalui setiap laporan dalam data
        laporanArray.forEach((laporan, index) => {
            // Buat elemen <tr> untuk setiap laporan
            const row = document.createElement("tr");
            row.classList.add(`hover:bg-gray-100`, `bg-white`);

            const noCell = document.createElement("td");
            noCell.classList.add(`tableCellid`);
            noCell.textContent = index + 1;
            row.appendChild(noCell);

            const tanggalCell = document.createElement("td");
            tanggalCell.classList.add("tableCellMapel");
            tanggalCell.textContent = laporan.tanggal;
            row.appendChild(tanggalCell);

            const pengirimCell = document.createElement("td");
            pengirimCell.classList.add("tableCellMapel");
            pengirimCell.textContent = laporan.id_guru;
            row.appendChild(pengirimCell);

            // Buat elemen <td> untuk judul laporan
            const judulCell = document.createElement("td");
            judulCell.classList.add("tableCellMapel");
            judulCell.textContent = laporan.judul_laporan;
            row.appendChild(judulCell);

            // Buat elemen <td> untuk deskripsi laporan
            // const deskripsiCell = document.createElement("td");
            // deskripsiCell.textContent = laporan.deskripsi_laporan;
            // row.appendChild(deskripsiCell);

            // Buat elemen <td> untuk tanggal

            // Buat elemen <td> untuk jenis laporan
            const jenisLaporanCell = document.createElement("td");
            jenisLaporanCell.classList.add("tableCellMapel");
            jenisLaporanCell.textContent = laporan.id_jenis;
            row.appendChild(jenisLaporanCell);

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
                deleteLaporan(laporan.id_laporan);
            });
            deleteCell.appendChild(deleteButton);
            row.appendChild(deleteCell);

            // Buat elemen <td> untuk pengirim

            row.addEventListener("click", () => {
                // Tampilkan data laporan terkait dalam HTML
                const namaKegiatan = document.querySelector("#nama-kegiatan");
                const tanggalKegiatan =
                    document.querySelector("#tanggal-kegiatan");
                const namaPengirim = document.querySelector("#nama-pengirim");
                const jenisLaporan = document.querySelector("#jenis-laporan");
                const deskripsiLaporan =
                    document.querySelector("#deskripsi-laporan");

                namaKegiatan.textContent = laporan.judul_laporan;
                tanggalKegiatan.textContent = laporan.tanggal;
                namaPengirim.textContent = laporan.id_guru;
                jenisLaporan.textContent = laporan.id_jenis;
                deskripsiLaporan.textContent = laporan.deskripsi_laporan;

                const idLaporan = laporan.id_laporan;
                ambilGambar(idLaporan);
            });

            // Tambahkan baris ke laporanBody
            laporanBody.appendChild(row);
        });
    } else {
        console.error("Data is not an array:", data);
    }
}

function ambilGambar(idLaporan) {
    fetch(getApiUrl(`laporan/${idLaporan}`))
        .then((response) => response.json())
        .then((data) => {
            const gambarData = data.data.gambar;
            const gambarURLs = gambarData.map((gambar) => gambar);

            updateCarousel(gambarURLs);
        })
        .catch((error) => {
            console.log(error);
        });
}

function updateCarousel(gambarURLs) {
    const carouselContainer = document.querySelector("#gallery");
    carouselContainer.innerHTML = ""; // Menghapus konten sebelumnya

    // Memastikan gambarURLs adalah array sebelum menggunakannya
    if (Array.isArray(gambarURLs)) {
        gambarURLs.forEach((gambarURL, index) => {
            const carouselItem = document.createElement("div");
            carouselItem.classList.add("duration-700");
            carouselItem.classList.add("ease-in-out");
            carouselItem.setAttribute(
                "data-carousel-item",
                index === 0 ? "active" : ""
            );

            const anchorElement = document.createElement("a");
            anchorElement.classList.add("gambar-modal");
            anchorElement.href = gambarURL;

            const imgElement = document.createElement("img");
            imgElement.src = gambarURL;
            imgElement.alt = "Gambar Laporan";
            imgElement.classList.add("w-80");
            imgElement.classList.add("h-80");
            imgElement.classList.add("object-cover");
            imgElement.classList.add("rounded-lg");
            imgElement.setAttribute("data-mfp-src", gambarURL);

            anchorElement.appendChild(imgElement);
            carouselItem.appendChild(anchorElement);
            carouselContainer.appendChild(carouselItem);
        });

        // Menambahkan event listener pada semua elemen dengan kelas "gambar-modal"
        const gambarModals = document.querySelectorAll(".gambar-modal");

        gambarModals.forEach(function (gambarModal) {
            gambarModal.addEventListener("click", function (e) {
                e.preventDefault();
                const gambarURL = gambarModal.getAttribute("href");
            });
        });
    } else {
        console.error("Invalid gambarURLs format. Expected an array.");
    }
}

getLaporan();

function openModal(imageSrc) {
    const modal = document.getElementById("modal");
    const modalImage = document.getElementById("modal-image");

    modalImage.src = imageSrc;
    modal.classList.add("block");
    modal.classList.remove("hidden");
}

function closeModal() {
    const modal = document.getElementById("modal");
    modal.classList.add("hidden");
}

document.getElementById("gallery").addEventListener("click", function (event) {
    if (event.target.tagName === "IMG") {
        const imageSrc = event.target.src;
        openModal(imageSrc);
    }
});

document.getElementById("close").addEventListener("click", closeModal);

function deleteLaporan(id) {
    fetch(getApiUrl(`laporan/${id}`), {
        method: "DELETE",
        headers: {},
    })
        .then((response) => {
            if (response.ok) {
                // Tampilkan pesan sukses
                getLaporan(); // Memperbarui tabel setelah berhasil menambahkan mata pelajaran
                showAlert("laporan berhasil dihapus");
                console.log("Laporan berhasil dihapus");
            } else {
                // Tampilkan pesan error
                showAlert("Gagal menghapus laporan");
                console.error("Gagal menghapus laporan");
            }
        })
        .catch((error) => {
            // Tampilkan pesan error
            showAlert("Terjadi kesalahan");
            console.error("Terjadi kesalahan:", error);
        });
}
