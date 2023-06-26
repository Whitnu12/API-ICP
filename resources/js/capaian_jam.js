import { getApiUrl } from "./api.js";
import { showAlert } from "./toast.js";

let capaianData = [];

function getDataCapaian() {
    fetch(getApiUrl("capaian-jam"))
        .then((response) => response.json())
        .then((data) => {
            capaianData = data;
            renderCapaian(data);
        })
        .catch((error) => {
            console.error("Terjadi kesalahan:", error);
        });
}
const pollingInterval = 5000; //
function getDataLongPolling() {
    fetch(getApiUrl("capaian-jam"))
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error(
                    "Terjadi kesalahan saat melakukan long polling."
                );
            }
        })
        .then((data) => {
            renderCapaian(data);

            // Memulai kembali long polling setelah jeda waktu
            setTimeout(getDataLongPolling, pollingInterval);
        })
        .catch((error) => {
            console.error("Terjadi kesalahan:", error);

            // Memulai kembali long polling setelah jeda waktu
            setTimeout(getDataLongPolling, pollingInterval);
        });
}

// Memulai long polling saat halaman dimuat
getDataLongPolling();

getDataCapaian();

function renderCapaian(data) {
    const capaianBody = document.getElementById("capaianBody");

    // Menghapus semua baris yang ada di dalam tbody
    capaianBody.innerHTML = "";

    // Mengisi tabel dengan data capaian jam belajar
    if (data && data.data.length > 0) {
        data.data.forEach((capaian, index) => {
            const row = document.createElement("tr");
            row.classList.add(`hover:bg-gray-100`, `bg-white`);

            const noCell = document.createElement("td");
            noCell.classList.add("tableCellid");
            noCell.textContent = index + 1;
            row.appendChild(noCell);

            // Kolom ID Capaian
            // const idCapaianCell = document.createElement("td");
            // idCapaianCell.textContent = capaian.id_capaian;
            // row.appendChild(idCapaianCell);

            // Kolom ID Guru
            const idGuruCell = document.createElement("td");
            idGuruCell.classList.add("tableCellid");
            idGuruCell.textContent = capaian.nama_guru;
            row.appendChild(idGuruCell);

            // Kolom Kode Mapel
            const kodeMapelCell = document.createElement("td");
            kodeMapelCell.classList.add("tableCellMapel");
            kodeMapelCell.textContent = capaian.nama_mapel;
            row.appendChild(kodeMapelCell);

            // Kolom Capaian Jam
            const jamTercapaiCell = document.createElement("td");
            jamTercapaiCell.classList.add("tableCellMapel");

            const progressBarContainer = document.createElement("div");
            progressBarContainer.classList.add("w-56");

            const progressBarWrapper = document.createElement("div");
            progressBarWrapper.classList.add(
                "w-full",
                "bg-gray-200",
                "rounded-full"
            );

            const progressBar = document.createElement("div");
            progressBar.classList.add(
                "bg-green-600",
                "text-xs",
                "font-medium",
                "text-white",
                "text-center",
                "p-0.5",
                "leading-none",
                "rounded-full"
            );
            progressBar.style.width =
                (capaian.jam_tercapai / capaian.capaian_jam) * 100 + "%";
            progressBar.textContent =
                capaian.jam_tercapai + "/" + capaian.capaian_jam;

            progressBarWrapper.appendChild(progressBar);
            progressBarContainer.appendChild(progressBarWrapper);
            jamTercapaiCell.appendChild(progressBarContainer);

            row.appendChild(jamTercapaiCell);

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

            // Menambahkan baris ke dalam tbody
            capaianBody.appendChild(row);
        });
    } else {
        // Tidak ada data yang diterima
        const row = document.createElement("tr");
        const emptyCell = document.createElement("td");
        emptyCell.setAttribute("colspan", "7");
        emptyCell.textContent = "Tidak ada data capaian jam belajar";
        row.appendChild(emptyCell);
        capaianBody.appendChild(row);
    }
}
