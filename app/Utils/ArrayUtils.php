<?php


namespace App\Utils;


class ArrayUtils
{
    public static function buildTree(array $data, $parentId = 0)
    {
        $branch = [];

        foreach ($data as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($data, $element['id']);

                $element['children'] = $children;
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
