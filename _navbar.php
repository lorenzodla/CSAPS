<nav class="navbar navbar-light navbar-expand-md shadow-sm navigation-clean-button">
  <div class="container"><a class="navbar-brand" href="http://csaps.alphaduck.software" style="height: 100px;"><img src="assetsIndex/img/Imagen1.png" width="125"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navcol-1">
      <ul class="nav navbar-nav mr-auto">
        <li class="nav-item" role="presentation"><a class="nav-link" href="http://csaps.alphaduck.software">Inicio</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" href="/#About">Sobre nosotros</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" href="faq.php">FAQ</a></li>
      </ul>
      <span class="navbar-text actions">

        <?php if (isset($_SESSION['user'])) { ?>

          <div class="dropdown">
            <button style="background: rgb(16,53,103);" class="btn  btn-light action-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['user']['nombre'];
                ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="perfil.php">Perfil <?php echo $_SESSION['user']['categoryName']; ?></a>
              <?php if ($esGestor) { ?> <a class="dropdown-item" href="principal_gestor.php">Panel de Gestión</a> <?php } ?>
              <a class="dropdown-item" href="correo.php">Correo</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php" style="color: red;">Logout</a>
            </div>
          </div>

        <?php } else { ?>
          <a style="background: rgb(16,53,103);" class="btn btn-light action-button" role="button" href="login.php">Iniciar sesión</a>
        <?php } ?>

      </span>
    </div>
  </div>
</nav>