const btnCreateSchedule = document.querySelectorAll(".btn-input");
const modalFade = document.querySelectorAll(".modal.fade");
    btnCreateSchedule.forEach(btnCreateSchedule => {
        btnCreateSchedule.addEventListener("click", () => {
            document.querySelector(".section-top-navbar").style.zIndex = "1";
        })
    })

const cancelCreate = document.querySelectorAll(".modal-footer .btn-cancel-create");
const saveSchedule = document.querySelectorAll(".modal-footer .btn-save");
modalFade.forEach(modalFade => {

    cancelCreate.forEach(cancelCreate => {
        cancelCreate.addEventListener("click", () => {
            if(!modalFade.classList.contains("show")) {
                document.querySelector(".section-top-navbar").style.zIndex = "2";
            }
        })
    })
    saveSchedule.forEach(saveSchedule => {
        saveSchedule.addEventListener("click", () => {
            if(!modalFade.classList.contains("show")) {
                document.querySelector(".section-top-navbar").style.zIndex = "2";
            }
        })
    })
})