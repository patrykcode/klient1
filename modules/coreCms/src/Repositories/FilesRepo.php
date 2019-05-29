<?php

namespace Cms\Core\Repositories;

class FilesRepo {

    protected $extensions = ["jpeg", "jpg", "png"];
    public $disc = 'public';
    protected $path;
    protected $public_path;
    public static $instance;

    public function __construct($disc) {
        $this->path = config('filesystems.disks.' . $disc . '.root');
        $this->public_path = config('filesystems.disks.' . $disc . '.url');

        if (!is_null($disc)) {
            $this->disc = $disc;
        }
    }

    public static function getInstance($disc) {
        if (!isset(self::$instance)) {
            self::$instance = new static($disc);
        }
        return self::$instance;
    }

    public function setDisc($param) {
        $this->disc = $param;
        return $this;
    }

    public function getDisc() {
        return $this->disc;
    }

    /**
     * upload plików i kadrowanie zdjęć
     * @param type $file
     * @param type $pathToUpload
     * @param type $crop size
     * @param type $size
     */
    public function uploadFile($file, $pathToUpload, $crop = [1900, 900], $size = [], $type_resize = 'aspecto') {
        if ($file) {
            $path = \Storage::disk($this->disc)->getAdapter()->getPathPrefix();
            $filename = \Storage::disk($this->disc)->put($pathToUpload, $file);
            if (in_array($file->extension(), $this->extensions)) {
                $this->thumb($path . $filename, $crop, $size, $type_resize);
            } elseif ($file->extension() == 'zip') {
                $files = $this->unzip($this->path . $filename, $pathToUpload);
                $filesName = [];
                if (!empty($files)) {
                    foreach ($files as $file_to_thumb) {
                        $filesName[] = $this->public_path . $pathToUpload . '/' . $file_to_thumb;
                        $this->thumb($this->path . $pathToUpload . '/' . $file_to_thumb, $crop, $size, $type_resize);
                    }
                }
                return $filesName;
            }
            return $this->public_path . $filename;
        }
        return false;
    }

    public function unzip($file, $path_to_unpack) {
        $files = [];
        if (realpath($file)) {
            $zip = new \ZipArchive;
            $zipped = $zip->open($file);
            if ($zipped) {
                //dodanie plików do tablicy
                if ($zip->numFiles) {
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $stat = $zip->statIndex($i);
                        $tmpname = pathinfo($stat['name']);
                        $files[$i] = md5($tmpname["basename"] . microtime(true)) . '.' . $tmpname["extension"];
                        $zip->renameName($stat['name'], $files[$i]);
                    }
                }
                $zip->close();
                $zipped = $zip->open($file);
                if ($zipped) {
                    $extract = $zip->extractTo($this->path . $path_to_unpack);
                }
                $zip->close();
            }
        }
        return $files;
    }

    public function deleteWhereIn($request, $inputName = 'images') {
        $array = collect($request->input('images'))->filter(function ($value, $key) {
                    return isset($value['del']);
                })->each(function($item) {
            $this->delete($item['img']);
        });
    }

    public function delete($filename) {
//        \Storage::disk($this->disc)->delete($filename);
//        \Storage::disk($this->disc)->delete(str_replace('.', '_crop.', $filename));
        \File::delete($filename);
        \File::delete(str_replace('.', '_crop.', $filename));
    }

    public function deleteDir($file) {
        return \Storage::disk($this->disc)->deleteDirectory($file); //\File::deleteDirectory($file);
    }

    public function thumb($filename, $crop_area = [], $size = [], $option = 'resize') {

        if (!empty($size)) {
            $this->resize($filename, $size, $option);
        }
        $cropImg = $this->crop($filename, $crop_area);
        return $cropImg; //self::resize($cropImg, [$widthResize / 5, $heightResize / 5], $option);
    }

    /**
     * kadrowanie zdjecia
     * @param type $filename
     * @param type $crop_area width,height,top,left albo inna kolejnosc top-left
     * @param type $save_file
     * @return boolean
     */
    public function crop($filename, $crop_area = [], $save_file = null) {
        if (file_exists($filename)) {
            $file = pathinfo($filename);
            $file_size = getimagesize($filename);
            $image = \Image::make($filename);
            $image->crop(isset($crop_area[0]) ? $crop_area[0] : $file_size[0], isset($crop_area[1]) ? $crop_area[1] : $file_size[1], isset($crop_area[2]) ? $crop_area[2] : null, isset($crop_area[3]) ? $crop_area[3] : null);
            $save_path = $save_file == null ? $file["dirname"] . '/' . $file["filename"] . '_crop.' . $file["extension"] : $save_file;
            $image->save($save_path);
            return $save_path;
        }
        return false;
    }

    /**
     * skalowanie obrazka
     * @param type $filename
     * @param type $size
     * @param type $option
     */
    public function resize($filename, $size = [], $option = 'resize') {

        if (file_exists(realpath($filename)) && !empty($size)) {
            $img = \Image::make($filename);

            switch ($option) {
                case 'resize':
                    $img->resize($size[0], $size[1]);
                    break;
                case 'aspecto':
                    $img->resize($size[0], $size[1], function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    break;
            }
            $img->save();
            return true;
        }
        return false;
    }

}
