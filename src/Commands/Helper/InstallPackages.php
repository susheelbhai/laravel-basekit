<?php

namespace Susheelbhai\Basekit\Commands\Helper;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class InstallPackages
{
    /**
     * Install all Composer and NPM dependencies for both Blade and Inertia stacks (runtime mode via .env).
     */
    public function installAll($this_data): void
    {
        $this->composer($this_data);
        $this->installAllNpm($this_data);
        $this->ensurePackageJsonScripts($this_data);
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
            'spatie/laravel-sitemap',
            'laravel/socialite',
            'socialiteproviders/amazon',
            'socialiteproviders/apple',
            'intervention/image',
            'tightenco/ziggy',
            'inertiajs/inertia-laravel',
        ];
        $this->ensureComposerPackages($this_data, $composerPackages);
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

        $this->ensureNpmPackages($this_data, $npmPackages);
    }

    /**
     * Install and verify Composer packages; auto-retry up to 3 times, then optionally prompt.
     */
    private function ensureComposerPackages(Command $command, array $packageNames): void
    {
        for ($attempt = 0; $attempt < 4; $attempt++) {
            $this->installComposerPackages($command, $packageNames);
            $missing = $this->missingComposerPackages($packageNames);
            if ($missing === []) {
                $command->info('All required Composer packages are present.');

                return;
            }
            $command->warn('Composer package(s) not detected: '.implode(', ', $missing));
            if ($attempt < 3) {
                $command->line('Retrying Composer install...');
            }
        }

        if (! $command->confirm('Some Composer packages are still missing after 3 retries. Do you want to retry installation? (No = skip and continue)', false)) {
            $command->warn('Skipping further Composer installation attempts.');

            return;
        }

        $this->installComposerPackages($command, $packageNames);
        $missing = $this->missingComposerPackages($packageNames);
        if ($missing === []) {
            $command->info('All required Composer packages are present.');
        } else {
            $command->error('Composer packages still missing: '.implode(', ', $missing));
        }
    }

    /**
     * Install and verify NPM packages; auto-retry up to 3 times, then optionally prompt.
     */
    private function ensureNpmPackages(Command $command, array $packageNames): void
    {
        for ($attempt = 0; $attempt < 4; $attempt++) {
            $this->installNpmPackages($command, $packageNames);
            $missing = $this->missingNpmPackages($packageNames);
            if ($missing === []) {
                $command->info('All required NPM packages are present.');

                return;
            }
            $command->warn('NPM package(s) not detected in package.json: '.implode(', ', $missing));
            if ($attempt < 3) {
                $command->line('Retrying NPM install...');
            }
        }

        if (! $command->confirm('Some NPM packages are still missing after 3 retries. Do you want to retry installation? (No = skip and continue)', false)) {
            $command->warn('Skipping further NPM installation attempts.');

            return;
        }

        $this->installNpmPackages($command, $packageNames);
        $missing = $this->missingNpmPackages($packageNames);
        if ($missing === []) {
            $command->info('All required NPM packages are present.');
        } else {
            $command->error('NPM packages still missing: '.implode(', ', $missing));
        }
    }

    /**
     * @return list<string> original specs still absent from the Composer install
     */
    private function missingComposerPackages(array $packageNames): array
    {
        $installed = $this->installedComposerPackageNames();
        $missing = [];
        foreach ($packageNames as $pkg) {
            $name = strtolower($this->normalizeComposerPackageName($pkg));
            if ($name === '' || ! isset($installed[$name])) {
                $missing[] = $pkg;
            }
        }

        return $missing;
    }

    /**
     * @return list<string> original specs still absent from package.json
     */
    private function missingNpmPackages(array $packageNames): array
    {
        $declared = $this->packageJsonDependencyKeys();
        $missing = [];
        foreach ($packageNames as $pkg) {
            $displayName = $this->normalizeNpmPackageName($pkg);
            if ($displayName === '' || ! isset($declared[$displayName])) {
                $missing[] = $pkg;
            }
        }

        return $missing;
    }

    /**
     * Install multiple NPM packages by name.
     */
    private function installNpmPackages($this_data, array $packageNames)
    {
        $declared = $this->packageJsonDependencyKeys();
        $missing = [];

        foreach ($packageNames as $pkg) {
            $displayName = $this->normalizeNpmPackageName($pkg);
            if ($displayName !== '' && isset($declared[$displayName])) {
                $this_data->info("NPM package \"{$displayName}\" is already installed, skipping.");

                continue;
            }
            $missing[] = $pkg;
        }

        if ($missing === []) {
            return;
        }

        $cmd = array_merge(['npm', 'install'], $missing);
        $label = 'NPM packages: '.implode(', ', $missing);
        $this->installPackage($this_data, $cmd, $label);
    }

    /**
     * Install multiple Composer packages by name.
     */
    private function installComposerPackages($this_data, array $packageNames)
    {
        $installed = $this->installedComposerPackageNames();
        $missing = [];

        foreach ($packageNames as $pkg) {
            $name = strtolower($this->normalizeComposerPackageName($pkg));
            if ($name !== '' && isset($installed[$name])) {
                $this_data->info("Composer package \"{$name}\" is already installed, skipping.");

                continue;
            }
            $missing[] = $pkg;
        }

        if ($missing === []) {
            return;
        }

        $cmd = array_merge(['composer', 'require', '--no-interaction'], $missing);
        $label = 'Composer packages: '.implode(', ', $missing);
        $this->installPackage($this_data, $cmd, $label);
    }

    private function normalizeComposerPackageName(string $spec): string
    {
        return explode(':', $spec, 2)[0];
    }

    /**
     * @return array<string, true> lowercased package name => true
     */
    private function installedComposerPackageNames(): array
    {
        // Do not pass --quiet: Composer suppresses JSON output and the list would be empty.
        $process = new Process(['composer', 'show', '--format=json', '--no-ansi'], \base_path());
        $process->run();

        if (! $process->isSuccessful()) {
            return [];
        }

        $data = json_decode($process->getOutput(), true);
        if (! is_array($data)) {
            return [];
        }

        $list = [];
        if (isset($data['installed']) && is_array($data['installed'])) {
            $list = $data['installed'];
        } elseif (array_is_list($data)) {
            $list = $data;
        }

        $set = [];
        foreach ($list as $pkg) {
            if (is_array($pkg) && isset($pkg['name']) && is_string($pkg['name']) && $pkg['name'] !== '') {
                $set[strtolower($pkg['name'])] = true;
            }
        }

        return $set;
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

    /**
     * Keys from package.json dependency sections (exact names as declared).
     *
     * @return array<string, true>
     */
    private function packageJsonDependencyKeys(): array
    {
        $path = \base_path('package.json');
        if (! is_readable($path)) {
            return [];
        }

        $json = json_decode((string) file_get_contents($path), true);
        if (! is_array($json)) {
            return [];
        }

        $deps = array_merge(
            $json['dependencies'] ?? [],
            $json['devDependencies'] ?? [],
            $json['peerDependencies'] ?? [],
        );

        return array_fill_keys(array_keys($deps), true);
    }

    private function installPackage($this_data, array $command, string $label)
    {
        $this_data->line("📦 Installing {$label} ...");
        $streamTag = $this->streamTagForCommand($command);
        $this->runCommand($this_data, $command, $streamTag);
        $this_data->info("✅ Finished installing {$label}");
        $this_data->line('');
        $this_data->line('');
    }

    /**
     * Short tag for subprocess log lines (avoids repeating a long package list on every line).
     */
    private function streamTagForCommand(array $command): string
    {
        $bin = $command[0] ?? 'cmd';

        return match ($bin) {
            'composer' => 'composer',
            'npm' => 'npm',
            default => $bin,
        };
    }

    private function runCommand($this_data, array $command, string $streamTag, ?string $workingDir = null)
    {
        $process = new Process($command, $workingDir ?? \base_path());
        $process->setTimeout(null);

        $process->run(function ($type, $buffer) use ($this_data, $streamTag) {
            $this_data->line("[{$streamTag}] {$buffer}");
        });

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    private function ensurePackageJsonScripts($this_data): void
    {
        $path = \base_path('package.json');
        if (!is_readable($path)) {
            return;
        }

        $json = json_decode((string) file_get_contents($path), true);
        if (!is_array($json)) {
            return;
        }

        if (!isset($json['scripts']['build:check'])) {
            $json['scripts']['build:check'] = 'vite build --mode production';
            file_put_contents($path, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
            $this_data->info('Added "build:check" script to package.json');
        }
    }
}
