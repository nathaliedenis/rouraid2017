<?php


//__DIR__ .  =  la racine du dossier + concatenation avec chemin du dossier cherché

//je recupere le dossier autoload
require_once __DIR__ . '/../vendor/autoload.php';

//je recupere les pages.twig depuis le dossier templates
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');

// $twig = objet qui represente le moteur du template Twig
$twig = new Twig_Environment($loader);

$twig -> addFunction(new Twig_SimpleFunction('markdown', function ($value){
	return $value;
}, ['is_safe' => ['html']]));

