<?php

    $rankByShort = array(
        "r" => "Rekrut",
        "pvt" => "Private",
        "pfc" => "Private First Class",
        "spc" => "Specialist",
        "lcpl" => "Lance Corporal",
        "cpl" => "Corporal",

        "sgt" => "Sergeant",
        "ssgt" => "Staff Sergeant",
        "sfc" => "Sergeant First Class",
        "fsg" => "First Sergeant",
        "sgm" => "Sergeant Major",
        "csm" => "Command Sergeant Major",

        "2lt" => "2. Lieutenant",
        "1lt" => "1. Lieutenant",
        "cpt" => "Captain",
        "maj" => "Major",
        "lcol" => "Lieutenant Colonel",
        "col" => "Colonel"
    );

    $RankIDByName = array(
        "r" => 1,
        "pvt" => 2,
        "pfc" => 3,
        "spc" => 4,
        "lcpl" => 5,
        "cpl" => 6,

        "sgt" => 7,
        "ssgt" => 8,
        "sfc" => 9,
        "fsg" => 10,
        "sgm" => 11,
        "csm" => 12,

        "2lt" => 13,
        "1lt" => 14,
        "cpt" => 15,
        "maj" => 16,
        "lcol" => 17,
        "col" => 18
    );

    $rankByID = array(
        1 => "r",
        2 => "pvt",
        3 => "pfc",
        4 => "spc",
        5 => "lcpl",
        6 => "cpl",

        7 => "sgt",
        8 => "ssgt",
        9 => "sfc",
        10 => "fsg",
        11 => "sgm",
        12 => "csm",

        13 => "2lt",
        14 => "1lt",
        15 => "cpt",
        16 => "maj",
        17 => "lcol",
        18 => "col",
    );

    $FullJobByJob = array(
        "n7" => "Nu-7",
        "d5" => "Delta-5",
        "e6" => "Epsilon-6"
    );
    
    $canPromoteTo = array(
        "r" => "r",
        "pvt" => "r",
        "pfc" => "r",
        "spc" => "r",
        "lcpl" => "r",
        "cpl" => "pfc",

        "sgt" => "cpl",
        "ssgt" => "cpl",
        "sfc" => "cpl",
        "fsg" => "cpl",
        "sgm" => "fsg",
        "csm" => "sgm",

        "2lt" => "csm",
        "1lt" => "csm",
        "cpt" => "2lt",
        "maj" => "cpt",
        "lcol" => "maj",
        "col" => "lcol"
    );

    $canDemoteTo = array(
        "r" => "none",
        "pvt" => "none",
        "pfc" => "none",
        "spc" => "none",
        "lcpl" => "none",
        "cpl" => "none",

        "sgt" => "pvt",
        "ssgt" => "pfc",
        "sfc" => "cpl",
        "fsg" => "cpl",
        "sgm" => "sgt",
        "csm" => "sgt",

        "2lt" => "csm",
        "1lt" => "csm",
        "cpt" => "2lt",
        "maj" => "cpt",
        "lcol" => "maj",
        "col" => "lcol"
    );
?>
