<footer>
    <p class="company">E-Commerce © 2021</p>
    <a class="link" href="index.php">Home</a>
    <?php
        if(empty($_SESSION["user"])){
    ?>
        <a class="link" href="register.php">Registro</a>
    <?php
        }else{
            ?>
        <a class="link" href="carrito.php">Carrito</a>
    <?php } ?>
    <a class="link" href="search.php">Buscar Producto</a>
</footer>