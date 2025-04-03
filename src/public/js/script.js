document.querySelector("form").addEventListener("submit", function () {
    let errorMessages = document.querySelectorAll(".error");

    errorMessages.forEach(el => {
        el.style.color = "red";
        el.style.fontWeight = "bold";
    });
});
