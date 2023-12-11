<?php

namespace App\Traits;

use App\Models\Document;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

trait TransformTree
{

    /**
     * @param $section
     * @return array
     */
    public function transform($section): array
    {


        if ($section->children) {

            $item = [
                'id' => $section->id,
                '_id' => 'sec_' . $section->id,
                'name' => $section->name,
                'is_dir' => true,
                'slug' => $section->slug,
                'is_share' => $section->is_share,
                'parent_id' => $section->p_id,
            ];

            foreach ($section->children as $value) {
                $item['children'][] = $this->transform($value);
            }
            foreach ($section->documents as $document) {
                $item['children'][] = $this->transformDocument($document);
            }

            return $item;

        }

        return [
            'id' => $section->id,
            '_id' => 'sec_' . $section->id,
            'name' => $section->name,
            'is_dir' => true,
            'slug' => $section->slug,
            'is_share' => $section->is_share,
            'parent_id' => $section->p_id,
        ];

    }

    /**
     * @param Document $document
     * @return array
     */
    public function transformDocument(Document $document): array
    {
        $fileType = Storage::mimeType($document->url);

        return [
            'id' => $document->id,
            '_id' => 'doc_' . $document->id,
            'name' => $document->name,
            'is_dir' => false,
            'url' => $document->url,
            'file_type' => $this->isVideo($fileType) ? 'video' : 'file',
            'p_id' => $document->section_id
        ];
    }

    /**
     * @param $fileType
     * @return bool
     */
    public function isVideo($fileType): bool
    {
        $fileTypes = ['video/x-flv', 'video/mp4', 'application/x-mpegURL', 'video/MP2T', 'video/3gpp', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv', 'video/webm'];
        return in_array($fileType, $fileTypes);
    }

    /**
     * @param Section $section
     * @param $path
     * @return array
     */
    public function readDirectory(Section $section, $path = null): array
    {
        if (!$path)
            $path = $section->slug;

        $dirs = Storage::disk('public')->directories($path);
        $files = Storage::disk('public')->files($path);

        $result = [];

        foreach ($dirs as $dir) {
            $result[] = [
                'name' => basename($dir),
                'is_dir' => true,
                'slug' => $dir,
                'is_share' => true,
                'parent_id' => $section->id,

            ];
        }
        foreach ($files as $file) {
            $fileType = Storage::disk('public')->mimeType($file);

            $result[] = [
                'name' => basename($file),
                'is_dir' => false,
                'url' => $file,
                'file_type' => $this->isVideo($fileType) ? 'video' : 'file'
            ];

        }

        return $result;
    }
}
