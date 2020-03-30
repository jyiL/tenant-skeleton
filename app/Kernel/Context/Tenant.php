<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Kernel\Context;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Traits\StaticInstance;
use Psr\Container\ContainerInterface;

class Tenant
{
    use StaticInstance;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var int
     */
    protected $id = 1;

    public function __construct()
    {
        $this->container = ApplicationContext::getContainer();
    }

    public function init()
    {
        $request = $this->container->get(RequestInterface::class);

        $id = $request->header('X-TENANT-ID');

        $this->id = $id % 2 + 1;
    }

    public function getId()
    {
        return $this->id;
    }
}
