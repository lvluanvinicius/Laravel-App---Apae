import React, { useState } from "react";
import ReactDOM from "react-dom/client";
import styled from "styled-components";
import { Form } from "./Form";
import { FormComplaints } from "./FormComplaints";

const ContactContainer = styled.div`
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
`;

const ContactSelector = styled.div`
    width: 80%;
    height: 100%;
    display: flex;
    gap: 1rem;
    padding-left: 1rem;

    button {
        border-top-right-radius: 0.375rem;
        border-top-left-radius: 0.375rem;
        padding: 0.6rem 2rem;
        font-size: 1rem;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        button {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
    }
`;

function Contact() {
    const [selectForm, setSelectForm] = useState(1);

    function setForm(form) {
        setSelectForm(form);
    }

    return (
        <ContactContainer>
            <ContactSelector>
                <button
                    className={`${
                        selectForm === 1 &&
                        "bg-apae-white shadow-md shadow-apae-gray/40"
                    }`}
                    onClick={() => setForm(1)}
                >
                    Contato
                </button>
                <button
                    className={`${
                        selectForm === 2 &&
                        "bg-apae-white shadow-md shadow-apae-gray/40"
                    }`}
                    onClick={() => setForm(2)}
                >
                    Denúncia
                </button>
            </ContactSelector>
            {selectForm === 1 && <Form />}
            {selectForm === 2 && <FormComplaints />}
        </ContactContainer>
    );
}

if (document.getElementById("contacts")) {
    const contacts = ReactDOM.createRoot(document.getElementById("contacts"));

    contacts.render(<Contact />);
}
