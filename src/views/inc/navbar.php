<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo APPNAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] =='/') {echo 'active';} ?>" href="<?php echo URLROOT; ?>"><i class="bi bi-house me-1"></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/pages/about') {echo 'active';} ?>" href="<?php echo URLROOT; ?>/pages/about"><i class="bi bi-question-circle me-1"></i>About</a>
        </li>
        <?php if(isset($_SESSION['user_id'])) : ?>
        <li class="nav-item">
          <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] =='/bookings') {echo 'active';} ?>" href="<?php echo URLROOT; ?>/bookings"><i class="bi bi-pencil-square me-1"></i>Bookings</a>
        </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto">
      <?php if(isset($_SESSION['user_id'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Logged in as <?php echo $_SESSION['user_name']; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] =='/users/register') {echo 'active';} ?>" href="<?php echo URLROOT; ?>/users/register"><i class="bi bi-person-add me-1"></i>Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] =='/users/login') {echo 'active';} ?>" href="<?php echo URLROOT; ?>/users/login"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
        </li>
      <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>