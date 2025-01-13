<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('sweetalert::alert')
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="text-center">Selesaikan pembayaran dalam</h5>
        <h2 class="text-center text-danger fw-bold">23:59:25</h2>
        <p class="text-center">Batas Akhir Pembayaran</p>
        <h6 class="text-center fw-bold">
          {{ \Carbon\Carbon::parse($transaction->created_at)->addDay()->format('l, d F Y H:i') }}
        </h6>
        <hr>
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h6>{{ $transaction->bank->bank_name }} Virtual Account</h6>
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-0">Nomor Virtual Account</p>
                <h5 class="fw-bold">{{ $transaction->bank->bank_account_number }}</h5>
              </div>
              <button class="btn btn-outline-success btn-sm" onclick="copyToClipboard('{{ $transaction->bank->bank_account_number }}')">Salin</button>
            </div>
            <div class="mt-3">
              <p class="mb-0">Total Tagihan</p>
              <h5 class="fw-bold text-primary">Rp{{ number_format($transaction->grand_total_amount, 0, ',', '.') }}</h5>
            </div>
            {{-- <div class="mt-3 text-end">
              <a href="#" class="btn btn-link">Lihat Detail</a>
            </div> --}}
          </div>
        </div>
        <hr>
        <div class="row mt-3">
          <div class="col-md-6 offset-md-3">
            <h6 class="fw-bold">Upload Bukti Pembayaran</h6>
            <form action="{{ route('front.paymentStore', $transaction->transaction_trx_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
              <div class="mb-3">
                <input type="file" class="form-control" id="proof" accept="image/*" name="proof" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
          </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center gap-3">
          <button class="btn btn-outline-secondary">Cek Status Pembayaran</button>
          <a href="{{ route('front.index') }}" class="btn btn-success">Belanja Lagi</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        Swal.fire({
          toast: true,                  // Mengaktifkan mode Toast
          position: 'top-end',          // Posisi Toast (bisa top-end, top, bottom, etc.)
          icon: 'success',              // Ikon yang ditampilkan
          title: 'Nomor Virtual Account berhasil disalin!',  // Pesan yang ditampilkan
          showConfirmButton: false,     // Menyembunyikan tombol konfirmasi
          timer: 3000,                  // Durasi tampil dalam milidetik (3000ms = 3 detik)
          timerProgressBar: true,       // Menampilkan progress bar
        });
      }).catch(err => {
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Terjadi kesalahan saat menyalin nomor Virtual Account.',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
        });
      });
    }
</script>


  </script>
</body>
</html>
