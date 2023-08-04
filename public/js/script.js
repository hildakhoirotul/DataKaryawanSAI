const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");
const sidebarStatus = localStorage.getItem("sidebarStatus") || "collapsed";
const darkMode = localStorage.getItem("darkMode");

document.addEventListener("DOMContentLoaded", () => {
    // sidebar.classList.add("close");
    if (sidebarStatus === "expanded") {
        sidebar.classList.remove("close");
    } else {
        sidebar.classList.add("close");
    }
});

if (sidebarStatus === "expanded") {
    sidebar.classList.remove("close", "hoverable");
} else {
    sidebar.classList.add("close", "hoverable");
}

sidebarClose.addEventListener("click", () => {
    sidebar.classList.add("close", "hoverable");
    localStorage.setItem("sidebarStatus", "collapsed");
});

sidebarExpand.addEventListener("click", () => {
    sidebar.classList.remove("close", "hoverable");
    localStorage.setItem("sidebarStatus", "expanded");
});

sidebar.addEventListener("mouseover", () => {
    if (sidebar.classList.contains("hoverable")) {
        sidebar.classList.remove("close");
    }
});
sidebar.addEventListener("mouseout", () => {
    if (sidebar.classList.contains("hoverable")) {
        sidebar.classList.add("close");
    }
});

darkLight.addEventListener("click", () => {
    body.classList.toggle("dark");
    localStorage.setItem("darkMode", "dark");
    if (body.classList.contains("dark")) {
        document.setI
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

submenuItems.forEach((item, index) => {
    item.addEventListener("click", () => {
        item.classList.toggle("show_submenu");
        submenuItems.forEach((item2, index2) => {
            if (index !== index2) {
                item2.classList.remove("show_submenu");
            }
        });
    });
});

if (window.innerWidth < 768) {
    sidebar.classList.add("close");
} else {
    sidebar.classList.remove("close");
}