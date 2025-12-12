
<?php include "../base/headerLogueado.php";  
include "controladorCargarInfo.php" ;

foreach ($list as $rancho){
?>


 <div class="container-rancho-registrado">

        <div class="fotografia">
            <svg class="icon-plus" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="45" fill="none" stroke-linecap="round" />
            </svg>
        </div>

        <div class="message-box">
            <p><?php echo ($rancho["nombre"]); ?></p>
                <a href="../rancho/editar_rancho.php?rancho=<?php echo $rancho ["id_rancho"]?>"><button class="btn-ver-mas">Ver mas</button></a>
        </div>
    </div>


<?php }
include "../base/footer.php" 
?>

