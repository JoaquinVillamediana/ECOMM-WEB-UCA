<header>
    <div class="container">
        <div class="imgs">
            <img src="./assets/img/logo.png" alt="" class="logo">
            <img src="assets/svg/bars-solid.svg" width="25" class="bars" onclick="toggleHamburguesa()">
        </div>
        <div class="links">
            <a href="index.php" class="link">Home</a>
            <a href="search.php" class="link">Buscador</a>
            <?php if (!empty($_SESSION['user'])) { ?>
                <a href="carrito.php" class="link">Carrito</a>
                <a href="mispedidos.php" class="link">Mis Pedidos</a>
                <a href="logout.php" class="link logout">Salir</a>
            <?php } else { ?>
                <a href="login.php" class="link logout">Ingresar</a>
            <?php } ?>
        </div>
    </div>
</header>