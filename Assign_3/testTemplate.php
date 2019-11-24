<?php

require_once("Template.php");

$page = new Template("My Page");
$page->addHeadElement("<script src='hello.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();
print "<h1>Some page-specific HTML goes here</h1>\n";
print $page->getBottomSection();

