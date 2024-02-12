import axios from "axios";

const URL = window.location.origin;

export const api = axios.create({ baseURL: `${URL}/api` });

export async function registerContact(data) {
    const register = await api
        .post("website/contact", data)
        .then(function (response) {
            if (
                response.status &&
                response.status === 200 &&
                response.statusText === "OK"
            ) {
                return response.data;
            }

            throw new Error(
                "A comunicação com o servidor não foi bem sucedida. Por favor, tente novamente mais tarde."
            );
        })
        .catch((error) => {
            alert(
                "Houve um erro interno ao tentar salvar seu contato. Tente novamente mais tarde."
            );
            console.error(error);
        });

    return register;
}

export async function registerComplaints(data) {
    const register = await api
        .post("website/contact/complaints", data)
        .then(function (response) {
            if (
                response.status &&
                response.status === 200 &&
                response.statusText === "OK"
            ) {
                return response.data;
            }

            throw new Error(
                "A comunicação com o servidor não foi bem sucedida. Por favor, tente novamente mais tarde."
            );
        })
        .catch((error) => {
            alert(
                "Houve um erro interno ao tentar salvar seu contato. Tente novamente mais tarde."
            );
            console.error(error);
        });

    return register;
}

export async function getPhotosFiles(galleryId) {
    const register = await api
        .get(`website/photo-gallery/${galleryId}`)
        .then(function (response) {
            if (
                response.status &&
                response.status === 200 &&
                response.statusText === "OK"
            ) {
                return response.data;
            }

            throw new Error(
                "A comunicação com o servidor não foi bem sucedida. Por favor, tente novamente mais tarde."
            );
        })
        .catch((error) => {
            alert(
                "Houve um erro interno ao tentar salvar seu contato. Tente novamente mais tarde."
            );
            console.error(error);
        });

    return register;
}

export async function searchLinks(query = null) {
    const register = await api
        .get("website/search-links", {
            params: query ? query : null,
        })
        .then(function (response) {
            if (
                response.status &&
                response.status === 200 &&
                response.statusText === "OK"
            ) {
                return response.data;
            }

            throw new Error(
                "A comunicação com o servidor não foi bem sucedida. Por favor, tente novamente mais tarde."
            );
        })
        .catch((error) => {
            alert(
                "Houve um erro interno ao tentar salvar seu contato. Tente novamente mais tarde."
            );
            console.error(error);
        });

    return register;
}
