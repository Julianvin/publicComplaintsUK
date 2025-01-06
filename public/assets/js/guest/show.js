document.addEventListener('DOMContentLoaded', function() {
    // Toggle content
    document.querySelectorAll(".toggle-content").forEach((header) => {
        header.addEventListener("click", () => {
            const targetId = header.getAttribute("data-target");
            const targetContent = document.getElementById(targetId);
            const toggleIcon = header.querySelector(".toggle-icon");

            if (targetContent.classList.contains("hidden")) {
                targetContent.classList.remove("hidden", "opacity-0");
                targetContent.classList.add("opacity-100");
                toggleIcon.classList.add("rotate-180");
            } else {
                targetContent.classList.remove("opacity-100");
                targetContent.classList.add("opacity-0");
                setTimeout(() => {
                    targetContent.classList.add("hidden");
                }, 300);
                toggleIcon.classList.remove("rotate-180");
            }
        });
    });

    // Tab functionality
    document.querySelectorAll(".bg-white").forEach((container) => {
        const tabs = container.querySelectorAll(".tab-button");
        const contents = container.querySelectorAll(".tab-content");

        contents[0]?.classList.remove("hidden");
        tabs[0]?.classList.add("text-green-800", "border-b-2", "border-green-500");

        tabs.forEach((tab) => {
            tab.addEventListener("click", () => {
                const tabName = tab.getAttribute("data-tab");

                tabs.forEach(t => t.classList.remove("text-green-800", "border-b-2",
                    "border-green-500"));
                tab.classList.add("text-green-800", "border-b-2",
                    "border-green-500");

                contents.forEach((content) => {
                    content.classList.add("hidden");
                });

                container.querySelector(`#${tabName}`).classList.remove("hidden");
            });
        });
    });
});

function openModalDelete(id, created_at) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: `Pengaduan yang dibuat pada ${created_at} akan dihapus.`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/report/${id}/hapus/report`;
        }
    });
}
