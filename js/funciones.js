document.addEventListener("DOMContentLoaded", function () {
    // Función para ocultar todos los contenidos de imágenes y descripciones
    function ocultarTodosLosContenidos() {
        const todasLasImagenes = document.querySelectorAll(".service-image img");
        const todasLasDescripciones = document.querySelectorAll(
            ".service-description p"
        );

        todasLasImagenes.forEach((img) => (img.style.display = "none"));
        todasLasDescripciones.forEach((desc) => (desc.style.display = "none"));
    }

    // --- Funcionalidad de login ---
    // --- Funcionalidad de login ---
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const usuario = document.getElementById("usuario").value;
            const contrasena = document.getElementById("contrasena").value;
            const mensaje = document.getElementById("modal-mensaje");
            const modal = document.getElementById("modal");

            if (usuario === "admin" && contrasena === "12345678") {
                mensaje.textContent = "Acceso concedido";
                sessionStorage.setItem("usuarioLogueado", usuario); // GUARDAR SESIÓN
                setTimeout(() => {
                    window.location.href = "admin.html"; // REDIRECCIONAR DESPUÉS DE MOSTRAR MODAL
                }, 1000); // Espera 1 segundo antes de redirigir
            } else {
                mensaje.textContent = "Usuario/contraseña incorrectos";
            }

            modal.style.display = "block";
        });
    }

    const cerrarBtn = document.getElementById("cerrarModal");
    if (cerrarBtn) {
        cerrarBtn.addEventListener("click", function () {
            document.getElementById("modal").style.display = "none";
        });
    }

    // --- Funcionalidad para mostrar contenido según menú ---
    function configurarMenu(idMenu, idImg, idDesc) {
        const menu = document.getElementById(idMenu);
        if (menu) {
            menu.addEventListener("click", function () {
                ocultarTodosLosContenidos();
                const img = document.getElementById(idImg);
                const desc = document.getElementById(idDesc);
                if (img) img.style.display = "block";
                if (desc) desc.style.display = "block";
            });
        }
    }

    configurarMenu("menuEdificios", "imgEdificio", "descEdificio");
    configurarMenu("menuPuentes", "imgPuentes", "descPuentes");
    configurarMenu("menuAcueductos", "imgAcueductos", "descAcueductos");
    configurarMenu(
        "menuAlcantarillados",
        "imgAlcantarillados",
        "descAlcantarillados"
    );
    configurarMenu("menuCarreteras", "imgCarreteras", "descCarreteras");
    configurarMenu("menuAndenes", "imgAndenes", "descAndenes");
    configurarMenu("menuConstruccion", "imgConstruccion", "descConstruccion");
    configurarMenu(
        "menuRemodelaciones",
        "imgRemodelaciones",
        "descRemodelaciones"
    );
    configurarMenu(
        "menuReconstruccion",
        "imgReconstruccion",
        "descReconstruccion"
    );
    configurarMenu("menuRestauracion", "imgRestauracion", "descRestauracion");
    configurarMenu("menuParques", "imgParques", "descParques");
    configurarMenu(
        "menuEspaciosDeportivos",
        "imgEspaciosDeportivos",
        "descEspaciosDeportivos"
    );
    configurarMenu("menuBodegas", "imgBodegas", "descBodegas");

    // --- SLIDER DE PROYECTOS AUTOMÁTICO + EFECTO FADE ---
    const slides = document.querySelectorAll(".slide");
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        if (index < 0) index = slides.length - 1;
        else if (index >= slides.length) index = 0;

        slides.forEach((slide) => slide.classList.remove("active"));

        slides[index].classList.add("active");
        currentSlide = index;
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    showSlide(currentSlide);

    const btnPrev = document.querySelector(".prev");
    const btnNext = document.querySelector(".next");

    if (btnPrev) {
        btnPrev.addEventListener("click", function () {
            prevSlide();
            resetAutoSlide();
        });
    }

    if (btnNext) {
        btnNext.addEventListener("click", function () {
            nextSlide();
            resetAutoSlide();
        });
    }

    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 3000);
    }

    function resetAutoSlide() {
        clearInterval(slideInterval);
        startAutoSlide();
    }

    startAutoSlide();

    // PQRS
    const cerrarBtnPQRS = document.getElementById("cerrarModal");
    if (cerrarBtnPQRS) {
        cerrarBtn.addEventListener("click", function () {
            document.getElementById("modal").style.display = "none";
        });
    }

    function generarCodigoPQRS() {
        const numero = Math.floor(1000000 + Math.random() * 9000000);
        return "PQRS" + numero;
    }

    const formPQRS = document.getElementById("formPQRS");
    if (formPQRS) {
        formPQRS.addEventListener("submit", function (event) {
            event.preventDefault();

            const codigo = generarCodigoPQRS();
            const mensaje = document.getElementById("modal-mensaje");
            const modal = document.getElementById("modal");

            mensaje.textContent = `Su solicitud ha sido registrada con el código: ${codigo}`;
            modal.style.display = "block";

            formPQRS.reset();
        });
    }
});
