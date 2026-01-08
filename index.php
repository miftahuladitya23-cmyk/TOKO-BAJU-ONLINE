<?php
session_start();
require_once 'config/database.php';

// Ambil 8 produk terbaru
$query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 8";
$products = mysqli_query($conn, $query);

// Hitung total produk
$total_products = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM products"))[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Baju Online - Fashion Terbaru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, #1a2530 100%) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .hero-section {
            background: linear-gradient(rgba(44, 62, 80, 0.9), rgba(52, 152, 219, 0.8)), 
                        url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            border-radius: 20px;
            margin: 30px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 25px;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .product-image {
            height: 250px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .category-badge {
            display: inline-block;
            padding: 5px 15px;
            background: #e3f2fd;
            color: var(--secondary);
            border-radius: 20px;
            font-size: 12px;
            margin: 5px;
            transition: all 0.3s;
        }
        
        .category-badge:hover {
            background: var(--secondary);
            color: white;
            text-decoration: none;
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-icon {
            font-size: 40px;
            color: var(--secondary);
            margin-bottom: 15px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary) 0%, #2980b9 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #219653 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .footer {
            background: var(--primary);
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
        }
        
        .social-icons a {
            color: white;
            font-size: 20px;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            color: var(--secondary);
            transform: translateY(-3px);
        }
        
        .feature-icon {
            font-size: 30px;
            color: var(--secondary);
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-tshirt me-2"></i>
                <strong>TokoBaju</strong>Online
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk/index.php">
                            <i class="fas fa-store me-1"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk/index.php?kategori=Kaos">
                            <i class="fas fa-tshirt me-1"></i> Kaos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk/index.php?kategori=Kemeja">
                            <i class="fas fa-user-tie me-1"></i> Kemeja
                        </a>
                    </li>
                    <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="keranjang/index.php">
                            <i class="fas fa-shopping-cart me-1"></i> Keranjang
                            <?php 
                            $user_id = $_SESSION['user_id'];
                            $count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM cart WHERE user_id = $user_id");
                            $count = mysqli_fetch_assoc($count_query)['total'];
                            if($count > 0): ?>
                                <span class="badge bg-danger"><?php echo $count; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="admin/index.php">
                                <i class="fas fa-crown me-1"></i> Admin Panel
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="auth/profile.php">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="auth/logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-light me-2" href="auth/login.php">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="auth/register.php">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <!-- Pesan Success/Error -->
        <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <!-- Hero Section -->
        <div class="hero-section text-center">
            <h1 class="display-4 fw-bold mb-3">Fashion Terbaru 2024</h1>
            <p class="lead mb-4">Temukan koleksi baju terbaru dengan kualitas premium dan harga terjangkau</p>
            <a href="produk/index.php" class="btn btn-light btn-lg px-5">
                <i class="fas fa-shopping-bag me-2"></i> Belanja Sekarang
            </a>
        </div>
        
        <!-- Statistik -->
        <div class="row mt-5 mb-5">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3><?php echo $total_products; ?>+</h3>
                    <p class="text-muted">Produk Tersedia</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>Gratis</h3>
                    <p class="text-muted">Pengiriman</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7</h3>
                    <p class="text-muted">Customer Support</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h3>30 Hari</h3>
                    <p class="text-muted">Garansi Pengembalian</p>
                </div>
            </div>
        </div>
        
        <!-- Kategori -->
        <div class="text-center mb-5">
            <h2 class="mb-4">📁 Kategori Populer</h2>
            <div>
                <a href="produk/index.php?kategori=Kaos" class="category-badge">👕 Kaos</a>
                <a href="produk/index.php?kategori=Kemeja" class="category-badge">👔 Kemeja</a>
                <a href="produk/index.php?kategori=Celana" class="category-badge">👖 Celana</a>
                <a href="produk/index.php?kategori=Jaket" class="category-badge">🧥 Jaket</a>
                <a href="produk/index.php?kategori=Baju Muslim" class="category-badge">🕌 Baju Muslim</a>
                <a href="produk/index.php?kategori=Aksesoris" class="category-badge">💍 Aksesoris</a>
            </div>
        </div>
        
        <!-- Produk Terbaru -->
        <h2 class="text-center mb-4">🔥 Produk Terbaru</h2>
        <div class="row">
            <?php while($product = mysqli_fetch_assoc($products)): ?>
            <div class="col-md-3">
                <div class="product-card">
                    <div style="position: relative; overflow: hidden;">
                        <img src="images/<?php echo htmlspecialchars($product['gambar']); ?>" 
                             class="product-image" 
                             alt="<?php echo htmlspecialchars($product['nama']); ?>"
                             onerror="this.src='images/default.jpg'">
                        
                        <?php if($product['stok'] < 10 && $product['stok'] > 0): ?>
                            <div class="product-badge">Stok Terbatas</div>
                        <?php elseif($product['stok'] == 0): ?>
                            <div class="product-badge" style="background: #7f8c8d;">Habis</div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-3">
                        <h5 class="card-title mb-2" style="height: 50px; overflow: hidden;">
                            <?php echo htmlspecialchars($product['nama']); ?>
                        </h5>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="text-primary mb-0"><?php echo rupiah($product['harga']); ?></h4>
                            <span class="badge bg-info"><?php echo $product['kategori']; ?></span>
                        </div>
                        
                        <p class="text-muted small mb-3" style="height: 40px; overflow: hidden;">
                            <?php echo substr(htmlspecialchars($product['deskripsi']), 0, 60); ?>...
                        </p>
                        
                        <div class="d-grid gap-2">
                            <a href="produk/detail.php?id=<?php echo $product['id']; ?>" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                            
                            <?php if(isset($_SESSION['user_id']) && $product['stok'] > 0): ?>
                            <form action="keranjang/tambah.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-cart-plus me-1"></i> + Keranjang
                                </button>
                            </form>
                            <?php elseif(!isset($_SESSION['user_id'])): ?>
                            <a href="auth/login.php" class="btn btn-secondary w-100">
                                <i class="fas fa-lock me-1"></i> Login untuk Beli
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <!-- CTA Section -->
        <div class="text-center mt-5 mb-5">
            <div class="p-5 rounded" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h2 class="mb-3">Ingin Lihat Lebih Banyak?</h2>
                <p class="lead mb-4">Kami memiliki <?php echo $total_products; ?>+ produk siap dikirim ke Anda!</p>
                <a href="produk/index.php" class="btn btn-light btn-lg px-5">
                    <i class="fas fa-store me-2"></i> Lihat Semua Produk
                </a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4><i class="fas fa-tshirt me-2"></i> TokoBajuOnline</h4>
                    <p>Menjual berbagai macam baju dengan kualitas terbaik dan harga terjangkau. Fashion untuk semua kalangan.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-light text-decoration-none">Beranda</a></li>
                        <li><a href="produk/index.php" class="text-light text-decoration-none">Semua Produk</a></li>
                        <li><a href="auth/login.php" class="text-light text-decoration-none">Login</a></li>
                        <li><a href="auth/register.php" class="text-light text-decoration-none">Register</a></li>
                        <li><a href="keranjang/index.php" class="text-light text-decoration-none">Keranjang</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Kontak Kami</h5>
                    <p><i class="fas fa-envelope me-2"></i> info@tokobajuku.com</p>
                    <p><i class="fas fa-phone me-2"></i> 0812-3456-7890</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Fashion No. 123, Jakarta</p>
                    <p><i class="fas fa-clock me-2"></i> Buka: 08:00 - 21:00</p>
                </div>
            </div>
            
            <hr class="bg-light">
            
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">© 2024 TokoBajuOnline. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0">Made with <i class="fas fa-heart text-danger"></i> for fashion lovers</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animasi untuk product cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.product-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>