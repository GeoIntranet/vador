<?php



/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 03/03/2017
 * Time: 13:09
 */


/**
 * return le nom de l'id utilisateur
 * Format : Geoffrey VALERO [48]
 * @param $id
 * @return string
 */
function userName($id , $mode=null)
{
    $gestion  = new \App\Http\Controllers\Lib\Gestion();
    $users = $gestion->getUsers();

    if( isset($users[$id]) )
    {
        $user = $users[$id];

        return $mode == 'noID' ? $user['prenom'].' '.$user['nom']  : $user['prenom'].' '.$user['nom'].' ['.$user['id'].']';
    }
    return 'inconnu'.$id;
}

function deleteSpace($string)
{
    return str_replace(' ','',$string);
}

function deleteSpaceStartAndEnd($string)
{
    return trim (  $string , " \t\n\r\0\x0B"  );
}

function commonKeyArrayMulti($array,$value = '')
{
    $output =collect([]);
    $count = 1;
    foreach ($array as $index => $item) {
        foreach ($item as $key => $id) {
            $value = isset($output[$id]) ? $output[$id] : 0;
            $output[$id] = $value + 1;
        }
    }

    return $output->filter(function($key , $value) use($array)
    {
        return $key == count($array);
    });
}


function nl2brplus($txt)
{
    $txt = trim($txt);
    $txt = stripslashes($txt);
    $txt = nl2br($txt);
    $txt = str_replace ("\r\n", '', $txt);
    $txt = str_replace ("\n",   '', $txt);
    $txt = str_replace ("\r",   '', $txt);
    $txt = str_replace ('"' ,  "'", $txt);
    $txt = str_replace ("<br />", "<br>", $txt);
    $txt = str_replace ("   <br>", "<br>", $txt);
    $txt = str_replace ("  <br>", "<br>", $txt);
    $txt = str_replace (" <br>", "<br>", $txt);
    $txt = str_replace ("<br><br><br><br>", "<br><br>", $txt);
    $txt = str_replace ("<br><br><br>", "<br><br>", $txt);
    //$txt = addslashes($txt);
    return $txt;
}
function monSubStr($chaine, $taille)
{
    $text = substr(html_entity_decode($chaine), 0, $taille);

    return htmlentities($text);
}
function deleteBrPlus($txt)
{
    $txt = trim($txt);
    $txt = stripslashes($txt);
    $txt = nl2br($txt);
    $txt = str_replace ("\r\n", '', $txt);
    $txt = str_replace ("\n",   '', $txt);
    $txt = str_replace ("\r",   '', $txt);
    $txt = str_replace ('"' ,  "'", $txt);
    $txt = str_replace ("<br />", " ", $txt);
    $txt = str_replace ("<br /><br />", " ", $txt);
    $txt = str_replace ("   <br>", " ", $txt);
    $txt = str_replace ("  <br>", " ", $txt);
    $txt = str_replace (" <br>", " ", $txt);
    $txt = str_replace ("<br><br><br><br>", " ", $txt);
    $txt = str_replace ("<br><br><br>", " ", $txt);
    //$txt = addslashes($txt);
    return $txt;
}

function br2nl($txt)
{
    $txt = str_replace("<br />", "<br>", $txt);
    $txt = str_replace("<br>", "\n", $txt);

    return $txt;
}

