<?php

/**
 * @param $maxFileSize
 * @param $validFileTypes
 * @param $uploadPath
 * @param $nameElem
 * @return array
 */
function loadImg($maxFileSize, $validFileTypes, $uploadPath, $nameElem): array
{
    $error = "";
    $newName = "";
    if (isset($_FILES[$nameElem])) {
        $file = $_FILES[$nameElem];

        if (!empty($file['error'])) {
            // Если файл не был загружен
            $error = "Произошла ошибка загрузки данных...";
        } else if ($file['size'] > $maxFileSize) {
            $error = "Размер изображения слишком велик...";
        } else {
            // 1 способ - определяем тип содержимого
//            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
//            $type = finfo_file($fileInfo, $file['tmp_name']);
//            finfo_close($fileInfo);

            // 2 способ - определяем тип содержимого
            $type = mime_content_type($file['tmp_name']);

            // Формируем новое имя файла
            $name = pathinfo($file['name'], PATHINFO_FILENAME) . '_' . time();
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newName = "$name.$ext";

            // Проверяем тип файла на допустимость
            if (in_array($type, $validFileTypes)) {
                if (!move_uploaded_file($file['tmp_name'], $uploadPath . $newName)) {
                    $error = "Не удалось загрузить изображение...";
                }
            } else {
                $error = "Расширение файла должно быть таким: jpg, jpeg или png...";
            }
        };

        if (!empty($error)) {
            $error = $file['name'] . ' - ' . $error;
        }
    }
    return [$error, $newName];
}

//function deleteImg($file)
//{
//    if (is_file($file)) {
//        unlink($file);
//    }
//}
function deleteImg($file, $uploadPath)
{
    if (is_file($file) && strpos(realpath($file), realpath($uploadPath)) == 0) {
        unlink($file);
    }
}
//@getimagesize($file)
//function deleteImg($array): string
//{
//    $error = '';
//    foreach ($array as $file) {
//        if (!unlink('../' . $file)) {
//            $error = "Ошибка удаления файлов";
//            break;
//        }
//    }
//    return $error;
//}

//error = '';
//foreach ($array as $file) {
//    if (strpos(realpath('/upload/' . $file), realpath('../upload')) == 0) {
//        if (!unlink('../upload/' . $file)) {
//            $error = "Ошибка удаления файлов";
//            break;
//        }
//    } else {
//        $error = "Ошибка удаления файлов";
//    }
//}
//return $error;


//function loadImg($nameItem, $maxCountFiles, $maxFileSize, $validFileTypes, $uploadPath)
//{
//    $data = ['errors' => [], 'uploadFiles' => []];
//
//    if (isset($_FILES[$nameItem])) {
//        $files = $_FILES[$nameItem];
//
//        $countFiles = count($files['name']);
//
//        if ($files['error'][0] == 4) {
//            $data['errors'][] =  "Необходимо загрузить хотя бы один файл...";
//        } else {
//            if ($countFiles > $maxCountFiles) {
//                $data['errors'][] =  "Необходимо выбрать не более " . $maxCountFiles . " изображений...";
//                $countFiles = $maxCountFiles;
//            };
//
//            for ($i = 0; $i < $countFiles; $i++) {
//                $error = "";
//                if (! empty($files['error'][$i])) {
//                    $error = "Произошла ошибка загрузки данных...";
//                } else if ($files['size'][$i] > $maxFileSize) {
//                    $error =   "Размер изображения слишком велик...";
//                } else {
//                    // $ext = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
//                    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
//                    $type = finfo_file( $fileInfo, $files['tmp_name'][$i]);
//
//                    // $type = mime_content_type($files['tmp_name'][$i]);
//
//                    if (in_array($type, $validFileTypes)) {
//                        if (move_uploaded_file($files['tmp_name'][$i], $uploadPath . '/' . $files['name'][$i])) {
//                            $data['uploadFiles'][] = rawurlencode($files['name'][$i]);
//                        } else {
//                            $error =   "Не удалось загрузить изображение...";
//                        }
//                    } else {
//                        $error =   "Расширение файла должно быть таким: jpg, jpeg или png...";
//                    }
//                    finfo_close( $fileInfo );
//                };
//                if (!empty($error)) {
//                    $data['errors'][] = $files['name'][$i] . ' - ' . $error;
//                }
//            }
//        };
//    };
//
//    echo (json_encode($data));
//};


////Очищаем имя
//$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
////Проверяем полученное значение на непустоту
//if(mb_strlen($name)<=0){
//    $_SESSION["msg"] = "Введите данные...";
//    $_SESSION["alert"] = "alert-warning";
//
//    header("Location: /index.php");
//    exit();
//}
////Если все хорошо с именем, то сохраняем его и
////начинаем работу с файлом
//$_SESSION['name']=$name;
//$errors = [];
//
//if (isset($_POST['btnOK'])) {
//
//    if (isset($_FILES['avatar'])) {
//        $fileName = $_FILES['avatar']['name'];
//        $fileTmpName = $_FILES['avatar']['tmp_name'];
//        $fileSize = $_FILES['avatar']['size'];
//        $fileType = $_FILES['avatar']['type'];
//        $fileError = $_FILES['avatar']['error'];
//
//        $nameArray = explode('.', $fileName);
//        $fileExtension = strtolower(end($nameArray));
//        $fileName = $nameArray[0];
//        //$fileName = preg_replace('/[0-9-_]/', '', $fileName);
//
//        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
//        if (in_array($fileExtension, $extensions)) {
//            if ($fileSize < 5000000) {
//                if ($fileError === 0) {
//                    $fileNameNew = "$fileName.$fileExtension";
//                    if (move_uploaded_file($fileTmpName,
//                        '../../upload/' . $fileNameNew)) {
//                        Friend::insertFriend("../../people.json", $fileNameNew, $name);
//                    }
//                    else $errors[] = "Не удалось переместить файл";
//                }
//                else $errors[] = "Что-то пошло не так...";
//            }
//            else $errors[] = "Превышен допустимый размер файла";
//        }
//        else $errors[] = "Недопустимый тип файла";
//    }
//}
//
//if (count($errors) === 0) {
//    $_SESSION['msg'] = "Файл успешно загружен";
//    $_SESSION['alert'] = 'alert-success';
//    $_SESSION['name'] = "";
//}
//else {
//    $_SESSION['msg'] = implode('\n', $errors);
//    $_SESSION['alert'] = 'alert-danger';
//}
//
//header("Location:/");
//
//
//function loadInJson2($fileJson, $fileName, $name){
//    $data = ["fileName" => $fileName, "name" => $name];
//    $textJson = json_encode($data, JSON_UNESCAPED_UNICODE);
//
//    $f = fopen($fileJson, 'r+');
//    if ($f)
//    {
//        fseek($f, 0, SEEK_END);
////        if (ftell($f) > 0)
//////        {
//////            fseek($f, -1, SEEK_END);
//////            fwrite($f, ','.json_encode($data, JSON_UNESCAPED_UNICODE)."]");
//////        }
//////        else fwrite($f, json_encode([$data], JSON_UNESCAPED_UNICODE));
/////
//        if (ftell($f) > 0)
//        {
//            fseek($f, -1, SEEK_END);
//            $s =','.$textJson."]";
//        }
//        else $s = '['.$textJson.']';
//        fwrite($f, $s);
//    }
//    fclose($f);
//}