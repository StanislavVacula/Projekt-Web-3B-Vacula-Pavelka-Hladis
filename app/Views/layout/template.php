<html>
    <head> 
        <title>Home</title>
        <?= $this->include("layout/assets");?> 
    </head> 
    <body>
        <?= $this->include("layout/navbar");?>
        <!--Dynamický obsah -->
        <div class="container"> 
        <?= $this->renderSection("content"); ?>
        </div>
     <body>
</html>