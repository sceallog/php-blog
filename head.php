<?php
function setHead($title, $stylesheetPath)
{
echo"
<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href={$stylesheetPath}>
    <title>{$title}</title>
</head>
";
}
