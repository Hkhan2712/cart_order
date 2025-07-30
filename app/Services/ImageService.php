<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload and create multiple image sizes (original, medium, thumbnail).
     *
     * @param UploadedFile $image
     * @param string $folder
     * @return array
     */
    public function uploadWithSizes(UploadedFile $image, string $folder = 'uploads'): array
    {
        $extension = $image->getClientOriginalExtension();
        $baseName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $uniqueId = uniqid();
        $fileName = "{$baseName}_{$uniqueId}.{$extension}";

        $paths = [];

        // Store original
        $originalPath = "{$folder}/original/{$fileName}";
        Storage::disk('public')->putFileAs("{$folder}/original", $image, $fileName);
        $paths['original'] = $originalPath;

        // Medium resize (768x768)
        $paths['medium'] = $this->resizeAndSave($image, 768, 768, "{$folder}/medium", $fileName);

        // Thumbnail resize (300x300)
        $paths['thumbnail'] = $this->resizeAndSave($image, 300, 300, "{$folder}/thumb", $fileName);

        return $paths;
    }

    /**
     * Resize and save image to public disk.
     *
     * @param UploadedFile $image
     * @param int $width
     * @param int $height
     * @param string $folder
     * @param string $fileName
     * @return string
     */
    protected function resizeAndSave(UploadedFile $image, int $width, int $height, string $folder, string $fileName): string
    {
        $imageObject = $this->manager->read($image->getRealPath());

        $imageObject->scale(
            width: $width,
            height: $height
        );

        $encodedImage = $imageObject->toJpeg(); // hoặc toPng() tùy loại

        $path = "{$folder}/{$fileName}";
        Storage::disk('public')->put($path, (string) $encodedImage);

        return $path;
    }
}
