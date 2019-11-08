<?php
declare(strict_types=1);

namespace app\Service\Auth;

use app\Service\Auth\Annotation\Auth;
use app\Service\Auth\Exception\AuthException;
use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use SplFileInfo;
use Symfony\Component\Finder\Finder;
use think\App;
use function array_map;
use function str_replace;
use function strlen;
use function substr;

/**
 * Trait InteractsWithAuth
 * @package app\Service\Auth
 * @property App    $app
 * @property Reader $reader
 */
trait InteractsWithScanAuth
{
    protected $baseDir;
    protected $controllerLayer;
    protected $apps = [];

    protected $namespaces = 'app\\';

    protected $permissions = [];
    protected $nodes = [];
    protected $controllers = [];

    /**
     * @return int
     * @throws AuthException
     */
    public function scanAuthAnnotation(): int
    {
        $this->baseDir         = $this->app->getBasePath();
        $this->controllerLayer = $this->app->config->get('route.controller_layer');
        $this->apps = [];

        $dirs = array_map(function ($app) {
            return $this->baseDir . $app . DIRECTORY_SEPARATOR . $this->controllerLayer;
        }, $this->apps);
        $dirs[] = $this->baseDir . $this->controllerLayer . DS;

        return $this->scanAnnotation($dirs);
    }

    /**
     * @param $dirs
     * @return int
     * @throws AuthException
     */
    protected function scanAnnotation($dirs): int
    {
        $this->permissions = [];
        $this->nodes = [];
        $this->controllers = [];

        foreach ($this->scanning($dirs) as $file) {
            /** @var SplFileInfo $file */
            $class = $this->parseClassName($file);
            try {
                $refClass = new ReflectionClass($class);
            } catch (ReflectionException $e) {
                throw new AuthException('load class fail: ' . $class, 0, $e);
            }
            if ($refClass->isAbstract() || $refClass->isTrait()) {
                continue;
            }
            // 是否多应用
            $isApp = (0 !== strpos($class, $this->namespaces . $this->controllerLayer));

            if ($isApp) {
                $controllerUrl = substr($class, strlen($this->namespaces));
                $appPos = strpos($controllerUrl, '\\');
                $appName = substr($controllerUrl, 0, $appPos);
                $controllerUrl = substr($controllerUrl, $appPos + strlen($this->controllerLayer . '\\') + 1);
                $controllerUrl = $appName. '/' . strtolower(str_replace('\\', '.', $controllerUrl));
            } else {
                $controllerUrl = substr($class, strlen($this->namespaces . $this->controllerLayer . '\\'));
                $controllerUrl = strtolower(str_replace('\\', '.', $controllerUrl));
            }


            foreach ($refClass->getMethods(ReflectionMethod::IS_PUBLIC) as $refMethod) {
                if ($refMethod->isStatic()) {
                    continue;
                }
                $methodName = $refMethod->getName();
                if (0 === strpos($methodName, '_')) {
                    continue;
                }

                $nodeUrl = $controllerUrl . '/' . strtolower($methodName);
                $methodPath = $class . '::' . $methodName;
                // $nodeDesc = $refMethod->getDocComment();

                /** @var Auth $auth */
                if ($auth = $this->reader->getMethodAnnotation($refMethod, Auth::class)) {
                    if (empty($auth->value)) {
                        throw new AuthException('annotation value not empty: ' . $methodPath);
                    }
                    $authStr = $this->parseAuth($auth->value, $controllerUrl, $methodName);
                    $this->permissions[$authStr][$methodPath] = $nodeUrl;
                    // 记录节点控制信息
                    $this->nodes['node@' . $nodeUrl] = [
                        'class' => $methodPath,
                        'policy' => $auth->policy,
                    ];
                }

                $this->controllers[$class][$methodName] = $nodeUrl;
            }
        }

        return count($this->permissions);
    }

    protected function parseAuth($auth, $controllerUrl, $methodName)
    {
        if ('self' === $auth) {
            return str_replace('/', '.', $controllerUrl) . '.' . strtolower($methodName);
        }
        return $auth;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @return array
     */
    public function getControllers(): array
    {
        return $this->controllers;
    }

    /**
     * @return array
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    protected function scanning($dirs)
    {
        $finder = new Finder();
        $finder->files()->in($dirs)->name('*.php');
        if (!$finder->hasResults()) {
            return;
        }
        foreach ($finder as $file) {
            yield $file;
        }
    }

    /**
     * 解析类命名（仅支持Psr4）
     * @param SplFileInfo $file
     * @return string
     */
    protected function parseClassName(SplFileInfo $file): string
    {
        $controllerPath = substr($file->getPath(), strlen($this->baseDir));

        $controllerPath = str_replace('/', '\\', $controllerPath);
        if (!empty($controllerPath)) {
            $controllerPath .= '\\';
        }

        $baseName = $file->getBasename(".{$file->getExtension()}");
        $className = $this->namespaces . $controllerPath . $baseName;
        return $className;
    }
}