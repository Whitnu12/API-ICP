import { getApiUrl } from "./api.js";
import { showAlert } from "./toast.js";

function addJurusan() {
    const jurusan = document.getElementById("jurusan").value;

    const jurusanData = {
        nama_jurusan: jurusan,
    };

    fetch(getApiUrl("jurusan"), {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(jurusanData),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.message === "Jurusan berhasil ditambahkan") {
                showAlert("Jurusan berhasil ditambahkan!");
                document.getElementById("addJurusan").reset();
            } else {
                showAlert("Jurusan gagal ditambahkan!");
            }
        })
        .catch((error) => console.error("Error:", error));
}

const form = document.getElementById("addJurusan");
form.addEventListener("submit", function (event) {
    event.preventDefault();
    addJurusan();
});
