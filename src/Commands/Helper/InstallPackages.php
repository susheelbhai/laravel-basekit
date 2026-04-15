<?php

namespace Susheelbhai\Basekit\Commands\Helper;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class InstallPackages
{
    /**
     * Install all Composer and NPM dependencies for both Blade and Inertia stacks (runtime mode via .env).
     */
    public function installAll($this_data): void
    {
        $this->composer($this_data);
        $this->installAllNpm($this_data);
    }

    public function composer($this_data)
    {
        $this_data->info('Installing composer packages...');
        $composerPackages = [
            'susheelbhai/laratsapp',
            'laravel/fortify',
            'livewire/livewire',
            'livewire/volt',
            'spatie/laravel-permission',
            'spatie/laravel-medialibrary',
            'laravel/socialite',
            'socialiteproviders/amazon',
            'socialiteproviders/apple',
            'intervention/image',
            'tightenco/ziggy',
            'inertiajs/inertia-laravel',
        ];
        $this->installComposerPackages($this_data, $composerPackages);
    }

    private function installAllNpm($this_data): void
    {
        $this_data->info('Installing NPM packages...');

        $npmPackages = [
            'radix-ui',
            'react-day-picker',
            'date-fns',
            'axios',
            'lucide-react',
            'react-icons',
            'sweetalert2',
            'react-select',
            'alpinejs',
            '@vitejs/plugin-react@^5',
            '@headlessui/react',
            '@inertiajs/react',
            'class-variance-authority',
            'tw-animate-css',
            'tailwind-merge',
        ];

        $this->installNpmPackages($this_data, $npmPackages);
    }

    /**
     * Install multiple NPM packages by name.
     * @param $this_data
     * @param array $packageNames
     */
    private function installNpmPackages($this_data, array $packageNames)
    {
        foreach ($packageNames as $pkg) {
            if ($this->npmPackageInstalled($pkg)) {
                $displayName = $this->normalizeNpmPackageName($pkg);
                $this_data->info("NPM package \"{$displayName}\" is already installed, skipping.");

                continue;
            }
            $this->installPackage($this_data, ['npm', 'install', $pkg], "NPM package: $pkg");
        }
    }

    /**
     * Install multiple Composer packages by name.
     * @param $this_data
     * @param array $packageNames
     */
    private function installComposerPackages($this_data, array $packageNames)
    {
        foreach ($packageNames as $pkg) {
            $name = $this->normalizeComposerPackageName($pkg);
            if ($this->composerPackageInstalled($name)) {
                $this_data->info("Composer package \"{$name}\" is already installed, skipping.");

                continue;
            }
            $this->installPackage($this_data, ['composer', 'require', $pkg], "Composer package: $pkg");
        }
    }

    private function normalizeComposerPackageName(string $spec): string
    {
        return explode(':', $spec, 2)[0];
    }

    private function composerPackageInstalled(string $packageName): bool
    {
        $process = new Process(['composer', 'show', $packageName, '--no-ansi', '--quiet'], \base_path());
        $process->run();

        return $process->isSuccessful();
    }

    /**
     * NPM spec may include a version range (e.g. "@vitejs/plugin-react@^5").
     */
    private function normalizeNpmPackageName(string $spec): string
    {
        $spec = trim($spec);
        if ($spec === '') {
            return '';
        }
        if (str_starts_with($spec, '@')) {
            // Use # delimiter so "/" inside [^/] is not treated as the end of the pattern.
            if (preg_match('#^(@[^/]+/[^@]+)(?:@.+)?$#', $spec, $m)) {
                return $m[1];
            }
        }
        if (preg_match('#^([^@]+)(?:@.+)?$#', $spec, $m)) {
            return $m[1];
        }

        return $spec;
    }

    private function npmPackageInstalled(string $packageSpec): bool
    {
        $path = \base_path('package.json');
        if (! is_readable($path)) {
            return false;
        }

        $json = json_decode((string) file_get_contents($path), true);
        if (! is_array($json)) {
            return false;
        }

        $name = $this->normalizeNpmPackageName($packageSpec);
        if ($name === '') {
            return false;
        }

        $deps = array_merge(
            $json['dependencies'] ?? [],
            $json['devDependencies'] ?? [],
            $json['peerDependencies'] ?? [],
        );

        return array_key_exists($name, $deps);
    }

    private function installPackage($this_data, array $command, string $label)
    {
        $this_data->line("📦 Installing {$label} ...");
        $this->runCommand($this_data, $command, $label);
        $this_data->info("✅ Finished installing {$label}");
        $this_data->line('');
        $this_data->line('');
    }

    private function runCommand($this_data, array $command, string $label, string $workingDir = null)
    {
        $process = new Process($command, $workingDir ?? \base_path());
        $process->setTimeout(null);

        $process->run(function ($type, $buffer) use ($this_data, $label, $command) {
            $cmd = implode(' ', $command);
            $this_data->line("[{$label}] {$buffer}");
        });

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
