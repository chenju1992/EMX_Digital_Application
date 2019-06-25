<?php

function helper(&$sub_pieces,$sign,$current,$start,$end){

//    echo($sign);
//    echo($start);
//    echo($end);
    if($current == $end){
        $sub_pieces[$start][$end] = $sign;
        if($sign == '>'){
            $sub_pieces[$end][$start] = '<';
        }
        if($sign == '<'){
            $sub_pieces[$end][$start] = '>';
        }
        if($sign == '='){
            $sub_pieces[$end][$start] = '=';
        }


         //echo('Finish');
        //echo($sub_pieces[$start][$end]);

        return;
    }
    for($next = 1; $next <=4; $next++){
        if($next == $current){
            continue;
        }

        if($sub_pieces[$current][$next] == $sign){
//            echo($sign);
//            echo($start);
//            echo($next);
            helper($sub_pieces,$sign,$next,$start,$end);
        }
    }
//    echo('Finish');
    return;
}
if ($_GET["q"] == "Ping"){
    echo "OK";
}
if ($_GET["q"] == "Name"){
    echo "Ju Chen";
}
if ($_GET["q"] == "Email Address"){
    echo "chenju816@gmail.com";
}
if ($_GET["q"] == "Phone"){
    echo "201-680-1987";
}

if ($_GET["q"] == "Referrer"){
    echo "I was referred by Stephanie Wiernik";
}



if ($_GET["q"] == "Puzzle"){
    $input_string = $_GET["d"];
//    echo $input_string;
    $pieces = explode(':',$input_string);
    $sub_pieces = array_slice(preg_split('/[\s+]+/',$pieces[1]),1);
    for($i = 1; $i <= 4; $i++){
        $sub_pieces[$i][$i] = '=';
    }
    for($i = 1; $i <= 4; $i++){
        for($j = 1; $j <= 4; $j++){
            if($sub_pieces[$i][$j] == '-'){
                if($sub_pieces[$j][$i] == '>'){
                    $sub_pieces[$i][$j] = '<';
                }
                if($sub_pieces[$j][$i] == '<'){
                    $sub_pieces[$i][$j] = '>';
                }
                if($sub_pieces[$j][$i] == '='){
                    $sub_pieces[$i][$j] = '=';
                }
            }
        }
    }

//    echo(' ABCD');
//    for($i = 1; $i <= 4; $i++) {
//        echo "\n";
//        for ($j = 0; $j <= 4; $j++) {
//            echo $sub_pieces[$i][$j];
//        }
//    }

    for($i = 1; $i <= 4; $i++){
        for($j = 1+$i ; $j <= 4; $j++){
            if($sub_pieces[$i][$j] == '-'){
                //echo($sub_pieces[$i][$j]);
                helper($sub_pieces,'<',$i,$i,$j);
                helper($sub_pieces,'>',$i,$i,$j);
                helper($sub_pieces,'=',$i,$i,$j);

            }
        }
    }

    echo(' ABCD');
    for($i = 1; $i <= 4; $i++){
        echo "\n";
        for($j = 0; $j <= 4; $j++){
            echo $sub_pieces[$i][$j];
        }
//            if($sub_pieces[$i][$j] == '>' and $sub_pieces[$j][$i] == '-'){
//                $sub_pieces[$j][$i] = '<';
//                echo $sub_pieces[$j][$i];
//            }
//            if($sub_pieces[$i][$j] == '<' and $sub_pieces[$j][$i] == '-'){
//                $sub_pieces[$j][$i] = '>';
//                echo $sub_pieces[$j][$i];
//            }
//        }
    }





//    echo $sub_pieces[4][1];

}

if ($_GET["q"] == "Years"){
    echo "0-1 year";
}

if ($_GET["q"] == "Status"){
    echo "Yes";
}
if ($_GET["q"] == "Degree"){
    echo "Master of Science in Mathematics from the New York University";
}
if ($_GET["q"] == "Position"){
    echo "I am applying for the data scientist position for EMC Digital.";
}
if($_GET["q"] == "Resume"){
    echo "https://github.com/chenju1992/EMX_Digital_Application/";
}
if($_GET["q"] == "Source"){
    echo "https://github.com/chenju1992/EMX_Digital_Application/";
}

#phpinfo();
?>