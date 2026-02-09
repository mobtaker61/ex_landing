<?php
require_once __DIR__ . '/includes/functions.php';

// Load tours and media data
$tours = getTours();
$media = getMedia();

// Get first 3 items for homepage
$featuredMedia = array_slice($media, 0, 3);
$featuredTours = array_slice($tours, 0, 3);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" itemscope itemtype="https://schema.org/Organization">
<head>
    <meta charset="UTF-8">
    <title>Special Exhibition Media Services | RoniPlus</title>
    
    <?php
    // SEO and Social Media Meta Tags
    $pageTitle = "Special Exhibition Media Services | RoniPlus";
    $pageDescription = "Professional 360° Virtual Tours and Media Packages for exhibitions, events, and businesses. Experience immersive virtual environments and high-quality media solutions in Dubai, UAE.";
    $pageImage = "assets/images/logo.png";
    $pageUrl = "index.php";
    $pageType = "website";
    $keywords = "virtual tour, 360 tour, media packages, exhibition services, virtual reality, Dubai, UAE, RoniPlus";
    include 'includes/meta-tags.php';
    ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-4">Special Exhibition Media Services</h1>
                    <p class="lead mb-0">
                        Professional 360° Virtual Tours and Media Packages for exhibitions, events, and businesses.
                        Experience immersive virtual environments and high-quality media solutions.
                    </p>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image">
                        <i class="bi bi-camera-reels display-1" style="color: #FF6600;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Media Packages Section -->
    <section id="media" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Media Packages Samples</h2>
                    <p class="section-subtitle">High-quality media solutions for your exhibitions</p>
                </div>
            </div>
            <div class="row g-4">
                <?php if (empty($featuredMedia)): ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No media packages available yet.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($featuredMedia as $item): ?>
                        <div class="col-md-4">
                            <a href="media-detail.php?id=<?php echo urlencode($item['id']); ?>" class="text-decoration-none">
                                <div class="card h-100 shadow-sm hover-shadow clickable-card">
                                    <div class="card-img-wrapper position-relative">
                                        <?php if ($item['thumbnail']): ?>
                                            <img src="<?php echo htmlspecialchars($item['thumbnail']); ?>" 
                                                 class="card-img-top" 
                                                 alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                 style="height: 250px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                                                 style="height: 250px;">
                                                <i class="bi bi-film display-4 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($item['type']) && $item['type'] === 'youtube'): ?>
                                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                                <i class="bi bi-youtube me-1"></i>YouTube
                                            </span>
                                        <?php endif; ?>
                                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                            <div class="play-overlay">
                                                <i class="bi bi-play-circle-fill display-4 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                        <p class="card-text text-muted">
                                            <?php if (isset($item['type']) && $item['type'] === 'youtube'): ?>
                                                YouTube Video
                                            <?php else: ?>
                                                Professional media package
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0">
                                        <span class="btn btn-primary w-100">
                                            View Details <i class="bi bi-arrow-right ms-2"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="media-list.php" class="btn btn-outline-primary btn-lg">
                        View All Media Packages <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Virtual Tours Section -->
    <section id="tours" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">360° Virtual Tours Samples</h2>
                    <p class="section-subtitle">Immersive virtual experiences for your spaces</p>
                </div>
            </div>
            <div class="row g-4">
                <?php if (empty($featuredTours)): ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No virtual tours available yet.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($featuredTours as $tour): ?>
                        <div class="col-md-4">
                            <a href="tour-view.php?id=<?php echo urlencode($tour['id']); ?>" class="text-decoration-none">
                                <div class="card h-100 shadow-sm hover-shadow clickable-card">
                                    <div class="card-img-wrapper position-relative">
                                        <?php if ($tour['thumbnail']): ?>
                                            <img src="<?php echo htmlspecialchars($tour['thumbnail']); ?>" 
                                                 class="card-img-top" 
                                                 alt="<?php echo htmlspecialchars($tour['name']); ?>"
                                                 style="height: 250px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="card-img-top bg-primary d-flex align-items-center justify-content-center" 
                                                 style="height: 250px;">
                                                <i class="bi bi-vr display-4 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                            <div class="play-overlay">
                                                <i class="bi bi-box-arrow-in-up-right display-4 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($tour['name']); ?></h5>
                                        <p class="card-text text-muted">360° Virtual Tour</p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0">
                                        <span class="btn btn-primary w-100">
                                            Explore Tour <i class="bi bi-arrow-right ms-2"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="tours-list.php" class="btn btn-outline-primary btn-lg">
                        View All Virtual Tours <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Our Packages</h2>
                    <p class="section-subtitle">Choose the perfect package for your needs</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- Package 1: Virtual Tour (Left) -->
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm text-center hover-shadow pricing-card">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-vr display-4" style="color: #000C7B;"></i>
                            </div>
                            <h3 class="card-title mb-3 fw-bold" style="color: #000C7B;">Virtual Tour</h3>
                            <div class="mb-3">
                                <span class="display-5 fw-bold" style="color: #FF6600;">1,000</span>
                                <span class="text-muted"> AED</span>
                            </div>
                            <p class="text-muted mb-3 small">4 Days Delivery</p>
                            <ul class="list-unstyled text-start mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>360° Photography</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Interactive Output</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Source Files Included</li>
                            </ul>
                            <a href="request.php?package=virtual-tour" class="btn btn-outline-primary w-100">Request</a>
                        </div>
                    </div>
                </div>
                
                <!-- Package 3: Golden Package (Center - Popular) -->
                <div class="col-md-4 col-lg-4">
                    <div class="card h-100 shadow-lg text-center border-3 position-relative hover-shadow pricing-card-popular" style="border-color: #FF6600 !important; transform: scale(1.05);">
                        <div class="position-absolute top-0 start-50 translate-middle">
                            <span class="badge px-4 py-2" style="background: linear-gradient(135deg, #FF6600, #E55A00); color: white; font-weight: 700;">Most Popular</span>
                        </div>
                        <div class="card-body p-5 mt-4">
                            <div class="mb-3">
                                <i class="bi bi-trophy-fill display-3" style="color: #FF6600;"></i>
                            </div>
                            <h3 class="card-title mb-3 fw-bold" style="color: #000C7B;">Golden Package</h3>
                            <div class="mb-3">
                                <span class="display-4 fw-bold" style="color: #FF6600;">2,500</span>
                                <span class="text-muted"> AED</span>
                            </div>
                            <p class="text-muted mb-3 small">Complete Solution</p>
                            <ul class="list-unstyled text-start mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Full Video Documentation</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>360° Virtual Tour</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Highlight Video (3 min)</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>1 Reel</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>10-20 Professional Photos</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Interview Recording</li>
                            </ul>
                            <a href="request.php?package=golden-package" class="btn btn-primary w-100">Request</a>
                        </div>
                    </div>
                </div>
                
                <!-- Package 2: Video Documentation (Right) -->
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm text-center hover-shadow pricing-card">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-camera-video display-4" style="color: #000C7B;"></i>
                            </div>
                            <h3 class="card-title mb-3 fw-bold" style="color: #000C7B;">Video Documentation</h3>
                            <div class="mb-3">
                                <span class="display-5 fw-bold" style="color: #FF6600;">2,000</span>
                                <span class="text-muted"> AED</span>
                            </div>
                            <p class="text-muted mb-3 small">48 Hours Delivery</p>
                            <ul class="list-unstyled text-start mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Full Booth Videography</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Interview Recording</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>Highlight Video (3 min)</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>1 Reel</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color: #FF6600;"></i>10-20 Professional Photos</li>
                            </ul>
                            <a href="request.php?package=video-documentation" class="btn btn-outline-primary w-100">Request</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p class="text-muted mb-3">Need a custom package? Contact us for personalized solutions</p>
                    <a href="#contact" class="btn btn-outline-primary">
                        <i class="bi bi-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title mb-4">About RoniPlus</h2>
                    <p class="lead mb-4">
                        RoniPlus is a leading provider of special exhibition media services, 
                        specializing in 360° virtual tours and professional media packages.
                    </p>
                    <p class="mb-4">
                        With years of experience in the industry, we help businesses and organizations 
                        showcase their spaces and events through cutting-edge virtual reality technology 
                        and high-quality media production.
                    </p>
                    <p class="mb-4">
                        Our team of experts is dedicated to delivering exceptional results that exceed 
                        expectations. We combine technical expertise with creative vision to create 
                        immersive experiences that engage and inspire.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#contact" class="btn btn-primary">Contact Us</a>
                        <a href="tours-list.php" class="btn btn-outline-primary">View Our Work</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-features">
                        <div class="feature-item mb-4 p-4">
                            <div class="d-flex align-items-start">
                                <div class="feature-icon me-3 flex-shrink-0">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Professional Quality</h5>
                                    <p class="text-muted mb-0">High-resolution 360° photography and professional video production</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-item mb-4 p-4">
                            <div class="d-flex align-items-start">
                                <div class="feature-icon me-3 flex-shrink-0">
                                    <i class="bi bi-gear-fill"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Custom Solutions</h5>
                                    <p class="text-muted mb-0">Tailored packages to meet your specific needs and budget</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-item mb-4 p-4">
                            <div class="d-flex align-items-start">
                                <div class="feature-icon me-3 flex-shrink-0">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Expert Support</h5>
                                    <p class="text-muted mb-0">Dedicated team providing ongoing support and assistance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>
