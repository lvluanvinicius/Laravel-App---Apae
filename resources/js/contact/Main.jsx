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

function Contact() {
    return (
        <ContactContainer>
            <Form />
        </ContactContainer>
    );
}

if (document.getElementById("contacts")) {
    const contacts = ReactDOM.createRoot(document.getElementById("contacts"));

    contacts.render(<Contact />);
}

if (document.getElementById("ombudsman")) {
    const ombudsman = ReactDOM.createRoot(document.getElementById("ombudsman"));

    ombudsman.render(
        <ContactContainer>
            <FormComplaints />
        </ContactContainer>
    );
}
