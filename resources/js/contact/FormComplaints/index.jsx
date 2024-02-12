import React, { useState } from "react";
import { FormContent } from "./FormContent";
import { TextParagraph } from "./styled";

export function FormComplaints() {
    const [locationAddress, setLocationAddress] = useState(
        "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14685.566226110435!2d-49.7062975!3d-23.0461022!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf406ca4dbdff5f86!2sAssocia%C3%A7%C3%A3o+Pais+Amigos+Excepcionais!5e0!3m2!1spt-BR!2sbr!4v1489374182238"
    );

    return (
        <div className="apae-container h-[100%] md:h-[100vh] mb-10 bg-apae-white shadow-md shadow-apae-gray/40 rounded-md px-6 py-10 grid grid-cols-2 gap-4">
            <aside className="col-span-2 md:col-span-1 flex flex-col gap-4">
                <TextParagraph>
                    A Ouvidoria é um canal dedicado a ouvir você. Estamos aqui
                    para garantir que suas opiniões, preocupações e sugestões,
                    sejam ouvidas e tratadas com respeito e cuidado. Nosso
                    objetivo é promover a transparência, a qualidade e a
                    melhoria contínua dos nossos serviços.
                </TextParagraph>
                <TextParagraph>
                    Se você tiver alguma reclamação, denúncia, elogio ou
                    sugestão, não hesite em entrar em contato conosco. Nossa
                    equipe está pronta para ajudar e resolver qualquer problema
                    que você possa ter encontrado. Todas as suas informações
                    serão tratadas de forma confidencial e sua identidade será
                    protegida, se desejar.
                </TextParagraph>
                <TextParagraph>
                    Para nos contatar, você pode preencher o formulário abaixo,
                    lembrando que os dados de identificação pessoal são
                    opcionais. Faremos o possível para responder o mais rápido
                    possível e garantir que suas preocupações sejam tratadas de
                    maneira adequada.
                </TextParagraph>
                <TextParagraph>
                    Agradecemos por nos ajudar a melhorar. Sua opinião é
                    fundamental para nós.
                </TextParagraph>
                <TextParagraph>
                    Atenciosamente,
                    <br />
                    Equipe da APAE Chavantes
                </TextParagraph>
            </aside>
            <FormContent />
        </div>
    );
}
