document.querySelector("#apae-link").addEventListener("click", function () {
    document
        .querySelector("li[data-dropdown='apae-link']")
        .classList.toggle("hidden");
});

document.querySelector("#lgpd-link").addEventListener("click", function () {
    document
        .querySelector("li[data-dropdown='lgpd-link']")
        .classList.toggle("hidden");
});

for (let toggleSidebar of document.querySelectorAll(".toggle-sidebar")) {
    toggleSidebar.addEventListener("click", function () {
        document
            .querySelector('div[data-sidebar="sidebar"')
            .classList.toggle("hidden-sidebar");
    });
}

for (let toggleSidebar of document.querySelectorAll(".toggle-donatenow")) {
    toggleSidebar.addEventListener("click", function () {
        document
            .querySelector('div[data-card-donate="donatenow"')
            .classList.toggle("hidden");
    });
}