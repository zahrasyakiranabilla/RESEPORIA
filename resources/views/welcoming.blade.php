<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selamat Datang - Reseporia</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* Menambahkan Keyframes untuk Animasi */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* === Gaya Dasar (Warna Asli) === */
    body {
      background-color: #D2D0A0; /* Warna asli dipertahankan */
      font-family: 'Poppins', sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      box-sizing: border-box;
    }

    /* === Kartu Utama (Layout Asli) === */
    .welcome-card {
      display: flex;
      flex-direction: row;
      background-color: #738A70; /* Warna asli dipertahankan */
      border-radius: 25px;
      color: white;
      max-width: 900px;
      width: 100%;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      /* Menambahkan animasi masuk untuk kartu */
      animation: fadeInUp 0.8s ease-out;
    }

    .card-image {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px;
      /* Menambahkan animasi untuk gambar */
      animation: fadeInUp 0.8s ease-out 0.2s;
      animation-fill-mode: backwards;
    }

    .card-image img {
      max-width: 100%;
      height: auto;
      min-width: 200px;
    }

    .card-content {
      flex: 1.2;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* Menerapkan animasi berurutan pada elemen teks dan tombol */
    .card-content > * {
        animation: fadeInUp 0.7s ease-out;
        animation-fill-mode: backwards;
    }
    .card-content h1 { animation-delay: 0.4s; }
    .card-content p { animation-delay: 0.6s; }
    .card-content .explore-button { animation-delay: 0.8s; }

    .card-content h1 {
      font-size: 2.2em; /* Sedikit penyesuaian untuk visual lebih baik */
      font-weight: 700;
      margin: 0 0 15px 0;
    }

    .card-content p {
      font-size: 1.05em; /* Sedikit penyesuaian untuk visual lebih baik */
      margin: 0 0 30px 0;
      line-height: 1.6;
      opacity: 0.9;
    }

    /* === Tombol (Detail Ditingkatkan) === */
    .explore-button {
      background-color: #546D52; /* Warna asli dipertahankan */
      color: #fff;
      padding: 14px 28px;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex; /* Menggunakan flex untuk ikon */
      align-items: center;
      gap: 8px; /* Jarak antara teks dan ikon */
      width: fit-content;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .explore-button::after {
        content: '→'; /* Ikon panah ditambahkan di sini */
        font-size: 1.1em;
        transition: transform 0.2s ease-out;
    }

    .explore-button:hover {
      background-color: #435741;
      transform: translateY(-3px); /* Efek terangkat saat disentuh */
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    .explore-button:hover::after {
        transform: translateX(4px); /* Efek panah bergerak */
    }

    /* === Responsif (Layout Asli) === */
    @media (max-width: 768px) {
      body {
        padding: 0; /* Hapus padding body di mobile agar kartu menempel */
      }
      .welcome-card {
        flex-direction: column;
        text-align: center;
        border-radius: 0; /* Hapus radius di mobile untuk tampilan penuh */
        min-height: 100vh;
        justify-content: center;
      }
      .card-content {
        padding: 30px 25px;
        align-items: center;
      }
      .card-image {
        padding: 40px 20px 0 20px;
        max-width: 250px;
      }
      .card-content h1 { font-size: 1.8em; }
      .card-content p { font-size: 1em; }
    }
  </style>
</head>
<body>

  <div class="welcome-card">
    <div class="card-image">
      <img src="{{ asset('images/makananwelcome.png') }}" alt="Ilustrasi Makanan Reseporia">
    </div>
    <div class="card-content">
      <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
      <p>
        Waktunya masak dengan cinta di dapur ✨<br>
        Yuk mulai petualangan rasa di Reseporia!
      </p>
      <a href="{{ route('home') }}" class="explore-button">Jelajahi Reseporia</a>
    </div>
  </div>

</body>
</html>
