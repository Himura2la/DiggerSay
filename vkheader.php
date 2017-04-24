<?php
// Нужен ТОКЕН ГРУППЫ СО ВСЕМИ ПРАВАМИ!
$token = "b423a7253493821608f90897b901ac3c269b8bf903265a782375da7d6a367cad0580c44cdb2af548d7291";
$cover_path = dirname(__FILE__).'/cover/'.mt_rand(1,3).'.jpg';
//
echo '<pre>';
echo $cover_path;
$post_data = array('photo' => $_SERVER['DOCUMENT_ROOT'].$cover_path);
//$post_data = array('photo' => new CURLFile($cover_path, 'image/jpeg', 'image0'));
// рандомно выбирается фотография 1,2 или 3
$upload_url = file_get_contents("https://api.vk.com/method/photos.getOwnerCoverPhotoUploadServer?group_id=119527646&crop_x2=1590&access_token=".$token);
$url = json_decode($upload_url)->response->upload_url;
echo $url;
// урл для загрузки фото получен
// фото отправлено
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$result = json_decode(curl_exec($ch),true);
echo '<pre>';
print_r($result);
echo '<pre>сохраняем фото';
$safe = file_get_contents("https://api.vk.com/method/photos.saveOwnerCoverPhoto?hash=".$result['hash']."&photo=".$result['photo']."&access_token=".$token);
echo '<pre>';
print_r($safe);
// все готово
?>