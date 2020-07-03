<?
upload('picture', 'uploads/');
function upload($name_input, $pach){
    if(!opendir($pach)){
        return 'Директория сохранения файлов, указана неверно!';
    }
    foreach ($_FILES as $value) {
        $file_name=$value['name'];

        $type = $value['type'];

        foreach($file_name as $key=> $file){
            $uploadfile = $pach.basename($file);
            $ext = pathinfo($uploadfile, PATHINFO_EXTENSION);
            $tmp_name = $value['tmp_name'][$key];

            if(!empty($file)){
                $value['error']=size(1024, $tmp_name, $value['size'], $error='');
                $value['error']=type($type[$key], $file, $error='');
                if (!empty($value['error'])
                    || empty($tmp_name)) {
                    switch (@$value['error']) {
                        case 1:
                        case 2: $error = 'Превышен размер загружаемого файла.'; break;
                        case 3: $error = 'Файл был получен только частично.'; break;
                        case 4: $error = 'Файл не был загружен.'; break;
                        case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
                        case 7: $error = 'Не удалось записать файл на диск.'; break;
                        case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
                        case 9: $error = 'Файл не был загружен - директория не существует.'; break;
                        case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
                        case 11: $error = 'Данный тип файла запрещен.'; break;
                        case 12: $error = 'Ошибка при копировании файла.'; break;
                        default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
                    }
                }
                elseif ($tmp_name == 'none' || !is_uploaded_file($tmp_name)) {
                    $error = "Не удалось загрузить файл $file.\n";
                }
                else {
                    $parts = pathinfo($file);
                    if (empty($file) || empty($parts['extension'])) {
                        $error = 'Пустое имя файла или не задано расширение';
                    }
                }

                if (empty($error)){
                    $file = md5($file . microtime());
                    if(is_file($uploadfile)):
                        $file = md5($file . microtime());
                    endif;

                    if (move_uploaded_file($tmp_name, $uploadfile)) {
                        echo "Файл $file упешно загружен\n";
                    } else {
                        echo "Файл $file загрузить не удалось\n";
                    }
                }
                else{
                    echo $error;
                }
            }
        }
    }
}

function size($size, $tmp_name, $file_size, $error){
    if($file_size >= $size){
        $error=2;
        return $error;
    }
}

function type($type, $file, $error=''){
    $allow = array('img','bmp','jpg', 'jpge', 'png');
    $parts = pathinfo( $file);
    if (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
        $error=11;
        return $error;
    }
}
