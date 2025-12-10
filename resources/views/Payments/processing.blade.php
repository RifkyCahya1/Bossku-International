<html>

<head>
    <title>Processing Payment...</title>
</head>

<body style="font-family: sans-serif; text-align: center; margin-top: 100px;">
    <h2>Sedang memproses pembayaran...</h2>
    <p>Jangan tutup halaman ini ya.</p>

    <script>
        const invoice = "{{ $invoice }}";

        setInterval(() => {
            fetch(`/payment/status/${invoice}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === "PAID") {
                        window.location.href = "/";
                    }
                });
        }, 3000);
    </script>
</body>

</html>