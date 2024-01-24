import { getApiUrl } from "./api.js";

function renderMataPelajaranTable(data) {
    const mataPelajaranBody = document.getElementById("mataPelajaranTableBody");

    // Menghapus semua baris yang ada di dalam tbody
    mataPelajaranBody.innerHTML = "";

    // Mengisi tabel dengan data mata pelajaran
    if (data && data.length > 0) {
        data.forEach((mataPelajaran, index) => {
            const row = document.createElement("tr");
            row.classList.add(
                `hover:bg-gray-100`,
                `bg-white`,
                `tableRow`,
                `cursor-pointer`
            );

            // Tambahkan atribut data-id pada setiap baris
            row.setAttribute("data-id", mataPelajaran.id_mapel);

            // Kolom No
            const noCell = document.createElement("td");
            noCell.classList.add("tableCellid");
            noCell.textContent = index + 1;
            row.appendChild(noCell);

            // Kolom Nama Mata Pelajaran
            const namaMapelCell = document.createElement("td");
            namaMapelCell.classList.add("tableCellMapel");
            namaMapelCell.textContent = mataPelajaran.nama_mapel;
            row.appendChild(namaMapelCell);

            // Kolom Pengajar
            const pengajarCell = document.createElement("td");
            pengajarCell.classList.add("tableCellMapel");
            pengajarCell.textContent = mataPelajaran.created_by;
            row.appendChild(pengajarCell);

            // Kolom Jumlah Siswa (Perlu diperbarui sesuai API jika data siswa diperlukan)
            const siswaCell = document.createElement("td");
            siswaCell.classList.add("tableCellMapel");
            siswaCell.textContent = "40"; // Update ini sesuai API jika diperlukan
            row.appendChild(siswaCell);

            // Menambahkan event listener untuk pemilihan baris mata pelajaran
            row.addEventListener("click", () => {
                // Mengarahkan pengguna ke halaman detail dengan ID mata pelajaran
                window.location.href = `/mata-pelajaran/${mataPelajaran.id_mapel}`;
            });

            // Menambahkan baris ke dalam tbody
            mataPelajaranBody.appendChild(row);
        });
    } else {
        // Tidak ada data yang diterima
        const row = document.createElement("tr");
        const emptyCell = document.createElement("td");
        emptyCell.setAttribute("colspan", "4");
        emptyCell.textContent = "Tidak ada data mata pelajaran";
        row.appendChild(emptyCell);
        mataPelajaranBody.appendChild(row);
    }
}

// Memanggil fungsi untuk mendapatkan dan menampilkan data mata pelajaran saat halaman dimuat
getDataMataPelajaran();

// Fungsi untuk mendapatkan data mata pelajaran dari API
async function getDataMataPelajaran() {
    try {
        const response = await fetch(getApiUrl("mata-pelajaran")); // Menunggu resolusi Promise fetch
        const result = await response.json();

        if (result.status === "success") {
            const data = result.data;
            renderMataPelajaranTable(data);
        } else {
            console.error("Gagal mendapatkan data mata pelajaran");
        }
    } catch (error) {
        console.error("Terjadi kesalahan:", error);
    }
}
