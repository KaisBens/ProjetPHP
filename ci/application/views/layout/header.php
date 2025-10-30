<!doctype html>
<html lang="en" class="has-navbar-fixed-top">
	<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style.css'); ?>">
		<meta charset="UTF-8" />
		<title>Sing Up</title>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
/>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <?php=link_tag('assets/style.css')?>
	</head>
	<body>
		<main class='container'>
			<nav>
  <ul>
    <li><strong>Sing Up</strong></li>
  </ul>
  <ul>
  <li><?=anchor('albums','Albums');?></li>
  <li><?=anchor('artistes','Artistes');?></li>
  <?php if ($this->session->userdata('logged')): ?>
  <li><?=anchor('playlist','Playlist');?></li>
  <li><?=anchor('Deconnexion', 'Log Out');?></li>
<?php else: ?>
  <li><?=anchor('Connexion','Login');?></li>
  <li><?=anchor('Enregistrer','SignUp');?></li>
<?php endif ?>
  </ul>
</nav>