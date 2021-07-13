<?php

session_start();
$xmlDoc = new DOMDocument();
$test = $xmlDoc->load("singer.xml");

$x=$xmlDoc->getElementsByTagName('singer');

//get parameter from URL
$q=$_GET["q"];
$hint="";
$_SESSION["q"] = $q; 

//Lookup all concert page from xml file if length of q>0
if(strlen($q) > 0)
{
    for($i=0; $i < ($x->length); $i++)
    {
        $name = $x->item($i)->getElementsByTagName("singer_name");

        if($name->item(0)->nodeType==1)
        {
            //find a link matching the search text
            if(stristr($name->item(0)->childNodes->item(0)->nodeValue, $q))
            {
                if($hint=="")
                {
                    $hint="<a href='result_singer.php?q=".$name->item(0)->childNodes->item(0)->nodeValue."' target='_self' class='instant-search__result'>" . 
                    $name->item(0)->childNodes->item(0)->nodeValue . "</a>";
                }
                else
                {
                    $hint=$hint . "<a href='result_singer.php?q=".$name->item(0)->childNodes->item(0)->nodeValue."' target='_self' class='instant-search__result'>" . 
                    $name->item(0)->childNodes->item(0)->nodeValue . "</a>";
                }
            }
        }
    }
}


//set output to "No results found" if no result was found or to the correct values
if($hint=="")
{
    $response = "<a href='#' class='instant-search__result'>No results found</a>";
}
else
{
    $response = $hint;
}

//output the response
echo $response;
?>