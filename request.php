<?php
require_once __DIR__ . '/includes/functions.php';

// Get package type from URL
$packageType = $_GET['package'] ?? '';

// Valid package types
$validPackages = [
    'virtual-tour' => 'Virtual Tour',
    'video-documentation' => 'Video Documentation',
    'golden-package' => 'Golden Package'
];

$selectedPackage = '';
if ($packageType && isset($validPackages[$packageType])) {
    $selectedPackage = $validPackages[$packageType];
}

// Load exhibitions list
$exhibitionsFile = __DIR__ . '/exhibitions.txt';
$exhibitions = [];
if (file_exists($exhibitionsFile)) {
    $exhibitions = array_filter(array_map('trim', file($exhibitionsFile)));
    $exhibitions = array_values($exhibitions); // Re-index array
}

// Handle form submission
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $exhibition = trim($_POST['exhibition'] ?? '');
    $boothNumber = trim($_POST['booth_number'] ?? '');
    $package = trim($_POST['package'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validation
    if (empty($firstName) || empty($lastName) || empty($phone) || empty($email) || empty($exhibition) || empty($package)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Send emails
        $adminEmail = 'media@roniplus.ae'; // Update with your email
        $subject = 'New Service Request - ' . $package;
        
        // Email to admin
        $adminMessage = "New Service Request Received\n\n";
        $adminMessage .= "Name: $firstName $lastName\n";
        $adminMessage .= "Phone: $phone\n";
        $adminMessage .= "Email: $email\n";
        $adminMessage .= "Exhibition: $exhibition\n";
        $adminMessage .= "Booth Number: " . ($boothNumber ? $boothNumber : 'Not provided') . "\n";
        $adminMessage .= "Package: $package\n";
        if ($message) {
            $adminMessage .= "Additional Message: $message\n";
        }
        $adminMessage .= "\nDate: " . date('Y-m-d H:i:s') . "\n";
        
        $adminHeaders = "From: noreply@roniplus.ae\r\n";
        $adminHeaders .= "Reply-To: $email\r\n";
        $adminHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Email to customer
        $customerSubject = 'Thank you for your request - RoniPlus';
        $customerMessage = "Dear $firstName $lastName,\n\n";
        $customerMessage .= "Thank you for your interest in our $package service.\n\n";
        $customerMessage .= "We have received your request for:\n";
        $customerMessage .= "- Exhibition: $exhibition\n";
        if ($boothNumber) {
            $customerMessage .= "- Booth Number: $boothNumber\n";
        }
        $customerMessage .= "- Package: $package\n\n";
        $customerMessage .= "Our team will contact you shortly to discuss your requirements.\n\n";
        $customerMessage .= "Best regards,\n";
        $customerMessage .= "RoniPlus Team\n";
        $customerMessage .= "Phone: +971 52 229 9108\n";
        $customerMessage .= "Email: media@roniplus.ae\n";
        
        $customerHeaders = "From: RoniPlus <noreply@roniplus.ae>\r\n";
        $customerHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Send emails
        $adminSent = mail($adminEmail, $subject, $adminMessage, $adminHeaders);
        $customerSent = mail($email, $customerSubject, $customerMessage, $customerHeaders);
        
        if ($adminSent || $customerSent) {
            $success = true;
        } else {
            $error = 'There was an error sending your request. Please try again or contact us directly.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" itemscope itemtype="https://schema.org/ContactPage">
<head>
    <meta charset="UTF-8">
    <title>Request Service | RoniPlus</title>
    
    <?php
    // SEO and Social Media Meta Tags
    $pageTitle = "Request Service | RoniPlus";
    $pageDescription = "Request our professional exhibition media services. Fill out the form to get started with your virtual tour or media package.";
    $pageImage = "assets/images/logo.png";
    $pageUrl = "request.php" . ($packageType ? "?package=" . urlencode($packageType) : "");
    $pageType = "website";
    $keywords = "request service, virtual tour request, media package request, exhibition services, RoniPlus";
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

    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Request Service</h1>
                    <p class="lead">Fill out the form below and we'll get back to you soon</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Request Form -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <strong>Thank you!</strong> Your request has been submitted successfully. We will contact you shortly.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-primary">Back to Home</a>
                        </div>
                    <?php else: ?>
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?php echo htmlspecialchars($error); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <div class="card shadow-lg">
                            <div class="card-body p-5">
                                <h2 class="card-title mb-4 text-center" style="color: #000C7B;">Service Request Form</h2>
                                
                                <form method="POST" action="" id="requestForm">
                                    <div class="row g-3">
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <label for="first_name" class="form-label fw-bold">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" required 
                                                   value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
                                        </div>
                                        
                                        <!-- Last Name -->
                                        <div class="col-md-6">
                                            <label for="last_name" class="form-label fw-bold">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" required
                                                   value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">
                                        </div>
                                        
                                        <!-- Phone -->
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="phone" name="phone" required
                                                   placeholder="+971 XX XXX XXXX"
                                                   value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                                        </div>
                                        
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" required
                                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                        </div>
                                        
                                        <!-- Exhibition -->
                                        <div class="col-md-6">
                                            <label for="exhibition" class="form-label fw-bold">Exhibition <span class="text-danger">*</span></label>
                                            <select class="form-select" id="exhibition" name="exhibition" required>
                                                <option value="">Select Exhibition</option>
                                                <?php foreach ($exhibitions as $exh): ?>
                                                    <option value="<?php echo htmlspecialchars($exh); ?>" 
                                                            <?php echo (isset($_POST['exhibition']) && $_POST['exhibition'] === $exh) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($exh); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <!-- Booth Number -->
                                        <div class="col-md-6">
                                            <label for="booth_number" class="form-label fw-bold">Booth Number <span class="text-muted">(Optional)</span></label>
                                            <input type="text" class="form-control" id="booth_number" name="booth_number"
                                                   placeholder="e.g., A-123"
                                                   value="<?php echo htmlspecialchars($_POST['booth_number'] ?? ''); ?>">
                                        </div>
                                        
                                        <!-- Package Type -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Package Type <span class="text-danger">*</span></label>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="form-check p-3 border rounded <?php echo ($selectedPackage === 'Virtual Tour' || (isset($_POST['package']) && $_POST['package'] === 'Virtual Tour')) ? 'border-primary' : ''; ?>">
                                                        <input class="form-check-input" type="radio" name="package" id="package_virtual" 
                                                               value="Virtual Tour" required
                                                               <?php echo ($selectedPackage === 'Virtual Tour' || (isset($_POST['package']) && $_POST['package'] === 'Virtual Tour')) ? 'checked' : ''; ?>>
                                                        <label class="form-check-label w-100" for="package_virtual">
                                                            <i class="bi bi-vr display-6 d-block mb-2" style="color: #000C7B;"></i>
                                                            <strong>Virtual Tour</strong>
                                                            <br><small class="text-muted">1,000 AED</small>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check p-3 border rounded <?php echo ($selectedPackage === 'Golden Package' || (isset($_POST['package']) && $_POST['package'] === 'Golden Package')) ? 'border-primary' : ''; ?>">
                                                        <input class="form-check-input" type="radio" name="package" id="package_golden" 
                                                               value="Golden Package"
                                                               <?php echo ($selectedPackage === 'Golden Package' || (isset($_POST['package']) && $_POST['package'] === 'Golden Package')) ? 'checked' : ''; ?>>
                                                        <label class="form-check-label w-100" for="package_golden">
                                                            <i class="bi bi-trophy-fill display-6 d-block mb-2" style="color: #FF6600;"></i>
                                                            <strong>Golden Package</strong>
                                                            <br><small class="text-muted">2,500 AED</small>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check p-3 border rounded <?php echo ($selectedPackage === 'Video Documentation' || (isset($_POST['package']) && $_POST['package'] === 'Video Documentation')) ? 'border-primary' : ''; ?>">
                                                        <input class="form-check-input" type="radio" name="package" id="package_video" 
                                                               value="Video Documentation"
                                                               <?php echo ($selectedPackage === 'Video Documentation' || (isset($_POST['package']) && $_POST['package'] === 'Video Documentation')) ? 'checked' : ''; ?>>
                                                        <label class="form-check-label w-100" for="package_video">
                                                            <i class="bi bi-camera-video display-6 d-block mb-2" style="color: #000C7B;"></i>
                                                            <strong>Video Documentation</strong>
                                                            <br><small class="text-muted">2,000 AED</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Additional Message -->
                                        <div class="col-12">
                                            <label for="message" class="form-label fw-bold">Additional Message <span class="text-muted">(Optional)</span></label>
                                            <textarea class="form-control" id="message" name="message" rows="4" 
                                                      placeholder="Any additional information or special requirements..."><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                                        </div>
                                        
                                        <!-- Submit Button -->
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                                <i class="bi bi-send-fill me-2"></i>Submit Request
                                            </button>
                                        </div>
                                        
                                        <div class="col-12 text-center mt-3">
                                            <small class="text-muted">
                                                <i class="bi bi-info-circle me-1"></i>
                                                By submitting this form, you agree to be contacted by RoniPlus regarding your request.
                                            </small>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Home
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
    <script src="assets/js/main.js"></script>
    <script>
        // Auto-select package if coming from pricing section
        const urlParams = new URLSearchParams(window.location.search);
        const packageParam = urlParams.get('package');
        
        if (packageParam) {
            const packageMap = {
                'virtual-tour': 'package_virtual',
                'golden-package': 'package_golden',
                'video-documentation': 'package_video'
            };
            
            const radioId = packageMap[packageParam];
            if (radioId) {
                document.getElementById(radioId).checked = true;
                document.getElementById(radioId).closest('.form-check').classList.add('border-primary');
            }
        }
        
        // Highlight selected package
        document.querySelectorAll('input[name="package"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.form-check').forEach(check => {
                    check.classList.remove('border-primary');
                });
                this.closest('.form-check').classList.add('border-primary');
            });
        });
    </script>
</body>
</html>
