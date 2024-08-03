// Simulasikan data tugas dari database
const dataTugas = [
    { judul: "Pengembangan Sosial", deskripsi: "Tugas 1", nilai: 80 },
    { judul: "Pengembangan Sosial", deskripsi: "Tugas 2", nilai: 85 },
    {
        judul: "Pengembangan Sosial",
        deskripsi: "Tugas 3",
        nilai: 82,
    },
    { judul: "Pengembangan Sosial", deskripsi: "Tugas 4", nilai: 90 },
    { judul: "Pengembangan Sosial", deskripsi: "Tugas 5", nilai: 60 },
    { judul: "Pengembangan Sosial", deskripsi: "Tugas 6", nilai: 70 },
    // Tambahkan data tugas lainnya jika diperlukan
];

// Fungsi untuk menampilkan data tugas dalam model list
function renderTugas() {
    const tugasContainer = document.getElementById("tugasContainer");
    const listTugas = document.getElementById("listTugas");
    const viewMoreBtn = document.getElementById("viewMoreBtn");

    // Hapus elemen li yang ada di dalam ul
    listTugas.innerHTML = "";

    // Batas jumlah tugas yang akan ditampilkan
    const jumlahTugasDitampilkan = 5;

    // Iterasi melalui data tugas dan buat elemen li untuk setiap tugas
    dataTugas.slice(0, jumlahTugasDitampilkan).forEach((tugas) => {
        const liElement = document.createElement("li");
        liElement.classList.add("py-3", "sm:py-4");

        // Isi elemen li dengan data tugas
        liElement.innerHTML = `
            <div class="flex items-center">
                <div class="flex-1 min-w-0 ms-4">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">${tugas.judul}</p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    ${tugas.deskripsi}
                </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">${tugas.nilai}</div>
            </div>
        `;

        // Tambahkan elemen li ke dalam elemen ul
        listTugas.appendChild(liElement);
    });

    // Tampilkan tombol "View More" jika jumlah tugas melebihi batas
    if (dataTugas.length > jumlahTugasDitampilkan) {
        viewMoreBtn.classList.remove("hidden");
    } else {
        viewMoreBtn.classList.add("hidden");
    }
}

// Fungsi untuk mengarahkan pengguna ke halaman list tugas sesuai mata pelajaran
function redirectToTugasPage() {
    // Ganti URL dengan URL halaman list tugas sesuai mata pelajaran
    window.location.href = "list-tugas.html";
}

// Panggil fungsi renderTugas untuk menampilkan data
renderTugas();
