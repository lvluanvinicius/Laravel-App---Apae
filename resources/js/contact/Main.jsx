import React from "react";
import ReactDOM from "react-dom/client";
import { Form } from "./Form";

if (document.getElementById('contacts')) {
    const contacts = ReactDOM.createRoot(document.getElementById('contacts'));

    contacts.render(
        <React.StrictMode>
            <Form/>
        </React.StrictMode>
    )
}
