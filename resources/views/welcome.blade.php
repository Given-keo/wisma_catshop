
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ env("APP_NAME") }}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset("template") }}/assets/img/favicon.png" rel="icon">
  <link href="{{ asset("template") }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("template") }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset("template") }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset("template") }}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset("template") }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset("template") }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset("template") }}/assets/css/main.css" rel="stylesheet">


</head>

<body class="index-page">


  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">

        <img src="{{ asset("template") }}/assets/img/logo.jpeg" alt="Logo Brand" style="border-radius: 50%;">
        <h1 class="sitename">Wisma Catshop</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#services">Layanan</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="cta-btn" href="{{ route("login") }}">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{ asset("template") }}/assets/img/hero-bg.jpg" alt="gambar hero section" data-aos="fade-in">

      <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100" align="center">RAWAT. MANJAKAN. SAYANGI.</h2>
        <p data-aos="fade-up" data-aos-delay="200" align="center">Pusat perlengkapan, makanan, dan layanan perawatan profesional untuk membuat anabul Anda tampil bersih dan terus purring sepanjang hari.</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
          <a href="#about" class="btn-get-started">Pelajari</a>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <h3>Selamat Datang di Wisma Catshop, Pusat Kebutuhan & Perawatan Kucing</h3>
                <img src="{{ asset("template") }}/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="Tentang Wisma Catshop">
                <p>Kami mengerti bahwa kucing bukan sekadar hewan peliharaan, melainkan bagian berharga dari keluarga Anda. Di Wisma Catshop, kami berkomitmen penuh untuk menyediakan produk dan layanan berkualitas tinggi guna memastikan anabul kesayangan Anda selalu sehat, lincah, dan bahagia.</p>
                <p>Mulai dari pilihan makanan bernutrisi, perlengkapan bermain yang aman, hingga produk perawatan harian terbaik, semuanya tersedia lengkap di sini. Tim kami dengan senang hati siap membantu Anda menemukan solusi terbaik untuk kenyamanan dan keceriaan si meong setiap harinya.</p>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <div class="content ps-0 ps-lg-5">
                <p class="fst-italic">
                    Kenyamanan anabul dan kepuasan Anda adalah prioritas utama kami. Kami selalu siap melayani segala kebutuhan perawatan kucing kesayangan Anda.
                </p>
                <ul>
                    <li>
                    <i class="bi bi-check-circle-fill"></i> 
                    <span><strong>Jam Operasional:</strong> Buka setiap hari mulai pukul 08:00 AM hingga 09:00 PM.</span>
                    </li>
                    <li>
                    <i class="bi bi-check-circle-fill"></i> 
                    <span><strong>Hubungi Kami:</strong> Telepon/WhatsApp: 0877-7604-8999 | Email: wismacatshop@gmail.com</span>
                    </li>
                    <li>
                    <i class="bi bi-check-circle-fill"></i> 
                    <span><strong>Lokasi & Layanan:</strong> Kunjungi toko kami via <a href="https://maps.app.goo.gl/Ev7ahnVQCfdNyE8C8" target="_blank" class="text-decoration-none">Google Maps</a> atau jelajahi lebih lengkap di <a href="https://linktr.ee/wismacatshop" target="_blank" class="text-decoration-none">Linktree Wisma Catshop</a>.</span>
                    </li>
                </ul>
                <p>
                    Jangan ragu untuk menghubungi atau mengunjungi kami secara langsung. Kami siap merekomendasikan nutrisi, perlengkapan, dan produk perawatan terbaik agar anabul Anda terus *purring* sepanjang hari!
                </p>

                <div class="position-relative mt-4">
                    <img src="{{ asset("template") }}/assets/img/about-2.jpg" class="img-fluid rounded-4" alt="Layanan Wisma Catshop">
                </div>
                </div>
            </div>
        </div>

      </div>

    </section>
    <!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <!-- Item 1: Pengalaman -->
          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-award color-blue flex-shrink-0"></i>
              <div>
                <span class="fs-3 fw-bold d-block mb-1">10+ Tahun</span>
                <p class="mb-0">Pengalaman melayani dan merawat anabul</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <!-- Item 2: Jam Operasional -->
          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-clock color-orange flex-shrink-0"></i>
              <div>
                <span class="fs-4 fw-bold d-block mb-1">08:00 - 21:00</span>
                <p class="mb-0">Jam operasional toko, buka setiap hari</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <!-- Item 3: Grooming Sehat -->
          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-droplet color-green flex-shrink-0"></i>
              <div>
                <span class="fs-3 fw-bold d-block mb-1">Rp 65rb</span>
                <p class="mb-0"><strong>Grooming Sehat:</strong> Potong kuku, bersihkan telinga, & bulu wangi</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <!-- Item 4: Grooming Kutu & Jamur -->
          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-shield-plus color-pink flex-shrink-0"></i>
              <div>
                <span class="fs-3 fw-bold d-block mb-1">Rp 95rb</span>
                <p class="mb-0"><strong>Grooming Kutu & Jamur:</strong> Grooming Sehat + Obat Kutu & Jamur</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section>
    <!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Layanan & Produk</h2>
        <p>Pilihan Terbaik untuk Anabul Anda<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

          <!-- Service Item 1: Grooming -->
          <!-- Tambahkan d-flex di kolom -->
          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="200">
            <!-- Tambahkan w-100 dan d-flex flex-column di sini -->
            <div class="service-item w-100 d-flex flex-column">
              <div class="img">
                <img src="{{ asset("template") }}/assets/img/services-1.jpg" class="img-fluid" alt="Layanan Grooming Wisma Catshop">
              </div>
              <!-- Tambahkan flex-grow-1 agar kotak detail ini mengisi sisa ruang yang kosong -->
              <div class="details position-relative flex-grow-1">
                <div class="icon">
                  <i class="bi bi-stars"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3>Layanan Grooming</h3>
                </a>
                <p>Mulai dari Grooming Sehat (Rp 65rb) hingga Grooming Kutu & Jamur (Rp 95rb). Anabul Anda akan ditangani dengan penuh kasih sayang agar kembali bersih, sehat, dan wangi.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <!-- Service Item 2: Makanan & Nutrisi -->
          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="300">
            <div class="service-item w-100 d-flex flex-column">
              <div class="img">
                <img src="{{ asset("template") }}/assets/img/services-2.jpg" class="img-fluid" alt="Makanan dan Nutrisi Kucing">
              </div>
              <div class="details position-relative flex-grow-1">
                <div class="icon">
                  <i class="bi bi-bag-heart"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3>Makanan & Nutrisi</h3>
                </a>
                <p>Sediakan nutrisi terbaik untuk si meong. Kami menjual berbagai pilihan makanan kering (dry food), makanan basah (wet food), snack, hingga vitamin berkualitas.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <!-- Service Item 3: Perlengkapan -->
          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="400">
            <div class="service-item w-100 d-flex flex-column">
              <div class="img">
                <img src="{{ asset("template") }}/assets/img/services-3.jpg" class="img-fluid" alt="Perlengkapan dan Mainan Kucing">
              </div>
              <div class="details position-relative flex-grow-1">
                <div class="icon">
                  <i class="bi bi-basket"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3>Perlengkapan & Mainan</h3>
                </a>
                <p>Temukan pasir kucing premium, bak pasir, sampo, sisir, hingga aneka mainan interaktif yang siap membuat anabul Anda selalu lincah dan bebas stres.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section>
    <!-- /Services Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

        </div>

      </div>

    </section>
    <!-- /Clients Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <div class="container">

        <!-- Section Title (Opsional, ditambahkan agar lebih rapi) -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Keunggulan Kami</h2>
          <p>Mengapa Memilih Wisma Catshop?</p>
        </div>

        <ul class="nav nav-tabs row d-flex" data-aos="fade-up" data-aos-delay="100">
          <li class="nav-item col-3">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
              <i class="bi bi-bag-check"></i>
              <h4 class="d-none d-lg-block">Produk Lengkap</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
              <i class="bi bi-stars"></i>
              <h4 class="d-none d-lg-block">Grooming Ahli</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
              <i class="bi bi-tags"></i>
              <h4 class="d-none d-lg-block">Harga Terbaik</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
              <i class="bi bi-chat-heart"></i>
              <h4 class="d-none d-lg-block">Pelayanan Ramah</h4>
            </a>
          </li>
        </ul><!-- End Tab Nav -->

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <!-- Tab 1: Produk Lengkap -->
          <div class="tab-pane fade active show" id="features-tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Segala kebutuhan anabul kesayangan Anda tersedia di satu tempat.</h3>
                <p class="fst-italic">
                  Kami mengkurasi produk-produk terbaik untuk memastikan kesehatan dan kebahagiaan kucing Anda setiap harinya.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span><strong>Makanan Premium:</strong> Tersedia pilihan dry food dan wet food bernutrisi tinggi.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span><strong>Perlengkapan Harian:</strong> Pasir wangi, bak pasir, hingga tas kargo yang nyaman.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span><strong>Mainan & Aksesori:</strong> Aneka mainan interaktif untuk menjaga anabul tetap aktif dan tidak stres.</span></li>
                </ul>
                <p>
                  Tidak perlu repot mencari ke tempat lain. Di Wisma Catshop, dari kebutuhan dasar hingga perawatan ekstra, semuanya kami sediakan dengan jaminan kualitas terbaik.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset("template") }}/assets/img/working-1.jpg" alt="Produk Lengkap Wisma Catshop" class="img-fluid rounded-4">
              </div>
            </div>
          </div><!-- End Tab Content Item -->

          <!-- Tab 2: Grooming Ahli -->
          <div class="tab-pane fade" id="features-tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Perawatan profesional yang membuat kucing Anda bersih, wangi, dan bebas kutu.</h3>
                <p>
                  Proses grooming kami dilakukan oleh tenaga ahli yang berpengalaman menangani berbagai karakter kucing, sehingga anabul Anda tetap merasa aman dan nyaman.
                </p>
                <p class="fst-italic">
                  Kesehatan kulit dan bulu adalah kunci kenyamanan kucing.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Potong kuku dan pembersihan telinga dilakukan dengan hati-hati.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Menggunakan sampo khusus yang aman untuk kulit sensitif anabul.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Tersedia penanganan khusus untuk masalah kutu dan jamur membandel.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Ruang grooming yang bersih dan steril untuk mencegah penularan penyakit.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset("template") }}/assets/img/working-2.jpg" alt="Layanan Grooming Wisma Catshop" class="img-fluid rounded-4">
              </div>
            </div>
          </div><!-- End Tab Content Item -->

          <!-- Tab 3: Harga Terbaik -->
          <div class="tab-pane fade" id="features-tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Kualitas premium tidak harus selalu membuat kantong Anda jebol.</h3>
                <p>
                  Kami percaya bahwa setiap kucing berhak mendapatkan nutrisi, perawatan, hingga tempat singgah sementara yang terbaik. Oleh karena itu, kami menawarkan layanan dengan harga yang sangat ramah di kantong.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span><strong>Produk & Grooming Terjangkau:</strong> Harga bersaing untuk seluruh perlengkapan, dan tarif grooming transparan mulai dari Rp 65rb.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span><strong>Penitipan Kucing Hanya Rp 35.000/Hari:</strong> Solusi hemat dan aman saat Anda bepergian (tarif per ekor, pakan bawa sendiri).</span></li>
                  <li><i class="bi bi-check2-all"></i> <span><strong>Terpercaya & Transparan:</strong> Penitipan dilengkapi dengan syarat & ketentuan yang jelas, termasuk pelaporan berupa bukti foto agar Anda tetap tenang.</span></li>
                </ul>
                <p class="fst-italic">
                  Hemat budget Anda tanpa perlu mengorbankan kualitas perawatan maupun fasilitas penitipan untuk anabul tersayang.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('template/assets/img/working-3.jpg') }}" alt="Harga Terbaik Wisma Catshop" class="img-fluid rounded-4">
              </div>
            </div>
          </div>
          <!-- End Tab Content Item -->

          <!-- Tab 4: Pelayanan Ramah -->
          <div class="tab-pane fade" id="features-tab-4">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Tim kami adalah sesama pencinta kucing yang siap membantu Anda.</h3>
                <p>
                  Lebih dari sekadar toko, Wisma Catshop adalah sahabat bagi Anda dan kucing kesayangan. Kami melayani dengan sepenuh hati layaknya merawat anabul kami sendiri.
                </p>
                <p class="fst-italic">
                  Jangan ragu untuk bertanya, kami siap mendengarkan.
                </p>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Bebas berkonsultasi mengenai keluhan kulit atau nafsu makan kucing.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Staf yang edukatif dalam merekomendasikan produk sesuai kebutuhan anabul.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Respon cepat untuk setiap pertanyaan via WhatsApp maupun langsung di toko.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset("template") }}/assets/img/working-4.jpg" alt="Pelayanan Ramah Wisma Catshop" class="img-fluid rounded-4">
              </div>
            </div>
          </div><!-- End Tab Content Item -->

        </div>

      </div>

    </section>
    <!-- /Features Section -->


    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

        <img src="{{ asset('template/assets/img/cta-bg.jpg') }}" class="testimonials-bg" alt="Wisma Catshop Background">

        <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
            
            <!-- Satu Kalimat CTA -->
            <h3 class="text-white fw-bold mb-4" style="font-size: 1.3rem;">
                Hubungi Wisma Catshop sekarang untuk memberikan perawatan dan nutrisi terbaik bagi anabul kesayangan Anda!
            </h3>

            <!-- Tombol Aksi -->
            <a href="{{ route("login") }}" class="btn btn-outline-light btn-lg rounded-pill fw-bold">
            Mulai Sekarang
            </a>

        </div>

    </section>
    <!-- /Testimonials Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section position-relative">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak Kami</h2>
        <p>Kunjungi Toko Kami atau Hubungi Secara Online</p>
      </div><!-- End Section Title -->

      <div class="container position-relative" style="z-index: 10;" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          
          <!-- Bagian Kiri: Info Kontak & Tombol Mulai -->
          <div class="col-lg-6">
            <div class="row gy-4">

              <!-- Info Telepon / WhatsApp -->
              <div class="col-lg-12">
                <!-- Tambahkan class info-box-clickable -->
                <div class="info-item info-box-clickable position-relative d-flex flex-column justify-content-center align-items-center shadow-sm p-4" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-telephone fs-2 mb-2"></i>
                  <h3>Telepon / WhatsApp</h3>
                  <p class="mb-2 fw-bold text-dark">0877-7604-8999</p>
                  <!-- Penanda visual bahwa ini tombol -->
                  <span class="badge badge-target rounded-pill px-3 py-2"><i class="bi bi-whatsapp"></i> Hubungi Sekarang</span>
                  <a href="https://wa.me/6287776048999" target="_blank" class="stretched-link"></a>
                </div>
              </div><!-- End Info Item -->

              <!-- Info Email -->
              <div class="col-md-6">
                <div class="info-item info-box-clickable position-relative d-flex flex-column justify-content-center align-items-center shadow-sm p-4" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-envelope fs-2 mb-2"></i>
                  <h3>Email</h3>
                  <p class="mb-2 fw-bold text-dark text-truncate w-100 text-center">wismacatshop@gmail.com</p>
                  <span class="badge badge-target rounded-pill px-3 py-2"><i class="bi bi-envelope-paper"></i> Kirim Email</span>
                  <a href="mailto:wismacatshop@gmail.com" class="stretched-link"></a>
                </div>
              </div><!-- End Info Item -->

              <!-- Info Linktree -->
              <div class="col-md-6">
                <div class="info-item info-box-clickable position-relative d-flex flex-column justify-content-center align-items-center shadow-sm p-4" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-link-45deg fs-2 mb-2"></i>
                  <h3>Linktree</h3>
                  <p class="mb-2 fw-bold text-dark">Wisma Catshop</p>
                  <span class="badge badge-target rounded-pill px-3 py-2"><i class="bi bi-box-arrow-up-right"></i> Buka Link</span>
                  <a href="https://linktr.ee/wismacatshop" target="_blank" class="stretched-link"></a>
                </div>
              </div><!-- End Info Item -->

              <!-- Tombol Mulai (Login) -->
              <div class="col-lg-12 text-center mt-5 position-relative" style="z-index: 99;" data-aos="fade-up" data-aos-delay="500">
                <p class="text-muted mb-3">Ayo mulai layanan grooming dan penitipan kucing anda.</p>
                <a href="/login" class="btn btn-started-contact btn-lg rounded-pill px-5 py-3 fw-bold shadow">
                  <i class="bi bi-box-arrow-in-right me-2"></i> Mulai Sekarang
                </a>
              </div>

            </div>
          </div>

          <!-- Bagian Kanan: Iframe Google Maps -->
          <div class="col-lg-6 position-relative" style="z-index: 10;" data-aos="fade-up" data-aos-delay="500">
            <div class="h-100 overflow-hidden rounded-4 shadow-sm border border-2 border-light">
        
              <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7411352312247!2d106.5545957!3d-6.1654111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ffc1c5043295%3A0x9dab02e9003ad4e7!2sPetshop%20Wisma%20Catshop%20%26%20Grooming!5e0!3m2!1sid!2sid!4v1778663739329!5m2!1sid!2sid" 
                width="100%" 
                height="100%" 
                style="border:0; min-height: 400px;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div><!-- End Google Maps -->

        </div>

      </div>

    </section>
    <!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        

        <div class="col-lg-4 col-md-6 footer-about">
          <a href="/" class="logo d-flex align-items-center">
            <span class="sitename">Wisma Catshop</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Pusat Kebutuhan & Perawatan Kucing</p>
            <p>Buka Setiap Hari: 08:00 AM - 09:00 PM</p>
            <p class="mt-3"><strong>Telepon/WA:</strong> <span>0877-7604-8999</span></p>
            <p><strong>Email:</strong> <span>wismacatshop@gmail.com</span></p>
          </div>

          <div class="social-links d-flex mt-4">
            <a href="https://wa.me/6287776048999" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            <a href="https://linktr.ee/wismacatshop" target="_blank" title="Linktree"><i class="bi bi-link-45deg"></i></a>
            <a href="https://maps.app.goo.gl/Ev7ahnVQCfdNyE8C8" target="_blank" title="Google Maps"><i class="bi bi-geo-alt"></i></a>
          </div>
        </div>

        <!-- Kolom 2: Tautan Menu -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Tautan Cepat</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#hero">Beranda</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Layanan & Produk</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#features">Keunggulan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#contact">Kontak</a></li>
          </ul>
        </div>

        <!-- Kolom 3: Layanan Toko -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Layanan Kami</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Grooming Sehat</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Grooming Kutu & Jamur</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Makanan Kering (Dry Food)</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Makanan Basah (Wet Food)</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Perlengkapan & Mainan</a></li>
          </ul>
        </div>


      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset("template") }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset("template") }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset("template") }}/assets/vendor/aos/aos.js"></script>
  <script src="{{ asset("template") }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset("template") }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{ asset("template") }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset("template") }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="{{ asset("template") }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="{{ asset("template") }}/assets/js/main.js"></script>

</body>

</html>