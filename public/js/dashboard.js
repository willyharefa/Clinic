const   btnNavCollapse = document.querySelector(".nav-collapse");
        if(btnNavCollapse !== null) {
            btnNavCollapse.addEventListener("click", () => {
                btnNavCollapse.classList.toggle("active");
            })
        }
        
// Action for minimize pages
let minimizeMode    = localStorage.getItem("minimizeMode");
const   mainContent = document.getElementById("main-content");
const   navbar      = document.querySelector(".wrapper-nav");

const   enableMinimizeMode = () => {
        localStorage.setItem("minimizeMode", "enable");
        navbar.classList.add("active");
        mainContent.classList.add("active");
}
const   disableMinimizeMode = () => {
        localStorage.setItem("minimizeMode", null);
        navbar.classList.remove("active");
        mainContent.classList.remove("active");
}
if(minimizeMode == "enable") {
    enableMinimizeMode();
}
// When btn minimize click
const   btnMinimize = document.querySelector(".btn-minimize");
        btnMinimize.addEventListener("click", () => {
            minimizeMode = localStorage.getItem("minimizeMode");
            if(minimizeMode !== "enable") {
                enableMinimizeMode();
            } else {
                disableMinimizeMode();
            }
        })
// In 500px when btnclose on click
const   btnClose    = document.querySelector(".btn-close");
        btnClose.addEventListener("click", () => {
            minimizeMode = localStorage.getItem("minimizeMode");
            disableMinimizeMode();
        })

    window.addEventListener("resize", () => {
        if(window.innerWidth > 760)
        {
            minimizeMode = localStorage.getItem("minimizeMode");
            if(minimizeMode == "enable") {
                disableMinimizeMode();
            }
        }
        if(window.innerWidth <= 760)
        {
            minimizeMode = localStorage.getItem("minimizeMode");
            if(minimizeMode !== "enable") {
                enableMinimizeMode();
            }
        }
        if(window.innerWidth <= 500)
        {
            minimizeMode = localStorage.getItem("minimizeMode");
            if(minimizeMode == "enable") {
                disableMinimizeMode();
            }
        }
    })

if(window.innerWidth <= 500 ) {
    const link = document.querySelectorAll('li a');
        link.forEach(link => {
            link.addEventListener("click", () => {
            minimizeMode = localStorage.getItem("minimizeMode");
            if(minimizeMode == "enable") {
                disableMinimizeMode();
            }
        })
    })
}


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