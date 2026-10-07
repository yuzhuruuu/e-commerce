<!DOCTYPE html>
<html lang="en" class="ie_11_scroll">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="hhhwidth=device-width, initial-scale=1">
        <title>Database E-Commerce</title>
<!--
App Landing Template
http://www.templatemo.com/tm-474-app-landing
-->
        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/templatemo_style.css">
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="favicon.png" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        <!-- Top menu -->
        <div class="show-menu">
            <a href="#" class="shadow-top-down">+</a>
        </div>
        <nav class="main-menu shadow-top-down">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="index.php" class="scroll_effect">Home</a></li>
                <li><a href="src/pelanggan/customer_list.php" class="scroll_effect">Pelanggan</a></li>
                <li><a href="src/penjual/store_list.php" class="scroll_effect">Toko</a></li>
                <li><a href="src/produk/products_list.php" class="scroll_effect">Produk</a></li>
                <li><a href="src/detail_pesanan/list_pesanan.php">Pesanan</a></li>
            </ul>
        </nav>
        <!-- Features -->
        <section id="templatemo_features">
            <div class="container-fluid overflow-hidden">
                <header class="template_header">
                    <h1 class="text-center">
                         Database E-Commerce
                    </h1>
                </header>
                <div class="col-sm-12-flex">
                    <div onclick="location.href='src/pelanggan/customer_list.php';" class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner"> 
                            <div class="feature-box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" fill="currentColor" class="bi bi-person-fill apcb" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                            </div>
                            <p class="text-center nama">
                                <span class="nama">Tabel Pelanggan</span>
                            </p>
                        </div>
                    </div>
                    <div onclick="location.href='src/penjual/store_list.php';" class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" fill="currentColor" class="bi bi-cart-check-fill apcb" viewBox="0 0 16 16">
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                </svg>
                            </div>
                            <p>
                                <span class="nama">Tabel Toko</span>
                            </p>
                        </div>
                    </div>
                    <div onclick="location.href='src/produk/products_list.php';" class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" fill="currentColor" class="bi bi-box-seam-fill apcb" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                                </svg>
                            </div>
                            <p>
                                <span class="nama">Tabel Produk</span>
                            </p>
                        </div>
                    </div>
                    <div onclick="location.href='src/detail_pesanan/list_pesanan.php';" class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" fill="currentColor" class="bi bi-mailbox2 apcb" viewBox="0 0 16 16">
                                    <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9z"/>
                                    <path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4M8 7a3.99 3.99 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8zm-3.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157"/>
                                </svg>
                            </div>
                            <p>
                                <span class="nama">Tabel Pesanan</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- require plugins -->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.parallax.js"></script>
        <!-- template mo config script -->
        <script src="js/templatemo_scripts.js"></script>
    </body>
</html>