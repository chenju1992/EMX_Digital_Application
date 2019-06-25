<?php
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

//The function below uses dfs to search the transitive relationship i.e. a < b, b < c implies a < c
function helper(&$sub_pieces,$sign,$current,$start,$end){

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

        return;
    }
    for($next = 1; $next <=4; $next++){
        //skip itself
        if($next == $current){
            continue;
        }

        if($sub_pieces[$current][$next] == $sign){

            helper($sub_pieces,$sign,$next,$start,$end);
        }
    }
    return;
}


if ($_GET["q"] == "Puzzle"){
    $input_string = $_GET["d"];
    $pieces = explode(':',$input_string);
    $sub_pieces = array_slice(preg_split('/[\s+]+/',$pieces[1]),1);
    // $sub_pieces looks like 
    
    $n = count($sub_pieces) - 2; // there maybe a "\n" at the back
    //Deal with the case that a = a, b = b etc.
    for($i = 1; $i <= $n; $i++){
        $sub_pieces[$i][$i] = '=';
    }
    //Bascally, if we know a > b then it is obvious b < a,the nested for-loop below is trying to get information from this 
    for($i = 1; $i <= $n; $i++){
        for($j = 1; $j <= $n; $j++){
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

    //As metioned above, the code below trying to deal with reflecsive relation
    for($i = 1; $i <= $n; $i++){
        for($j = 1+$i ; $j <= $n; $j++){
            if($sub_pieces[$i][$j] == '-'){
                //echo($sub_pieces[$i][$j]);
                helper($sub_pieces,'<',$i,$i,$j);
                helper($sub_pieces,'>',$i,$i,$j);
                helper($sub_pieces,'=',$i,$i,$j);

            }
        }
    }
    
// The code below prints the result
    echo(' ABCD');
    for($i = 1; $i <= $n; $i++){
        echo "\n";
        for($j = 0; $j <= $n; $j++){
            echo $sub_pieces[$i][$j];
        }
    }

}

?>
