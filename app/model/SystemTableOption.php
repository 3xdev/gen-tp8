<?php

namespace app\model;

class SystemTableOption extends Base
{
    // 操作类型定义
    public const TABLE_OPTION_TYPE_ADD = 'add';
    public const TABLE_OPTION_TYPE_EDIT = 'edit';
    public const TABLE_OPTION_TYPE_DELETE = 'delete';
    public const TABLE_OPTION_TYPE_BDELETE = 'bdelete';
    public const TABLE_OPTION_TYPE_VIEW = 'view';
    public const TABLE_OPTION_TYPE_EXPORT = 'export';
    public const TABLE_OPTION_TYPE_FORM = 'form';
    public const TABLE_OPTION_TYPE_TABLE = 'table';
    public const TABLE_OPTION_TYPE_REQUEST = 'request';
    public const TABLE_OPTION_TYPE_PAGE = 'page';

    public function setActionAttr($value, $data)
    {
        if (!empty($value)) {
            return $value;
        }
        switch ($data['type']) {
            case self::TABLE_OPTION_TYPE_ADD:
                $value = 'create';
                break;
            case self::TABLE_OPTION_TYPE_EDIT:
                $value = 'update';
                break;
            case self::TABLE_OPTION_TYPE_DELETE:
            case self::TABLE_OPTION_TYPE_BDELETE:
                $value = 'delete';
                break;
            default:
                break;
        }
        return $value;
    }

    public function getRequestAttr($value, $data)
    {
        if (!in_array($data['type'], [self::TABLE_OPTION_TYPE_FORM, self::TABLE_OPTION_TYPE_REQUEST])) {
            return [];
        }

        $path_crud = '/api/admin/crud/' . $this->btable->code;
        $map_crud = [
            'create' => ['method' => 'post', 'url' => $path_crud],
            'update' => ['method' => 'put', 'url' => $path_crud . '/{{ids}}'],
            'delete' => ['method' => 'delete', 'url' => $path_crud . '/{{ids}}'],
        ];
        if (isset($map_crud[$data['action']])) {
            return $map_crud[$data['action']];
        }

        $path_rest = '/api/admin/rest/' . $this->btable->code;
        return preg_match('/^(get|post|put|delete)(\w+)$/', $data['action'], $matches) ? [
            'method' => $matches[1],
            'url' => $path_rest . '/' . strtolower($matches[2]) . '/{{ids}}'
        ] : [];
    }

    public function btable()
    {
        return $this->belongsTo(SystemTable::class, 'table_code', 'code');
    }
}
