<aside>
  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; min-height: 100vh">
  <div class="d-flex align-items-center justify-content-start">
    <img src="public\assets\images\MyToToolLogo.png" alt="" class="w-25 me-3">
    <a href="index.php" class="text-white text-decoration-none me-2 fs-4">MyToTool
    </a>
  </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="<?= URL; ?>index" class="nav-link active" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Accueil
        </a>
      </li>
      <?php if (!isset($_SESSION['user'])) { ?>
        <li>
          <a href="index.php?page=login" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Connexion
          </a>
        </li>
      <?php } else { ?>
        <li>
          <a href="index.php?page=logout" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Deconnexion
          </a>
        </li>
      <?php } ?>
      <li>
      <button class="nav-link text-white" onclick="dark()">Dark mode</button>
      </li>
    </ul>
  </div>
</aside>