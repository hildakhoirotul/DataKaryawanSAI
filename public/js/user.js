const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const darkMode = localStorage.getItem("darkMode");

darkLight.addEventListener("click", () => {
    body.classList.toggle("dark");
    localStorage.setItem("darkMode", "dark");
    if (body.classList.contains("dark")) {
        darkLight.classList.replace("bx-sun", "bx-moon");
    } else {
        darkLight.classList.replace("bx-moon", "bx-sun");
        localStorage.setItem("darkMode", "light")
    }
});

if (darkMode == "dark") {
    body.classList.toggle("dark");
    darkLight.classList.replace("bx-sun", "bx-moon");
} else {
    darkLight.classList.replace("bx-moon", "bx-sun");
}