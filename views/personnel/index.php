<div id="entete">
    <div style="text-align: center;margin-bottom: 5px;">Fonction <?php echo $functions; ?></div>
</div>
<div class="titre">
    Gestion du Personnel
</div>
<form action="<?php echo Router::url("personnel", "saisie"); ?>" >
    <div class="page">

        <!-- div class="breadcrumb"><a href ="">Document</a><a  href ="">Document</a><a href ="">Document</a></div -->

        <?php
        if (!$personnels) {
            echo "Aucune donnée à afficher";
        } else {

            echo $personnels;
        }
        ?>
    </div>
    <div class="recapitulatif">
        <?php echo $total . " membres du personnel"; ?>
    </div>
    <div class="navigation">
        <img src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" onclick="document.forms[0].submit();" />
    </div>
</form>
<div class="status"></div>