<?php
$post=$_POST;
$user_link = $post['link'];
$filename='short.txt';
match_check($filename, $user_link);

function match_check($filename, $user_link){
    $arr_data=file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $host_url=parse_url($user_link, PHP_URL_HOST);

    foreach ($arr_data as $string) {
        if ($user_link != $string) {
            $patch_url = generate_string(parse_url($user_link, PHP_URL_PATH));
            $short_url = $host_url . '/' . $patch_url;
        }
        $arr = explode('#', $string);
        if ($arr[2] === $short_url):
            $patch_url = generate_string(parse_url($user_link, PHP_URL_PATH));
            $short_url = $host_url . '/' . $patch_url;
        endif;
    }
    $long_url="$user_link#$short_url\n";
    write_file($filename,$long_url);
    echo "Короткая ссылка $short_url<br>";
}

function write_file($filename, $data){
    if(file_put_contents($filename, $data.PHP_EOL, FILE_APPEND | LOCK_EX)!==false){
        echo "Данные успешно записаны в файл $filename<br>";
    }
}
function generate_string($string, $strength = 7) {
    $input_length = strlen($string);
    $random_string = '';
    $excess = array(",", "/", "\\", ".", "-");
    for($i = 0; $i < $strength; $i++) {
        $random_character = $string[mt_rand(0, $input_length - 1)];
        $random_character = str_replace($excess, "", $random_character);
        $random_string .= $random_character;
    }
    return trim($random_string);
}