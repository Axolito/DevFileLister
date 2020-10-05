<?php
/*
 * DevFileLister
 * Un listeur de fichiers pour les développeurs web
 *
 * https://github.com/Axolito/DevFileLister/
 *
 * (c) 2020 Axolito - https://github.com/Axolito
 *
 * licence GNU AGPL v3.0
 * [fr] https://www.gnu.org/licenses/agpl-3.0.html
 * [fr] https://www.gnu.org/licenses/agpl-3.0.fr.html
 */
?>






<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="icoSystem/styleAccueil.css" />

		<title>Accueil</title>
	</head>
	<body>

		<?php

			//Lecture de l'URL pour définir le dossier à analyser
			if (empty($_GET["dir"])) {
				$liste_rep = scandir("./");
				$curent_dir = "";


				//Afficher "dossier racine" si on se trouve a la racine
				echo "<h1>Dosier racine</h1>";
			}

			// Détection d'un "../" afin d'éviter l'exploration des dossiers systeme
			elseif (!(strpbrk ('..',$_GET["dir"]) == FALSE)) {
				header("Location: ./");
				exit;
			}

			else {		//Sinon afficher le dossier courant
				$liste_rep = scandir("./".$_GET["dir"]);
				$curent_dir = $_GET["dir"] . "/";
				echo "<a href='./'><img src='icoSystem/home.png' class='iconeHome'></a>";
				echo "<h1>Racine/".$curent_dir."</h1>";
			}

		?>

		<div class="autoOrganisation">


			<?php





				if (count($liste_rep) == 2) {		//Affiche "le dossier est vide" si le dossier est vide
					echo "<h2>Le dossier est vide</h2>";
				}






				for ($i=2; $i < count($liste_rep); $i++) {		//boucle pour afficher tous les éléments du tableau $liste_rep sous forme de tuile
					//la boucle commense avec $i = 2 pour eviter les 2 premiers fichiers "." et ".."



					//Exclusion du dossier des icones afin de cacher celui-ci
					if ($liste_rep[$i] == "icoSystem") {
						//ne rien afficher
					}


					else {		//Si pas une icone, alors afficher la bonne icone


						if (is_dir ($curent_dir.$liste_rep[$i])) {		//Si le fichier est un dossier, on adapte le lien vers celui ci
							echo "<div class='tuile'><a class='lienTuile' href='./?dir=".$curent_dir.$liste_rep[$i]."'>";
						}


						else {		//Sinon on créer un lien vers le fichier
							echo "<div class='tuile'><a class='lienTuile' href='".$curent_dir.$liste_rep[$i]."'>";
						}
						

						//Icone fichier PHP
						if (strrchr($liste_rep[$i],".")==".php") {
							//echo '<img src="icoSystem/php.png" class="imgTuile">';


							//Application d'une vignette si celle ci existe
							$thumbnail = "icoSystem/thumbnails/".str_replace(".php", ".jpg", $liste_rep[$i]);


							if (file_exists($thumbnail)) {
								echo '<img src="'.$thumbnail.'" class="imgTuilePicture">';
							}
							else {
								echo '<img src="icoSystem/php.png" class="imgTuile">';
							}
						}

						//Icone fichier HTML
						elseif (strrchr($liste_rep[$i],".")==".html") {
							//echo '<img src="icoSystem/html.png" class="imgTuile">';


							//Application d'une vignette si celle ci existe
							$thumbnail = "icoSystem/thumbnails/".str_replace(".html", ".jpg", $liste_rep[$i]);


							if (file_exists($thumbnail)) {
								echo '<img src="'.$thumbnail.'" class="imgTuilePicture">';
							}
							else {
								echo '<img src="icoSystem/html.png" class="imgTuile">';
							}
						}

						//Icone fichier CSS
						elseif (strrchr($liste_rep[$i],".")==".css") {
							echo '<img src="icoSystem/css.png" class="imgTuile">';
						}

						//Icone fichier JPG
						elseif (strrchr($liste_rep[$i],".")==".jpg") {
							echo '<img src="'.$curent_dir.$liste_rep[$i].'"class="imgTuilePicture">';
						}

						//Icone fichier PNG
						elseif (strrchr($liste_rep[$i],".")==".png") {
							echo '<img src="'.$curent_dir.$liste_rep[$i].'" class="imgTuilePicture">';
						}

						//Icone DOSSIER
						elseif (is_dir ($curent_dir.$liste_rep[$i])) {
							echo '<img src="icoSystem/dossier.png" class="imgTuile">';
						}

						//Icone fichier autre
						else {
							echo '<img src="icoSystem/file.png" class="imgTuile">';

						}
					
					echo "<h2>".$liste_rep[$i]."</h2>";
					echo "</a></div>";
					}
				}
			?>
		</div>


		<div class="aboutUs">

			<h2>Retrouvez ce "listeur de fichiers" sur le <a href="https://github.com/Axolito/DevFileLister/">GitHub</a> de Axel BRUA</h2>

		</div>


	</body>
</html>

