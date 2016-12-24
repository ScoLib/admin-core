<?php

function success($message = '操作成功', $data = [])
{
    return callback(true, $message, $data);
}

function error($message = '操作失败', $data = [])
{
    return callback(false, $message, $data);
}

function callback($state, $message = '', $data = [])
{
    $result = [
        'state'   => $state,
        'message' => $message,
        'data'    => $data

    ];
    return $result;
}