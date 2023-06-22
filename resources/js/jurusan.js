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
    const apiUrl = "http://192.168.100.6/laravel-icp2/public/api/";
    return apiUrl + endpoint;
}

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
            if (data && data.status === "success") {
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
