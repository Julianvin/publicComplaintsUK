$(document).ready(function () {
    const apiURL =
        "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";

    $.ajax({
        url: apiURL,
        method: "GET",
        success: function (response) {
            console.log("Data berhasil diambil:", response); // Debug data respons
            if (Array.isArray(response)) {
                response.forEach((province) => {
                    $("#province").append(
                        `<option value="${province.name}">${province.name}</option>`
                    );
                });
            } else {
                console.error("Data tidak valid:", response);
            }
        },
        error: function (xhr, status, error) {
            console.error("Gagal memuat data:", error);
        },
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const fireIcons = document.querySelectorAll(".fire-icon");

    fireIcons.forEach((icon) => {
        icon.addEventListener("click", function () {
            const reportCard = this.closest(".report-card");
            const reportId = reportCard.dataset.reportId;
            const isVoted = this.classList.contains("voted");

            // Kirim request untuk menambahkan atau membatalkan vote
            fetch("/vote", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    report_id: reportId,
                    user_id: USER_ID,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Toggle voted state
                        this.classList.toggle("voted");

                        // Animasi vote atau unvote
                        const animation = document.createElement("div");
                        animation.textContent = isVoted ? "-1" : "+1";
                        animation.classList.add("vote-animation");
                        animation.style.left = `${
                            this.getBoundingClientRect().left + 10
                        }px`;
                        animation.style.top = `${
                            this.getBoundingClientRect().top - 10
                        }px`;
                        document.body.appendChild(animation);

                        setTimeout(() => animation.remove(), 1000);

                        // Perbarui jumlah voting
                        const votingCountSpan =
                            reportCard.querySelector(".voting-count");
                        votingCountSpan.textContent = data.voting_count;

                        // Add pop-up animation to the fire icon
                        this.classList.add("animate-popUp");
                        setTimeout(() => {
                            this.classList.remove("animate-popUp");
                        }, 300);
                    } else {
                        console.error("Gagal memproses voting:", data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    });
});
