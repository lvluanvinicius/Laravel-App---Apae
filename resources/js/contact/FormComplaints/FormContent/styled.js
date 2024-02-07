import styled from "styled-components";

export const ErrorInputs = styled.div`
    width: 100%;
    font-size: 0.8rem;
`;

export const SuccessMessage = styled.div`
    color: #00d900;
    font-weight: 600;

    button {
        background-color: orange;
        color: white;
        padding: 0.4rem 2rem;
        border-radius: 6px;
    }
`;

export const FormGroup = styled.div`
    display: flex;
    flex-wrap: wrap;
    position: relative;
    margin-top: 1rem;

    .label {
        display: flex;
        position: absolute;
        inset: 0;
        align-items: center;
        gap: 0.5rem;
        z-index: 0;
        opacity: 0.7;
        padding-left: 0.5rem;
    }

    input {
        width: 100%;
        border-radius: 8px;
        padding: 0.8rem 1rem 0.8rem 8rem;
        z-index: 1;
        text-align: end;
        font-size: 1rem;
    }

    textarea {
        width: 100%;
        border-radius: 8px;
        padding: 0.8rem 8rem 0.8rem 8rem;
        z-index: 1;
    }

    .description {
        inset: unset;
        margin-top: 0.8rem;
    }

    button {
        width: 100%;
        padding: 0.5rem;
        border-radius: 8px;
        cursor: pointer !important;
    }

    button:hover {
        opacity: 0.8;
    }

    button:disabled {
        cursor: not-allowed;
        opacity: 0.8;
    }
`;
