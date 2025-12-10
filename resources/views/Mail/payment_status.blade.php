<h2>Halo {{ $payment->name }},</h2>

<p>Status pembayaran kamu berubah nih:</p>

<p>
    <strong>Invoice:</strong> {{ $payment->invoice_number }} <br>
    <strong>Tour:</strong> {{ $payment->tour_name }} <br>
    <strong>Total:</strong> Rp {{ number_format($payment->total, 0, ',', '.') }} <br>
    <strong>Status:</strong> <span style="text-transform: uppercase;">{{ $payment->status }}</span>
</p>

<p>Jika kamu butuh bantuan, tinggal balas email ini ya 👌</p>

<p>Terima kasih!</p>
