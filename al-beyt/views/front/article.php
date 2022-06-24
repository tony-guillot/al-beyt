<?php
require_once '../../../vendor/autoload.php';
require_once('../include/header.php');
use AlBeyt\Controllers\ArticleController;

$article = new ArticleController();

echo '<pre>';
echo "displayAllArticles(page : 1) :<br />";
var_dump($article->displayAllArticles(1));
echo "<br /><br /><br />";
echo "displayAllArticles(page : 2) :<br />";
var_dump($article->displayAllArticles(2));
echo "<br /><br /><br />";
echo "displayAllArticles(page : 3) :<br />";
var_dump($article->displayAllArticles(3));
echo "<br /><br /><br />";

echo "displayAllArticlesByYear( page : 1) :<br />";
var_dump($article->displayArticlesByYear(2020,1));
echo "<br /><br /><br />";
echo "displayAllArticlesByYear( page : 2) :<br />";
var_dump($article->displayArticlesByYear(2020,2));
echo "<br /><br /><br />";


echo "displayArticleById(4) :<br />";
var_dump($article->displayArticleById(4));
echo "<br /><br /><br />";
echo "displayArticleById(5) :<br />";
var_dump($article->displayArticleById(5));
echo "<br /><br /><br />";
echo "displayArticleById(6) :<br />";
var_dump($article->displayArticleById(6));
echo "<br /><br /><br />";

echo '<pre />';