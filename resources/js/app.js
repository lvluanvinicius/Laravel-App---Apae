import "./components/Example";

let menu = document.querySelectorAll(".class-toggle-sidebar");
for (let m of menu) {
    if (m)
        m.addEventListener("click", () => {
            document.querySelector(".apae-sidebar").classList.toggle("toggle");
            document.querySelector(".apae-content").classList.toggle("toggle");
        });
}
