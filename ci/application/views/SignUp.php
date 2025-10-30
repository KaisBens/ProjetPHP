<form method="post" action="<?php echo base_url('index.php/Enregistrer/SignUp'); ?>">
    <input type="text" name="pseudo" placeholder="Pseudo" required>
    <input type="email" name="login" placeholder="Adresse mail" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Submit</button>
</form>