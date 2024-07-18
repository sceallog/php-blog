<?php
function setHead($title, $stylesheetPath, $javascriptPath)
{
echo"
<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href={$stylesheetPath}>
    <!-- Include jQuery from a CDN -->
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <!-- Include your custom JavaScript file -->
    <script src={$javascriptPath}></script>
    <title>{$title}</title>
</head>
";
}
