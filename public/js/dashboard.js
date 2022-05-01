const   btnNavCollapse = document.querySelector(".nav-collapse");
        if(btnNavCollapse !== null) {
            btnNavCollapse.addEventListener("click", () => {
                btnNavCollapse.classList.toggle("active");
            })
        }
        
// Action for minimize pages
const   btnMinimize = document.querySelector(".btn-minimize");
const   mainContent = document.getElementById("main-content");
const   navbar      = document.querySelector(".wrapper-nav");
        btnMinimize.addEventListener("click", () => {
            navbar.classList.toggle("active");
            mainContent.classList.toggle("active");
        })

        window.addEventListener("resize", () => {
            if(window.innerWidth > 760)
            {
                navbar.classList.remove("active");
                mainContent.classList.remove("active");
            }
            if(window.innerWidth <= 760)
            {
                navbar.classList.add("active");
                mainContent.classList.add("active");
            }
            if(window.innerWidth <= 500)
            {
                navbar.classList.remove("active");
                mainContent.classList.remove("active");
            }
        })

const   btnClose    = document.querySelector(".btn-close");
        btnClose.addEventListener("click", () => {
            navbar.classList.remove("active");
            mainContent.classList.remove("active");
        })
// Action for Dark Mode
let     darkMode = localStorage.getItem("darkMode");
const   containerContent = document.querySelector(".section-content");
const   containerLayout = document.querySelector(".container-layout");

// Turn on dark mode
const   enableDarkMode = () => {
        containerLayout.classList.add("darkmode");
        containerContent.classList.add("darkmode");
        localStorage.setItem("darkMode", "enable");
}
// Turn off dark mode
const   disableDarkMode = () => {
        containerLayout.classList.remove("darkmode");
        containerContent.classList.remove("darkmode");
        localStorage.setItem("darkMode", null);
}
// Check if in localStorage set on enable
if(darkMode === "enable") {
    enableDarkMode();
}
const   btnMode = document.querySelector(".btn-mode-toggle");
        btnMode.addEventListener("click", () => {
            darkMode = localStorage.getItem("darkMode");
            if(darkMode !== "enable") {
                enableDarkMode();
            } else {
                disableDarkMode();
            }
        })

// Action when Logout 
const   btnLogout = document.querySelector(".btn-logout");
const   formLogout = document.getElementById("form-logout");
        btnLogout.addEventListener('click', ()=> {
            const attName = btnLogout.getAttribute("data-name");
            swal({
                title: "Hi, " + attName,
                text: "Anda yakin ingin keluar ?",
                icon: "info",
                html: true,
                buttons: true,
                dangerMode: true,
            })
            .then((willLogout) => {
                if (willLogout) {
                    swal("Anda berhasil logout", {
                        icon: "success",
                    });
                    setTimeout(()=> {
                        formLogout.submit();
                    },800);

                }
            });
        })