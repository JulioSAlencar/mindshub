<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Certificado</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #fff;
            padding: 40px;
            color: #333;
        }

        .certificate-container {
            border: 10px solid #154efa;
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            max-height: 200px;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .content {
            text-align: center;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 50px;
        }

        .highlight {
            font-weight: bold;
            font-size: 20px;
            color: #000;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 80px;
        }

        .signature {
            width: 40%;
            text-align: center;
            border-top: 1px solid #999;
            padding-top: 5px;
        }

        .signature img{
            width: 200px;
            height: 100px;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            right: 40px;
            font-size: 12px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="logo">
            <img src="/public/assets/images/logoSideBarOpen.svg" alt="Logo">
        </div>

        <h1>Certificado de Conclusão</h1>

        <div class="content">
            <p>Certificamos que</p>
            <p class="highlight">{{ $certificate->user->name }}</p>
            <p>concluiu com êxito a disciplina</p>
            <p class="highlight">{{ $certificate->discipline->title }}</p>
            <p>em {{ $certificate->issued_at->format('d/m/Y') }}</p>
        </div>

        <div class="signature-section">
            <div class="signature">
                MindsHUb
            </div>
            <div class="signature">
                <img src="/public/assets/images/MHassinatura.png" alt="">
            </div>
        </div>

        <div class="footer">
            Certificado gerado digitalmente
        </div>
    </div>
</body>
</html>
