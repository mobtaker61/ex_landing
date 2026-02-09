<?php
require_once __DIR__ . '/includes/functions.php';

$tourId = $_GET['id'] ?? '';

if (empty($tourId)) {
    header('Location: tours-list.php');
    exit;
}

$tours = getTours();
$tour = null;

foreach ($tours as $t) {
    if ($t['id'] === $tourId) {
        $tour = $t;
        break;
    }
}

if (!$tour) {
    header('Location: tours-list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tour['name']); ?> - Virtual Tour | RoniPlus</title>
    
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
                <a href="tours-list.php" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Tours
                </a>
            </div>
        </div>
    </header>

    <!-- Tour Container -->
    <main class="tour-container">
        <div class="loading-overlay" id="loadingOverlay">
            <div class="text-center text-white">
                <div class="spinner-border mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Loading virtual tour...</p>
            </div>
        </div>
        <iframe 
            id="tourFrame" 
            src="<?php echo htmlspecialchars($tour['path']); ?>" 
            frameborder="0" 
            allowfullscreen
            style="width: 100%; height: calc(100vh - 80px); border: none; display: none;">
        </iframe>
    </main>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const iframe = document.getElementById('tourFrame');
        const loadingOverlay = document.getElementById('loadingOverlay');
        
        iframe.onload = function() {
            loadingOverlay.style.display = 'none';
            iframe.style.display = 'block';
        };
        
        // Show iframe after a short delay even if onload doesn't fire
        setTimeout(function() {
            loadingOverlay.style.display = 'none';
            iframe.style.display = 'block';
        }, 3000);
    </script>
</body>
</html>
