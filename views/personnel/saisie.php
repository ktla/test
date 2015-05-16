<div id="entete">

</div>

<div class="titre">
    Saisie d'un nouvel Personnel
</div>
<form action="<?php echo url("personnel", "saisie"); ?>" method="post" id="form-saisi-pers">
    <div class="page">
        <fieldset><legend> Identit&eacute;</legend>
            <span class="text">
                <label>Civilit&eacute;</label>
                <?php echo $civilite; ?>
            </span>
            <span class="text" style="width: 180px;">
                <label> Nom </label>
                <input type="text" name="nom" maxlength="30"  />
            </span>
            <span class="text">
                <label> Pr&eacute;nom</label>
                <input type="text" name="prenom" maxlength="30" />
            </span>
            <span class="text">
                <label>Autre noms</label>
                <input type="text" name="autrenom" maxlength="30" />
            </span>
            <span class="text">
                <label>Fonction</label>
                <?php echo $functions; ?>
            </span>
            <span class="text" style=" width: 356px;">
                <label>Grade</label>
                <input type="text" class="grade" name="grade" maxlength="15" />
            </span>
            <span class="date" style="position: relative;float: left;top: 13px;margin-bottom: 10px;">
                <label>Date de naissance</label>
                <div id="date"></div>
                <input type="hidden" id="datenaiss" name="datenaiss" value="" />
            </span>
            <span class="text" style="width: 142px; margin-right: 28px;">
                <label>T&eacute;l&eacute;phone</label>
                <input type="text" name="telephone" maxlength="15"/>
            </span>
            <span class="text" style="">
                <label>Portable</label>
                <input type="text" name="portable" maxlength="15" />
            </span>
        </fieldset>
    </div>

    <div class="recapitulatif">
        <?php
            
        if ($errors) {
            echo "<div class='error'>$message</div>";
        }
        ?>
        
    </div>
    <div class="navigation">
        <?php echo btn_ok("document.forms[0].submit()"); ?>
        <?php echo btn_cancel("document.location=\"" . Router::url("personnel") . "\""); ?>
    </div>

</form>
<div class="status"></div>
