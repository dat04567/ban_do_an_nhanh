<?php

namespace Framework;


class ImageProcessor
{
   private $uploadDir;
   private $maxFileSize;
   private $allowedMimeTypes;

   /**
    * Constructor for ImageProcessor
    * 
    * @param string $uploadDir Directory to save uploaded images
    * @param int $maxFileSize Maximum file size in bytes (default 5MB)
    */
   public function __construct(string $uploadDir, int $maxFileSize = 5242880)
   {
      // Ensure upload directory exists and is writable


      if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
         throw new \Exception("Upload directory does not exist or is not writable.");
      }

      $this->uploadDir = rtrim($uploadDir, '/') . '/';
      $this->maxFileSize = $maxFileSize;
      $this->allowedMimeTypes = [
         'image/jpeg',
         'image/png',
         'image/gif',
         'image/webp',
         'image/svg+xml',
         'image/svg' 
      ];
      

   }

   /**
    * Upload and validate an image file
    * 
    * @param array $file $_FILES array for the uploaded image
    * @param bool $randomizeName Whether to use a random filename
    * @return string Path to the uploaded file
    * @throws \Exception
    */
   public function uploadImage(array $file, bool $randomizeName = true): string
   {

      // Validate file upload
      if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
         throw new \Exception("Lỗi tải ảnh lên: " . $this->getUploadErrorMessage($file['error']));
      }
     

      // Check file size
      if ($file['size'] > $this->maxFileSize) {
         throw new \Exception("Kích thước ảnh quá lớn. Tối đa là " . ($this->maxFileSize / 1024 / 1024) . "MB");
      }

      // Verify MIME type
      $finfo = new \finfo(FILEINFO_MIME_TYPE);
      $mimeType = $finfo->file($file['tmp_name']);

    
      if (!in_array($mimeType, $this->allowedMimeTypes)) {
         throw new \Exception("Định dạng ảnh không hợp lệ. Chỉ chấp nhận: JPEG, PNG, GIF, WebP");
      }

      // Generate filename
      $fileName = $randomizeName
         ? $this->generateUniqueFileName($file['name'])
         : $this->sanitizeFileName($file['name']);
      $uploadPath = $this->uploadDir . $fileName;

      // Move uploaded file
      if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
         throw new \Exception("Không thể di chuyển tệp đã tải lên.");
      }

      return $uploadPath;
   }


   /**
    * Resize image while maintaining aspect ratio
    * 
    * @param string $sourcePath Path to source image
    * @param int $maxWidth Maximum width
    * @param int $maxHeight Maximum height
    * @return string Path to resized image
    */
   public function resizeImage(string $sourcePath, int $maxWidth, int $maxHeight): string
   {
      // Get image info
      $imageInfo = getimagesize($sourcePath);
      if (!$imageInfo) {
         throw new \Exception("Không thể đọc thông tin ảnh.");
      }

      // Create image resource based on mime type
      $mimeType = $imageInfo['mime'];
      $sourceImage = $this->createImageFromFile($sourcePath, $mimeType);

      // Calculate new dimensions
      $width = $imageInfo[0];
      $height = $imageInfo[1];
      $ratio = $width / $height;

      if ($width > $maxWidth || $height > $maxHeight) {
         if ($maxWidth / $maxHeight > $ratio) {
            $newWidth = floor($maxHeight * $ratio);
            $newHeight = $maxHeight;
         } else {
            $newWidth = $maxWidth;
            $newHeight = floor($maxWidth / $ratio);
         }
      } else {
         $newWidth = $width;
         $newHeight = $height;
      }

      // Create new image
      $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

      // Handle transparency for PNG and GIF
      if ($mimeType == 'image/png' || $mimeType == 'image/gif') {
         imagecolortransparent($resizedImage, imagecolorallocatealpha($resizedImage, 0, 0, 0, 127));
         imagealphablending($resizedImage, false);
         imagesavealpha($resizedImage, true);
      }

      // Resize
      imagecopyresampled(
         $resizedImage,
         $sourceImage,
         0,
         0,
         0,
         0,
         $newWidth,
         $newHeight,
         $width,
         $height
      );

      // Generate output path
      $pathInfo = pathinfo($sourcePath);
      $resizedPath = $this->uploadDir . $pathInfo['filename'] . "_resized." . $pathInfo['extension'];

      // Save resized image
      $this->saveImage($resizedImage, $resizedPath, $mimeType);

      // Free up memory
      imagedestroy($sourceImage);
      imagedestroy($resizedImage);

      return $resizedPath;
   }

   /**
    * Generate a unique filename
    * 
    * @param string $originalName Original filename
    * @return string Unique filename
    */
   private function generateUniqueFileName(string $originalName): string
   {
      $extension = pathinfo($originalName, PATHINFO_EXTENSION);
      return uniqid('img_', true) . '.' . $extension;
   }

   /**
    * Sanitize filename
    * 
    * @param string $fileName Original filename
    * @return string Sanitized filename
    */
   private function sanitizeFileName(string $fileName): string
   {
      // Remove special characters
      $fileName = preg_replace("/[^a-zA-Z0-9.]/", "", $fileName);
      return $fileName;
   }

   /**
    * Create image resource from file
    * 
    * @param string $sourcePath Path to image file
    * @param string $mimeType MIME type of image
    * @return \GdImage Image resource
    */
   private function createImageFromFile(string $sourcePath, string $mimeType): \GdImage
   {
      switch ($mimeType) {
         case 'image/jpeg':
            return imagecreatefromjpeg($sourcePath);
         case 'image/png':
            return imagecreatefrompng($sourcePath);
         case 'image/gif':
            return imagecreatefromgif($sourcePath);
         case 'image/webp':
            return imagecreatefromwebp($sourcePath);
         default:
            throw new \Exception("Không hỗ trợ định dạng ảnh này.");
      }
   }

   /**
    * Save image based on MIME type
    * 
    * @param \GdImage $image Image resource
    * @param string $path Save path
    * @param string $mimeType MIME type of image
    */
   private function saveImage($image, string $path, string $mimeType)
   {
      switch ($mimeType) {
         case 'image/jpeg':
            imagejpeg($image, $path, 85);
            break;
         case 'image/png':
            imagepng($image, $path, 8);
            break;
         case 'image/gif':
            imagegif($image, $path);
            break;
         case 'image/webp':
            imagewebp($image, $path, 85);
            break;
      }
   }

   /**
    * Get human-readable upload error message
    * 
    * @param int $errorCode Upload error code
    * @return string Error message
    */
   private function getUploadErrorMessage(int $errorCode): string
   {
      $errorMessages = [
         UPLOAD_ERR_INI_SIZE => "Kích thước tệp vượt quá giới hạn upload_max_filesize trong php.ini",
         UPLOAD_ERR_FORM_SIZE => "Kích thước tệp vượt quá giới hạn MAX_FILE_SIZE trong form",
         UPLOAD_ERR_PARTIAL => "Tệp chỉ được tải lên một phần",
         UPLOAD_ERR_NO_FILE => "Không có tệp nào được tải lên",
         UPLOAD_ERR_NO_TMP_DIR => "Thiếu thư mục tạm thời",
         UPLOAD_ERR_CANT_WRITE => "Không thể ghi tệp vào ổ đĩa",
         UPLOAD_ERR_EXTENSION => "Một phần mở rộng PHP đã dừng quá trình tải tệp"
      ];

      return $errorMessages[$errorCode] ?? "Lỗi không xác định khi tải tệp";
   }
}
