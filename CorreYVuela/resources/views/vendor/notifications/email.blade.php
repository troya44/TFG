@component('mail::message')
<table width="100%" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #f9f6f2 0%, #f5e6b2 100%); padding: 30px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background: rgba(255, 255, 255, 0.93); border-radius: 15px; box-shadow: 0px 4px 20px rgba(0,0,0,0.25); padding: 30px;">
                <tr>
                    <td align="center" style="padding-bottom: 20px;">
                        <img src="{{ asset('LogoCorreYVuela.png') }}" alt="Corre y Vuela" width="100" style="border-radius: 12px;">
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Verdana, sans-serif; font-size: 22px; color: #2d3540; font-weight: 700; letter-spacing: 1px; padding-bottom: 15px; text-align: center;">
                        Restablecimiento de contraseña
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Verdana, sans-serif; font-size: 16px; color: #2d3540; line-height: 1.5; padding-bottom: 25px; text-align: center;">
                        Usted ha solicitado restablecer la contraseña de su cuenta en <strong>Corre y Vuela</strong>. Para continuar con el proceso, haga clic en el botón que aparece a continuación.
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-bottom: 30px;">
                        @component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
                            Cambiar contraseña
                        @endcomponent
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Verdana, sans-serif; font-size: 14px; color: #e2c275; line-height: 1.4; text-align: center;">
                        Si usted no solicitó este cambio, puede ignorar este correo electrónico. Su contraseña permanecerá sin cambios.
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 30px; font-family: Verdana, sans-serif; font-size: 12px; color: #b1a06d; text-align: center;">
                        &copy; {{ date('Y') }} Corre y Vuela. Todos los derechos reservados.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endcomponent
