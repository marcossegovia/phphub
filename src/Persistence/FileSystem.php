<?php

namespace Phphub\Persistence;

use Yosymfony\Toml\Exception\ParseException;
use Yosymfony\Toml\Toml;
use Yosymfony\Toml\TomlBuilder;

final class FileSystem
{
    public function get(string $key)
    {
        try {
            $entries = Toml::parseFile('.phphub/user.toml');
        } catch (ParseException $e) {
            return null;
        }
        if (!isset($entries['user'][$key])) {
            return null;
        }
        return $entries['user'][$key];
    }

    public function set(string $key, $value)
    {
        $tb = new TomlBuilder();

        $result = $tb->addComment('User file')
            ->addTable('user')
            ->addValue($key, $value, 'This is your Github token')
            ->getTomlString();

        if (!is_dir('.phphub')) {
            \mkdir('.phphub');
        }

        \file_put_contents(ROOT_DIR . '/.phphub/user.toml', $result);
    }
}
