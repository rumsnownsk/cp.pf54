<?php


namespace PHPFrw;


class File
{
    public string $imageNameDb = '';
    protected string $name;
    protected string $type;
    protected string $tmpName;
    protected int $error;
    protected int $size;
    public bool $isFile;

    protected string $parentFolder;
    protected string $pathToFileOnDisk;

    public function __construct($fileName='')
    {
        $fileName = $fileName ? $fileName : array_key_first(request()->files);
        $files = request()->files;

        $this->name = $files[$fileName]['name'] ?? '';
        $this->type = $files[$fileName]['type'] ?? '';
        $this->tmpName = $files[$fileName]['tmp_name'] ?? '';
        $this->error = $files[$fileName]['error'] ?? 4;
        $this->size = $files[$fileName]['size'] ?? 0;
        $this->isFile = (bool)$this->size;

        $this->createPath();
    }

    protected function createPath()
    {
        $this->parentFolder();

        $dir = IMAGES.'/'.$this->parentFolder;

        $dir .= '/'.date('Y').'/'.date('m').'/'.date('d');
        if (!is_dir($dir)){
            mkdir($dir, 0755, true);
        }

        $dir_url = str_replace(WWW, '', $dir);

        $file_name = md5($this->name.time().uniqid('', true)).'.'.$this->getExt();

        $file_url = $dir_url.'/'.$file_name;
        $this->pathToFileOnDisk = $dir.'/'.$file_name;

        $fileNameDb = preg_replace("/\/images\/{$this->parentFolder}/", '', $file_url);
        if ($fileNameDb){
            $this->imageNameDb = $fileNameDb;
        }
    }

    protected function parentFolder(): void
    {
        $field = array_key_first(request()->files);
        $field = strtolower(preg_replace('/photo/','', $field));
        $this->parentFolder = $field.'s';
    }

    public function save(): bool
    {
        if (!$this->isFile){
            return false;
        }

        if (move_uploaded_file($this->tmpName, $this->pathToFileOnDisk)){
            return true;
        }
        return false;
    }

    public function getExt(): string
    {
        $file_ext = explode('.',$this->name);
        return end($file_ext);
    }

    public function getName(): mixed
    {
        return $this->name;
    }

    public function getType(): mixed
    {
        return $this->type;
    }

    public function getTmpName(): mixed
    {
        return $this->tmpName;
    }

    public function getError(): int
    {
        return $this->error;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public static function remove (string $path, string $filename = null): void
    {
//        dump($path.$filename);
//        dd(file_exists($path.$filename));
        if (file_exists($path.$filename)){
            @unlink($path.$filename);
        }
    }
}