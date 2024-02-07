import React, { useState } from "react";
import { useForm } from "react-hook-form";
import { ErrorInputs, FormGroup, SuccessMessage } from "./styled";
import { registerComplaints } from "../../../services";

export function FormContent() {
    const errorMessage = "Este campo é obrigatório.";

    const [response, setResponse] = useState({});

    const {
        register,
        handleSubmit,
        formState: { errors, isSubmitting },
        reset,
    } = useForm();

    async function createContact(data) {
        const register = await registerComplaints(data);
        setResponse(register);
        reset();
    }

    if (response.status && response.message) {
        return (
            <SuccessMessage className="flex justify-start items-center gap-4 flex-col">
                <div className="text-center">{response.message}</div>
                <button
                    className="text-center !bg-yellow-300"
                    onClick={() => setResponse({})}
                >
                    Novo Contato
                </button>
            </SuccessMessage>
        );
    }

    return (
        <form
            onSubmit={handleSubmit(createContact)}
            className="flex flex-col col-span-2 md:col-span-1"
        >
            <FormGroup>
                <div className="label">
                    <i className="ph-bold ph-identification-badge"></i>
                    <label htmlFor="name">Nome</label>
                </div>
                <input
                    type="text"
                    name="name"
                    {...register("name")}
                    className="bg-apae-dark/10"
                />
            </FormGroup>

            <FormGroup>
                <div className="label">
                    <i className="ph-bold text-[1.1rem] opacity-70 ph-at"></i>
                    <label className="opacity-70" htmlFor="email">
                        E-mail
                    </label>
                </div>
                <input
                    type="email"
                    name="email"
                    onChange={(e) => e.target.error}
                    {...register("email")}
                    className="bg-apae-dark/10"
                />
            </FormGroup>

            <FormGroup>
                <div className="label">
                    <i className="ph-bold ph-phone"></i>
                    <label className="opacity-70" htmlFor="tel">
                        Telefone
                    </label>
                </div>
                <input
                    type="tel"
                    name="tel"
                    {...register("tel")}
                    className="bg-apae-dark/10"
                />
            </FormGroup>

            <FormGroup>
                <div className="label">
                    <i className="ph-bold ph-pencil-simple-line"></i>
                    <label className="opacity-70" htmlFor="subject">
                        Assunto
                    </label>
                </div>
                <input
                    type="text"
                    name="subject"
                    {...register("subject", { required: errorMessage })}
                    className="bg-apae-dark/10 rounded-md pl-[6.8rem] w-full py-3 text-[1rem] z-0"
                />
            </FormGroup>
            {errors.subject && (
                <ErrorInputs className="text-apae-danger">
                    {errors.subject.message}
                </ErrorInputs>
            )}

            <FormGroup>
                <div className="label description">
                    <i className="ph-bold ph-chat-text"></i>
                    <label className="opacity-70" htmlFor="message">
                        Mensagem
                    </label>
                </div>
                <textarea
                    type="text"
                    name="message"
                    className="bg-apae-dark/10"
                    cols="30"
                    rows="5"
                    {...register("message", { required: errorMessage })}
                ></textarea>
            </FormGroup>
            {errors.message && (
                <ErrorInputs className="text-apae-danger">
                    {errors.message.message}
                </ErrorInputs>
            )}

            <FormGroup>
                <button
                    type="submit"
                    className="bg-apae-green text-apae-white"
                    disabled={isSubmitting}
                >
                    {isSubmitting ? "Aguarde..." : "Enviar"}
                </button>
            </FormGroup>
        </form>
    );
}
