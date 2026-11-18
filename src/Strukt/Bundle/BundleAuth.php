<?php

declare(strict_types=1);

namespace Strukt\Bundle;

use Strukt\Framework\Bundle\AppSource;
use Strukt\Framework\ConfigLoader;
use Strukt\Framework\Contract\Bundle as BundleInterface;

/**
 * Auth bundle descriptor.
 *
 * WARNING: THIS FILE IS AUTO-GENERATED. DO NOT ADD ANYTHING
 * BECAUSE IT WILL BE OVERWRITTEN.
 */
class BundleAuth implements BundleInterface
{
    private array $manifest = [
        'cmd_name' => 'Auth',
        'bundle' => 'bundle-auth',
        'files' => [
            'app/src/App/AuthModule/Controller/User.sgf',
            'app/src/App/AuthModule/Form/ResetPassword.sgf',
            'app/src/App/AuthModule/Form/User.sgf',
            'app/src/App/AuthModule/Router/Auth.sgf',
            'app/src/App/AuthModule/Router/Index.sgf',
            'app/src/App/AuthModule/Router/Rbac.sgf',
            'app/src/App/AuthModule/Seed/Rbac.sgf',
            'app/src/App/AuthModule/Service/Rbac.sgf',
            'app/src/App/AuthModule/Tests/UserTest.sgf',
            'app/src/App/AuthModule/{{app}}AuthModule.sgf',
            'app/src/App/Permission.sgf',
            'app/src/App/PermissionRole.sgf',
            'app/src/App/Role.sgf',
            'app/src/App/RoleUser.sgf',
            'app/src/App/User.sgf',
            'lib/App/Command/ResetPassword.php',
            'lib/App/Provider/Auth.php',
            'lib/App/Provider/Database.php',
            'lib/App/Provider/Session.php',
        ],
        'modules' => [
            'AuthModule',
        ],
    ];

    public function getSettings(string $type): array
    {
        $settings = [
            'App:Cli' => [
                'providers' => [
                    \App\Provider\Database::class,
                ],
                'middlewares' => [],
                'commands' => [
                    \App\Command\ResetPassword::class,
                ],
            ],
            'App:Idx' => [
                'providers' => [
                    \App\Provider\Session::class,
                    \App\Provider\Database::class,
                    \App\Provider\Auth::class,
                ],
                'middlewares' => [],
            ],
        ];

        return $settings[$type] ?? [];
    }

    public function getName(): string
    {
        return $this->manifest['bundle'];
    }

    public function getCmdName(): ?string
    {
        return $this->manifest['cmd_name'];
    }

    public function getFiles(): ?array
    {
        return $this->manifest['files'];
    }

    public function getModules(): ?array
    {
        if ($this->manifest['modules'] === []) {
            return null;
        }

        $app = $this->app();
        if ($app === '') {
            return null;
        }

        return array_map(
            static fn (string $module): string => sprintf('%s\\%s\\%s%s', $app, $module, $app, $module),
            $this->manifest['modules'],
        );
    }

    public function isPublished(): bool
    {
        $modules = $this->getModules() ?? [];

        return $modules !== [] && class_exists($modules[0]);
    }

    public function getRequirements(): ?array
    {
        return ['core'];
    }

    public function postInstall(): void
    {
    }

    public function preInstall(): void
    {
    }

    private function app(): string
    {
        return AppSource::create(ConfigLoader::root())->appName();
    }
}
