<?php
/*
** I made this using code from this example: http://www.w3schools.com/php/php_ajax_livesearch.asp
** All credit goes to w3c for creating the original code.
** The reason for taking this code in use was that my site required a form of quick search.
*/
$xmlDoc=new DOMDocument();
$xmlDoc->load("coursedatalinks/courselinks.xml");
$x=$xmlDoc->getElementsByTagName('course');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all courses from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('coursename');
    $z=$x->item($i)->getElementsByTagName('courselink');
    if ($y->item(0)->nodeType==1) {
      //find a course matching the search text
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
        if ($hint=="") {
          $hint="<a href='course.php?cid=" .
          $z->item(0)->childNodes->item(0)->nodeValue .
          "' target='_blank'>" .
          $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        } else {
          $hint=$hint . "<br /><a href='course.php?cid=" .
          $z->item(0)->childNodes->item(0)->nodeValue .
          "' target='_blank'>" .
          $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        }
      }
    }
  }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>
