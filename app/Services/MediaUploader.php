<?php

namespace App\Services;

use App\Models\Media;
use Storage;
use Image;


class MediaUploader {

    public function oneImageUpload($file, $designation, int $user_id, array &$opts) {

        $opts = array_merge(['resize' => [], 'name_prefix' => 'img_', 'path' => 'images', 'disk' => 'public'], $opts);

        $image = $file;
        $media = Media::whereUserId($user_id)->where('designation', $designation);
        $media = $media->count() > 0 ? $media : null;

        $fileName = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' .$image->getClientOriginalExtension();
        $fileMimeType = $image->getMimeType();
        $fileSize = $image->getSize();
        $filePath = $image->storeAs($opts['path'].'/originals', $fileName, $opts['disk']);

        if (!empty($opts['resize'])) {

            $invertionImg = Image::make($image)
                        ->resize((int)$opts['resize']['width'], (int)$opts['resize']['height'], function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save();

            $image->storeAs($opts['path'].'/smalls/'.$opts['resize']['width'].'x'.$opts['resize']['height'], $fileName, $opts['disk']);

        }


        $data = ['user_id' => $user_id, 'designation' => $designation, 'name' => str_replace($opts['path']."/originals/", "", $filePath), 'mime_type' => $fileMimeType, 'size' => $fileSize];

        if ($media == null) {
            Media::create($data);
        } else {
            $media = $media->first();

            $path_arr = ['path' => $opts['path'], 'disk' => $opts['disk']];

            $this->deleteFile($media->name, $path_arr);

            $media->update($data);
        }

    }

    public function multiImageUpload($files, $designation, int $user_id, array &$opts) {

        $opts = array_merge(['resize' => [], 'name_prefix' => 'img_', 'path' => 'images', 'disk' => 'public'], $opts);

        $images = $files;
        $media = Media::whereUserId($user_id)->where('designation', $designation);
        $media = $media->count() > 0 ? $media : null;

        $names = [];
        $fileMimeTypes = [];
        $fileSizes = [];


        foreach ($images as $key => $image) {
            $fileName = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' . $image->getClientOriginalExtension();
            $fileOriginalName = $image->getClientOriginalName();
            $fileMimeType = $image->getMimeType();
            $fileSize = $image->getSize();
            $pathOriginals = $image->storeAs($opts['path'] . '/originals', $fileName, $opts['disk']);

            $names[$opts['name_prefix'].$key] = str_replace($opts['path'] . "/originals/", "", $pathOriginals);
            $fileMimeTypes[$opts['name_prefix'].$key] = $fileMimeType;
            $fileSizes[$opts['name_prefix'].$key] = $fileSize;

            if (!empty($opts['resize'])) {

                foreach ($opts['resize'] as $resize) {
                    $invertionImg = Image::make($image)
                        ->resize((int)$resize['width'], (int)$resize['height'], function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save();

                    $image->storeAs($opts['path'] . '/smalls/' . (int)$resize['width'] . 'x' . (int)$resize['height'], $fileName, $opts['disk']);
                }

            }

        }

        $data = ['user_id' => $user_id, 'designation' => $designation, 'name' => null, 'mime_type' => json_encode($fileMimeTypes), 'size' => json_encode($fileSizes)];


        if ($media == null) {
            $data['name'] = json_encode($names);
            Media::create($data);
        } else {
            $media = $media->first();

            # удаление всех фото с директорий
            foreach ($names as $key => $name) {
                if ( array_key_exists($key,  (array) $media->name )) {
                    $path_arr = ['path' => $opts['path'], 'disk' => $opts['disk']];
                    $this->deleteFile($media->name[$key], $path_arr);
                }
            }

            $data['name'] = json_encode(array_merge((array) $media->name, $names));
            $data['mimeType'] = json_encode(array_merge((array) $media->mimeType, $fileMimeTypes));
            $data['size'] = json_encode(array_merge((array) $media->size, $fileSizes));

            $media->update($data);

        }
    }

    public function uploadFile($file, array &$opts)
    {
        $opts = array_merge(['path' => 'images', 'disk' => 'public'], $opts);

        $fileName = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($opts['path'] . '/', $fileName, $opts['disk']);
        $path = str_replace($opts['path'], "", $path);

        return $path;
    }

    public function deleteFile($filename,  array &$opts)
    {
        $opts = array_merge(['path' => 'images', 'disk' => 'public'], $opts);

        $paths = $this->searchFile(Storage::disk($opts['disk'])->path($opts['path']), $filename);

        foreach ($paths as $path) {
            unlink($path);
        }
    }

    public function searchFile($folderName, $fileName, &$results = array())
    {
        $files = scandir($folderName);

        foreach($files as $key => $value) {

            $path = realpath($folderName.DIRECTORY_SEPARATOR.$value);
            $checkPath = (string) $folderName.DIRECTORY_SEPARATOR.$fileName;

            if ($path == $checkPath)
            {
                $results[] = $path;
            }
            if (!is_dir($path)){
                //
            }
            else if ($value != "." && $value != "..") {
                $this->searchFile($path, $fileName,$results);
            }

        }

        return $results;
    }


}