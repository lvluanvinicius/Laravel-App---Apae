import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom/client";
import { searchLinks } from "../../services";

function SearchList() {
    const [links, setLinks] = useState([]);
    const [valueSearch, setValueSearch] = useState(null);

    async function getLinks() {
        const response = await searchLinks({ q: valueSearch });
        setLinks(response.data);
    }

    useEffect(() => {
        getLinks();
    }, [valueSearch]);

    function closeForm() {
        document
            .querySelector(".search-website-container")
            .classList.toggle("search-website-hidden");
    }

    return (
        <div className="search-website bg-apae-teal !h-[400px]">
            <header className="search-website-header">
                <input
                    type="text"
                    name="search-website-documentation"
                    className="search-website-input-searching !outline-apae-orange"
                    onInput={(event) => setValueSearch(event.target.value)}
                    autoFocus={true}
                />
                <button
                    className="search-website-close bg-apae-danger text-apae-white"
                    onClick={closeForm}
                    style={{ backgroundColor: "#FF7A30" }}
                >
                    Fechar
                </button>
            </header>

            <main className="search-website-main">
                <section
                    className="search-website-content"
                    style={{ overflow: "auto" }}
                >
                    {links &&
                        links.map((lk) => {
                            return (
                                <a
                                    tabIndex={lk.name}
                                    key={lk.name}
                                    href={lk.location}
                                    className="search-website-items bg-apae-gray-dark/50 text-white "
                                >
                                    <span>{lk.name.toString()}</span>
                                    <span className="text-apae-cyan">
                                        <i className="fa-solid fa-link"></i>
                                    </span>
                                </a>
                            );
                        })}
                </section>
            </main>

            <footer className="search-website-footer bg-apae-green text-apae-white">
                <span>Desenvolvido por </span>
                <a href="mailto:lvluansantos@gmail.com" className="">
                    @Luan_Santos
                </a>
            </footer>
        </div>
    );
}

if (document.getElementById("search-website-main")) {
    const root = ReactDOM.createRoot(
        document.getElementById("search-website-main")
    );
    root.render(<SearchList />);
}
