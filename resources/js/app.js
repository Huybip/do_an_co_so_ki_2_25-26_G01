import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Thêm một số hiệu ứng nhỏ cho giao diện
document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.querySelector("nav.navbar");

    // Đổ bóng cho header khi cuộn
    if (navbar) {
        const toggleShadow = () => {
            if (window.scrollY > 10) {
                navbar.classList.add("shadow-sm");
            } else {
                navbar.classList.remove("shadow-sm");
            }
        };

        toggleShadow();
        window.addEventListener("scroll", toggleShadow);
    }

    // Đóng offcanvas khi click vào link bên trong
    const offcanvasEl = document.getElementById("categorySidebar");
    if (offcanvasEl) {
        offcanvasEl.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (offcanvasInstance) {
                    offcanvasInstance.hide();
                }
            });
        });
    }
});
