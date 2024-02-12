<div style="margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif;">
    <table align="center" width="768" cellpadding="0" cellspacing="0" border="0" style="margin-top: 16px;">
        <tr>
            <td
                style="background: #20c997; padding: 16px; color: white; border-top-left-radius: 8px;border-top-right-radius: 8px;">
                {{-- <img src="{{ asset('images/app/logo-preta.webp') }}" alt="Logo" style="display: block; height: 80px;"> --}}
                <h1>Ouvidoria</h1>
            </td>
        </tr>
    </table>
    <table align="center" width="768" cellpadding="0" cellspacing="0" border="0"
        style="background: #e8eff9; padding: 2rem 1rem;">
        <tr>
            <td style="padding: 16px;">
                <h2 style="color: rgba(0, 0, 0, 0.7); font-size: 20px;">Segue detalhes da nova denúncia,</h2>
                <div style="margin-top: 8px;">
                    <strong>Assunto:</strong> {{ $data['subject'] }}
                </div>
                <div style="margin-top: 8px;">
                    <strong>Mensagem:</strong>
                    <p style="margin-top: 4px; text-indent: 20px; text-align: justify;">
                        {{ $data['message'] }}
                    </p>
                </div>

                <div style="margin-top: 8px;">
                    <strong>Nome:</strong> {{ $data['name'] ? $data['name'] : 'Não informado.' }}
                </div>
                <div style="margin-top: 8px;">
                    <strong>E-mail:</strong> {{ $data['email'] ? $data['email'] : 'Não informado.' }}
                </div>
                <div style="margin-top: 8px;">
                    <strong>Contato:</strong> {{ $data['tel'] ? $data['tel'] : 'Não informado.' }}
                </div>
                <div style="margin-top: 16px;">
                    Att,<br>
                    {{ env('APP_NAME') }}
                </div>

            </td>
        </tr>
    </table>
    <table align="center" width="768" cellpadding="0" cellspacing="0" border="0"
        style="background: #20c997; color: white; padding: 16px; border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;">
        <tr>
            <td style="text-align: center;">

            </td>
        </tr>
    </table>
</div>
