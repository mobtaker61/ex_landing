<?php
require_once __DIR__ . '/includes/functions.php';

$mediaId = $_GET['id'] ?? '';

if (empty($mediaId)) {
    header('Location: media-list.php');
    exit;
}

$media = getMedia();
$mediaItem = null;

foreach ($media as $item) {
    if ($item['id'] === $mediaId) {
        $mediaItem = $item;
        break;
    }
}

if (!$mediaItem) {
    header('Location: media-list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($mediaItem['name']); ?> - Media Package | RoniPlus</title>
    
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
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/images/logo.png" alt="RoniPlus" height="40" class="me-2" onerror="this.style.display='none'">
            </a>
            <div class="ms-auto">
                <a href="media-list.php" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Media
                </a>
            </div>
        </div>
    </header>

    <!-- Media Player Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white mb-4"><?php echo htmlspecialchars($mediaItem['name']); ?></h2>
                    <div class="video-wrapper bg-black rounded">
                        <?php if (isset($mediaItem['type']) && $mediaItem['type'] === 'youtube'): ?>
                            <!-- YouTube Embed -->
                            <div class="ratio ratio-16x9" style="max-height: 70vh;">
                                <iframe 
                                    src="https://www.youtube.com/embed/<?php echo htmlspecialchars($mediaItem['youtube_id']); ?>?rel=0&modestbranding=1" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                    class="w-100 h-100">
                                </iframe>
                            </div>
                        <?php else: ?>
                            <!-- Local Video File -->
                            <video 
                                controls 
                                class="w-100" 
                                style="max-height: 70vh;"
                                poster="<?php echo isset($mediaItem['thumbnail']) && $mediaItem['thumbnail'] ? htmlspecialchars($mediaItem['thumbnail']) : ''; ?>">
                                <source src="<?php echo htmlspecialchars($mediaItem['video']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($mediaItem['type']) && $mediaItem['type'] === 'youtube' && isset($mediaItem['youtube_url'])): ?>
                        <div class="mt-3 text-center">
                            <a href="<?php echo htmlspecialchars($mediaItem['youtube_url']); ?>" 
                               target="_blank" 
                               class="btn btn-danger">
                                <i class="bi bi-youtube me-2"></i>Watch on YouTube
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
