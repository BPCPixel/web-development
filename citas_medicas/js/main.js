/* ===============================
   BINARIA LAB - MAIN JS 2026
   =============================== */

document.addEventListener("DOMContentLoaded", function () {
    initAnimations();
    initConfirmActions();
    initLiveSearch();
    initCounters();
    initTooltips();
});

/* ===============================
   ANIMACIONES AL HACER SCROLL
   =============================== */
function initAnimations() {
    const elements = document.querySelectorAll(".fade-up");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, {
        threshold: 0.15
    });

    elements.forEach(el => observer.observe(el));
}

/* ===============================
   CONFIRMACIONES
   =============================== */
function initConfirmActions() {
    document.querySelectorAll("[data-confirm]").forEach(button => {
        button.addEventListener("click", function (e) {
            const message = this.getAttribute("data-confirm");

            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
}

/* ===============================
   BÚSQUEDA EN TABLAS
   =============================== */
function initLiveSearch() {
    const searchInput = document.getElementById("liveSearch");

    if (!searchInput) return;

    searchInput.addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
}

/* ===============================
   CONTADORES ANIMADOS
   =============================== */
function initCounters() {
    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {
        const target = +counter.getAttribute("data-target");
        let count = 0;
        const increment = Math.ceil(target / 80);

        const updateCounter = () => {
            count += increment;

            if (count < target) {
                counter.textContent = count;
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        updateCounter();
    });
}

/* ===============================
   TOOLTIPS
   =============================== */
function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

/* ===============================
   ALERTA MODERNA
   =============================== */
function showAlert(message, type = "success") {
    const alertBox = document.createElement("div");

    alertBox.className = `alert alert-${type} position-fixed top-0 end-0 m-4 shadow`;
    alertBox.style.zIndex = "9999";
    alertBox.innerHTML = `
        <strong>${type.toUpperCase()}:</strong> ${message}
    `;

    document.body.appendChild(alertBox);

    setTimeout(() => {
        alertBox.remove();
    }, 3000);
}