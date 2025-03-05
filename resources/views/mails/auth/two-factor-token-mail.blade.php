<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Código de Verificação - GEOSEGBAR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .email-body {
            margin-top: 20px;
        }
        .token {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            display: inline-block;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 4px;
            letter-spacing: 3px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>Verificação de 2FA - GEOSEGBAR</h2>
    </div>
    <div class="email-body">
        <p>Olá {{ $user->name }},</p>
        <p>Seu código de verificação de duas etapas (2FA) é:</p>
        <div style="text-align: center;">
            <span class="token">{{ $token }}</span>
        </div>
        <p>Este código é válido por 5 minutos. Caso não tenha solicitado, desconsidere este e-mail.</p>
    </div>
    <div class="footer">
        <p>Obrigado por usar o nosso sistema!</p>
        <p><small>Este é um e-mail automatizado. Não responda a esta mensagem.</small></p>
    </div>
</div>
</body>
</html>
