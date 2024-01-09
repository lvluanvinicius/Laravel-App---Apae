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

for (let item of document.querySelectorAll('.input-search-website')) {
    item.addEventListener('focus', function (event) {
        document.querySelector('.search-website-container').classList.toggle('search-website-hidden')
    });
}

document.querySelector('.search-website').addEventListener('blur', function (event) {
    document.querySelector('.search-website-container').classList.toggle('search-website-hidden')
});

document.querySelector('.search-website-close').addEventListener('click', function (event) {
    document.querySelector('.search-website-container').classList.toggle('search-website-hidden');
});

document.addEventListener('keydown', function (event) {
    if (event.ctrlKey && event.key == 'k') {
        event.preventDefault()
        document.querySelector('.search-website-container').classList.toggle('search-website-hidden');
    }
})