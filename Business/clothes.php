<?php

function getClothingRecommendation($weather){
    //
    if((int)$weather<7){
        return "warm clothes and a warm Jacket would be adviced";
    } else if((int)$weather<15){
        return "warm clothes and a small Jacket would be adviced";
    } else if((int)$weather<21){
        return "warm clothes and would be adviced";
    } else {
        return "today is gonna be a warm day, so better wear some short pieces of clothing";
    }
}

?>