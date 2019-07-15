<?php
/**
 * Created by PhpStorm.
 * User: NHZEXG
 * Date: 2019/1/28
 * Time: 10:42
 */

namespace Basis;

/**
 * Class Ini
 * @package Basis
 *          TODO 更名为 EnvFormat
 */
class Ini
{
    const HEADER_DATE = 'date';

    /**
     * 写入Env
     * @param string $file_path
     * @param array $contents
     * @param string $header
     */
    public static function writerFile(string $file_path, iterable $contents, string $header = '')
    {
        if ($header === self::HEADER_DATE) {
            $header = '# Date:' . date('c') . "\n\n";
        }

        file_put_contents($file_path, $header . self::generate($contents));
    }

    /**
     * 写入Env
     * @param array $contents
     * @param string $header
     * @return string
     */
    public static function writer(array $contents, string $header = '')
    {
        if ($header === self::HEADER_DATE) {
            $header = '# Date:' . date('c') . "\n\n";
        }
        return $header . self::generate($contents);
    }

    /**
     * 生成常量文本
     * @param iterable $contents
     * @return string
     */
    protected static function generate(iterable $contents)
    {
        $text = '';
        $ts = '';
        foreach ($contents as $key => $value) {
            if (is_bool($value)) {
                $value = var_export($value, true);
            } elseif (is_numeric($value)) {
            } elseif (is_string($value)) {
                $value = "\"{$value}\"";
            }

            if (!empty($ts) && $ts !== substr($key, 0, 3)) {
                $text .= PHP_EOL;
            }
            $text .= "{$key}={$value}\n";
            $ts = substr($key, 0, 3);
        }
        return $text;
    }
}
