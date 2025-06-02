<?php
$imagesDir = 'images/';
if (!is_dir($imagesDir)) {
    mkdir($imagesDir, 0755, true);
}

// Get image files
$images = array_filter(scandir($imagesDir), function($file) {
    return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']);
});
$images = array_reverse($images);

// Pagination setup
$perPage = 6;
$totalImages = count($images);
$totalPages = ceil($totalImages / $perPage);
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$start = ($page - 1) * $perPage;
$currentImages = array_slice($images, $start, $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Photo Album</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">

    <!-- Column 1: First 3 Images -->
    <div class="img-col-one">
      <?php for ($i = 0; $i < 3 && $i < count($currentImages); $i++): ?>
        <div class="con-img">
          <img class="album-img" src="images/<?php echo htmlspecialchars($currentImages[$i]); ?>" alt="Image">
        </div>
      <?php endfor; ?>
    </div>

    <!-- Column 2: Upload + Pagination -->
    <div class="img-col-two">
      <form id="uploadForm" enctype="multipart/form-data" method="POST">
        <input type="file" name="image" accept=".jpg,.jpeg,.png" required />
        <button type="submit">Upload</button>
      </form>
      <div class="controls">
        <?php if ($page > 1): ?>
          <a href="?page=<?php echo $page - 1; ?>" id="prevBtn">Previous</a>
        <?php endif; ?>
        <?php if ($page < $totalPages): ?>
          <a href="?page=<?php echo $page + 1; ?>" id="nextBtn">Next</a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Column 3: Next 3 Images -->
    <div class="img-col-three">
      <?php for ($i = 3; $i < 6 && $i < count($currentImages); $i++): ?>
        <div class="con-img">
          <img class="album-img" src="images/<?php echo htmlspecialchars($currentImages[$i]); ?>" alt="Image">
        </div>
      <?php endfor; ?>
    </div>

  </div>
  <script src="script.js"></script>
</body>
</html>
