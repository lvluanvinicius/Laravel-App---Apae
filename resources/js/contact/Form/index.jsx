import React, { useState } from "react";

import { FormContent } from "./FormContent";

export function Form() {
    const [locationAddress, setLocationAddress] = useState(
        "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14685.566226110435!2d-49.7062975!3d-23.0461022!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf406ca4dbdff5f86!2sAssocia%C3%A7%C3%A3o+Pais+Amigos+Excepcionais!5e0!3m2!1spt-BR!2sbr!4v1489374182238"
    );

    return (
        <div className="apae-container h-[100%] md:h-[100vh] mb-10 bg-apae-white shadow-md shadow-apae-gray/40 rounded-md px-6 py-10 grid grid-cols-2 gap-4">
            <FormContent />

            <aside className="col-span-2 md:col-span-1 flex flex-col gap-4">
                <div className="w-full">
                    <h1 className="text-[1rem] font-bold">E-mail</h1>
                    <h2 className="text-[.9rem]">apaechavantes@hotmail.com</h2>
                </div>

                <div className="w-full">
                    <h1 className="text-[1rem] font-bold">Telefone</h1>
                    <h2 className="text-[.9rem]">(14) 3342-2304</h2>
                </div>

                <h3 className="font-bold text-[1.2rem]">Nosso Local:</h3>

                <div className="w-full flex-1">
                    <div className="w-full h-full">
                        <iframe
                            className="w-full h-full"
                            src={locationAddress}
                        ></iframe>
                    </div>
                </div>
            </aside>
        </div>
    );
}
