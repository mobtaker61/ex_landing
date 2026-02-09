<?php
require_once __DIR__ . '/includes/functions.php';
$media = getMedia();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Packages | RoniPlus</title>
    
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

    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Media Packages Samples</h1>
                    <p class="lead">Explore our collection of professional media packages</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Media Grid -->
    <section class="py-5">
        <div class="container">
            <?php if (empty($media)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-film display-1 text-muted mb-3"></i>
                    <h3 class="mb-3">No Media Packages Available</h3>
                    <p class="text-muted">Media packages will appear here once they are uploaded.</p>
                    <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($media as $item): ?>
                        <div class="col-md-4 col-lg-3">
                            <a href="media-detail.php?id=<?php echo urlencode($item['id']); ?>" class="text-decoration-none">
                                <div class="card h-100 shadow-sm hover-shadow clickable-card">
                                    <div class="card-img-wrapper position-relative">
                                        <?php if ($item['thumbnail']): ?>
                                            <img src="<?php echo htmlspecialchars($item['thumbnail']); ?>" 
                                                 class="card-img-top" 
                                                 alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                 style="height: 200px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
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
                                        <p class="card-text text-muted small">
                                            <?php if (isset($item['type']) && $item['type'] === 'youtube'): ?>
                                                YouTube Video
                                            <?php else: ?>
                                                Media Package
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0">
                                        <span class="btn btn-primary w-100 btn-sm">
                                            View Details <i class="bi bi-arrow-right ms-2"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
