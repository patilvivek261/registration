<?php 
/**
 * This is Home page og website
 * 
 */

$this->extend("layouts/base_home.php");

$this->section("pageTitleSection");
echo $pageTitle;
$this->endsection();

$this->section("pageHeadingSection");
echo $pageHeading;
$this->endsection();

?>