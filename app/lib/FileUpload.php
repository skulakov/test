<?php
  /**
   * Created by PhpStorm.
   * User: SK
   * Date: 05.01.2019
   * Time: 13:40
   */

  namespace lib;


  class FileUpload {

    public function fileUpload($width, $height) {
      $fileDir = ROOT . '/img/upload/';

      if ($this->checkFile()) {
        $filename = uniqid('', true) . '.' . $this->extension();
        //        return move_uploaded_file($_FILES['file']['tmp_name'], $fileDir . $filename) ? $filename : false;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $fileDir . $filename)) {
          $this->cropImage($fileDir . '/' . $filename, $fileDir . '/tmb/' . $filename, $width, $height);
          return $filename;
        }
      }
      return false;
    }

    public function checkFile() {
      $uploadOk = true;

      if (!$this->requiredFile()) {
        $uploadOk = false;
      }

      if (!$this->checkSize()) {
        $uploadOk = false;
      }

      if (!$this->checkError()) {
        $uploadOk = false;
      }
      if (!$this->checkExt()) {
        $uploadOk = false;
      }


      return !$uploadOk ? false : true;
    }

    public function requiredFile() {
      return $_FILES['file']['size'] !== 0 ? true : false;
    }

    public function checkSize() {
      return $_FILES["file"]["size"] > 10000000 ? false : true;
    }

    public function checkError() {
      return $_FILES['file']['error'] !== 0 ? false : true;
    }

    public function checkExt() {
      $allExt = ['jpg', 'jpeg'];
      $allMime = ['image/jpeg', 'image/jpg'];
      $fileExt = $this->extension();
      return in_array($fileExt, $allExt) && in_array($_FILES['file']['type'], $allMime) ? true : false;
    }

    private function extension() {
      $parser = explode('.', $_FILES['file']['name']);
      return strtolower(end($parser));
    }

    private function cropImage($aInitialImageFilePath, $aNewImageFilePath, $aNewImageWidth, $aNewImageHeight) {
      if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)) {
        return false;
      }

      // Массив с поддерживаемыми типами изображений
      $lAllowedExtensions = [1 => "gif", 2 => "jpeg", 3 => "png"];

      // Получаем размеры и тип изображения в виде числа
      list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath);

      if (!array_key_exists($lImageExtensionId, $lAllowedExtensions)) {
        return false;
      }
      $lImageExtension = $lAllowedExtensions[$lImageExtensionId];

      // Получаем название функции, соответствующую типу, для создания изображения
      $func = 'imagecreatefrom' . $lImageExtension;
      // Создаём дескриптор исходного изображения
      $lInitialImageDescriptor = $func($aInitialImageFilePath);

      // Определяем отображаемую область
      $lCroppedImageWidth = 0;
      $lCroppedImageHeight = 0;
      $lInitialImageCroppingX = 0;
      $lInitialImageCroppingY = 0;
      if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight) {
        $lCroppedImageWidth = floor($lInitialImageWidth);
        $lCroppedImageHeight = floor($lInitialImageWidth * $aNewImageHeight / $aNewImageWidth);
        $lInitialImageCroppingY = floor(($lInitialImageHeight - $lCroppedImageHeight) / 2);
      } else {
        $lCroppedImageWidth = floor($lInitialImageHeight * $aNewImageWidth / $aNewImageHeight);
        $lCroppedImageHeight = floor($lInitialImageHeight);
        $lInitialImageCroppingX = floor(($lInitialImageWidth - $lCroppedImageWidth) / 2);
      }

      // Создаём дескриптор для выходного изображения
      $lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);
      imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX, $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lCroppedImageWidth, $lCroppedImageHeight);
      $func = 'image' . $lImageExtension;

      // сохраняем полученное изображение в указанный файл
      return $func($lNewImageDescriptor, $aNewImageFilePath);
    }
  }