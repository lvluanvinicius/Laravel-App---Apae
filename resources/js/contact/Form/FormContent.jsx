import React, { useState } from "react";
import { useForm } from "react-hook-form";
import { ErrorInputs, SuccessMessage } from "./styled";
import { registerContact } from "../../services";

export function FormContent() {
    const errorMessage = "Este campo é obrigatório.";

    const [response, setResponse] = useState({});

    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
    } = useForm();

    async function createContact(data) {
        const register = await registerContact(data);
        setResponse(register);
        reset();
    }

    if (response.status && response.message) {
        return (
            <SuccessMessage>
                <div className="">{response.message}</div>
                <button onClick={() => setResponse({})}>Novo Contato</button>
            </SuccessMessage>
        );
    }

    return (
        <form
            onSubmit={handleSubmit(createContact)}
            className="flex flex-col col-span-2 md:col-span-1"
        >
            <div className="form-group relative flex items-center flex-wrap ">
                <div className="flex items-center gap-1 absolute pl-3 z-10">
                    <i className="ph-bold text-[1.1rem] opacity-70 ph-identification-badge"></i>
                    <label className="opacity-70" htmlFor="name">
                        Nome
                    </label>
                </div>
                <input
                    type="text"
                    name="name"
                    {...register("name", {
                        required: errorMessage,
                    })}
                    className="bg-apae-dark/10 rounded-md pl-24 w-full py-3 text-[1rem] z-0 "
                />
            </div>

            {errors.name && (
                <ErrorInputs className="text-apae-danger">
                    {errors.name.message}
                </ErrorInputs>
            )}

            <div className="form-group relative flex items-center mt-4">
                <div className="flex items-center gap-1 absolute pl-3 z-10">
                    <i className="ph-bold text-[1.1rem] opacity-70 ph-at"></i>
                    <label className="opacity-70" htmlFor="email">
                        E-mail
                    </label>
                </div>
                <input
                    type="email"
                    name="email"
                    onChange={(e) => e.target.error}
                    {...register("email", { required: errorMessage })}
                    className="bg-apae-dark/10 rounded-md pl-24 w-full py-3 text-[1rem] z-0"
                />
            </div>
            {errors.email && (
                <ErrorInputs className="text-apae-danger">
                    {errors.email.message}
                </ErrorInputs>
            )}

            <div className="form-group relative flex items-center mt-4">
                <div className="flex items-center gap-1 absolute pl-3 z-10">
                    <i className="ph-bold text-[1.1rem] opacity-70 ph-phone"></i>
                    <label className="opacity-70" htmlFor="tel">
                        Telefone
                    </label>
                </div>
                <input
                    type="tel"
                    name="tel"
                    {...register("tel", { required: errorMessage })}
                    className="bg-apae-dark/10 rounded-md pl-28 w-full py-3 text-[1rem] z-0"
                />
            </div>
            {errors.tel && (
                <ErrorInputs className="text-apae-danger">
                    {errors.tel.message}
                </ErrorInputs>
            )}

            <div className="form-group relative flex items-center mt-4">
                <div className="flex items-center gap-1 absolute pl-3 z-10">
                    <i className="ph-bold text-[1.1rem] opacity-70 ph-map-pin"></i>
                    <label className="opacity-70" htmlFor="city_uf">
                        Cidade/UF
                    </label>
                </div>
                <input
                    type="text"
                    name="city_uf"
                    {...register("city_uf", { required: errorMessage })}
                    className="bg-apae-dark/10 rounded-md pl-32 w-full py-3 text-[1rem] z-0"
                />
            </div>
            {errors.city_uf && (
                <ErrorInputs className="text-apae-danger">
                    {errors.city_uf.message}
                </ErrorInputs>
            )}

            <div className="form-group relative flex items-center mt-4">
                <div className="flex items-center gap-1 absolute pl-3 z-10">
                    <i className="ph-bold text-[1.1rem] opacity-70 ph-pencil-simple-line"></i>
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
            </div>
            {errors.subject && (
                <ErrorInputs className="text-apae-danger">
                    {errors.subject.message}
                </ErrorInputs>
            )}

            <div className="form-group relative flex items-start mt-4">
                <div className="flex items-center gap-1 absolute pl-3 pt-2 z-10">
                    <i className="ph-bold text-[1.1rem] opacity-70 ph-chat-text"></i>
                    <label className="opacity-70" htmlFor="message">
                        Mensagem
                    </label>
                </div>
                <textarea
                    type="text"
                    name="message"
                    className="bg-apae-dark/10 rounded-md pl-32 w-full py-3 text-[1rem] z-0"
                    cols="30"
                    rows="5"
                    {...register("message", { required: errorMessage })}
                ></textarea>
            </div>
            {errors.message && (
                <ErrorInputs className="text-apae-danger">
                    {errors.message.message}
                </ErrorInputs>
            )}

            <div className="form-group relative flex items-start mt-4">
                <button
                    type="submit"
                    className="bg-apae-green text-apae-white w-full rounded-md py-2"
                >
                    Enviar
                </button>
            </div>
        </form>
    );
}
