<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>LisenValley</title>
  <link rel="icon" href="../images/NewVibe_logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <script type="text/javascript">
 function form_submit() {
     document.getElementById('formulaire').classList.add("slide_back");
     setTimeout(function () {
       document.getElementById('formulaire').hidden=true;
     },1500);
 }
 </script>
</head>

<body style="background-color:#DDD;">
  <div style="width=400px;" class="container text-center slide" id='formulaire'>

    <img src="../images/logo+slogan.png" style="margin:auto;margin-right:10px;" width="300" height="300" alt="">
    <form onsubmit="form_submit();" action="../fonctions_php/validation.php" class="form text-center d-flex flex-column" style="margin: 0 auto;" method="POST">

      <div class="form-group">
        <label for="id">IDENTIFIANT</label>
        <input style="width:300px; margin: 0 auto;" type="text"  class="form-control center-block" id="id" placeholder="Entrez votre Identifiant" name="id" autocomplete="off" required>
      </div>

      <div  class="form-group">
        <label for="password">MOT DE PASSE</label>
        <input  type="password" style="width:300px; margin: 0 auto;"  class="form-control" id="pwd" placeholder="Entrez votre mot de passe" name="password" autocomplete="off" required>
      </div>
      <br>
      <?php
      if (isset($_GET['erreur'])) {
        $err = $_GET['erreur'];
        if ($err == 1 || $err == 2)
          echo "<p style='color:green'>Utilisateur ou mot de passe incorrect</p>";
      }
      ?>
      <button type="submit" style="width:130px;margin: 0 auto;" class="btn btn-success">CONNEXION</button>
    </form>



  </div>

</body>

</html>
