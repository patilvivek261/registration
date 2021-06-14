<?php 
/**
 * View page
 */

$this->extend('layouts/base_inner_page.php');

$this->section('pageTitleSection');
echo $pageTitle;
$this->endsection();

$this->section('pageHeadingSection');
echo $pageHeading;
$this->endsection();


?>