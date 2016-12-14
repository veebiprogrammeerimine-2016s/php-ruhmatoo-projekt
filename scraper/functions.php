<?php
/**
 * @author Alar Aasa <alar@alaraasa.ee>
 */

function monthToDate($month)
{
    if ($month == "jaanuar" || $month == "Jaanuar") {
        return "01";
    }
    if ($month == "veebruar" || $month == "Veebruar") {
        return "02";
    }
    if ($month == "märts" || $month == "Märts") {
        return "03";
    }
    if ($month == "aprill" || $month == "Aprill") {
        return "04";
    }
    if ($month == "mai" || $month == "Mai") {
        return "05";
    }
    if ($month == "juuni" || $month == "Juuni") {
        return "06";
    }
    if ($month == "juuli" || $month == "Juuli") {
        return "07";
    }
    if ($month == "august" || $month == "August") {
        return "08";
    }
    if ($month == "september" || $month == "September") {
        return "09";
    }
    if ($month == "oktoober" || $month == "Oktoober") {
        return "10";
    }
    if ($month == "november") {
        return "11";
    }
    if ($month == "detsember") {
        return "12";
    }

    /*
    HTML Simple HTMl DOM Parser memory leak fix
    http://stackoverflow.com/questions/18090212/php-simple-html-dom-parser-memory-leak-usage 
    */
//     function clean_all(&$items,$leave = ''){
//     foreach($items as $id => $item){
//         if($leave && ((!is_array($leave) && $id == $leave) || (is_array($leave) && in_array($id,$leave)))) continue;
//         if($id != 'GLOBALS'){
//             if(is_object($item) && ((get_class($item) == 'simple_html_dom') || (get_class($item) == 'simple_html_dom_node'))){
//                 $items[$id]->clear();
//                 unset($items[$id]);
//             }else if(is_array($item)){
//                 $first = array_shift($item);
//                 if(is_object($first) && ((get_class($first) == 'simple_html_dom') || (get_class($first) == 'simple_html_dom_node'))){
//                     unset($items[$id]);
//                 }
//                 unset($first);
//             }
//         }
//     }
// }
}