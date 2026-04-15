<?php

namespace Susheelbhai\Basekit\Commands;

use Exception;
use Illuminate\Console\Command;
use Susheelbhai\Basekit\Commands\Helper\EnvValue;
use Susheelbhai\Basekit\Commands\Helper\ConfigValue;

class initial_settings extends Command
{
    protected $signature = 'basekit:initial_settings';

    protected $description = 'To change some initial configuration which is required on starting new project';

    public $env_values = array(
        'APP_APPEARANCE' => 'system',
        'FILESYSTEM_DISK' => 'public',
        'SEND_MAIL' => 1,
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => '127.0.0.1',
        'APP_TIMEZONE' => 'Asia/Kolkata',
        'MAIL_PORT' => '1025',
        'WATERMARK' => 1,
        'ADMIN_MAIL' => 'admin@example.com',
        'ADMIN_NAME' => 'Admin',
        'QUEUE_CONNECTION' => 'sync',
        'APP_RENDER_TYPE' => 'inertia',
        'SEND_WHATSAPP_MSG' => 1,
        'WHATSAPP_TEST_NUMBER' => 9999999999,
        'WHATSAPP_END_POINT' => '',
        'WHATSAPP_API_KEY' => '',
        'WHATSAPP_API_KEY2' => ''
    );

    public function handle()
    {
        $starter_kit_type = $this->choice(
            'Select starter kit type',
            ['blade', 'react'],
            1,
        );

        $this->question("Set Environment variable");
        $project_name = $this->ask("Project Name", 'new');
        $app_name = $this->ask("App Name", $project_name);
        $app_appearance = $this->choice(
            'APP_APPEARANCE',
            ['system', 'light', 'dark'],
            1,
        );
        $has_ssl = $this->ask("do you have ssl available? (yes/no)", 'yes');
        $db_type = $this->choice(
            'DB_CONNECTION',
            ['sqlite', 'mysql', 'mariadb', 'pgsql', 'sqlsrv'],
            1,
        );

        if ($has_ssl == 'yes') {
            $app_url = $this->ask("APP_URL", 'https://' . $project_name . '.test');
        } else {
            $app_url = $this->ask("APP_URL", 'http://' . $project_name . '.test');
        }

        try {
            $this->env_values['APP_URL'] = $app_url;
            $this->env_values['APP_APPEARANCE'] = $app_appearance;
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
        $this->env_values['APP_NAME'] = $app_name;
        // Use the existing render switch used throughout the kit:
        // - blade -> Blade views
        // - react -> Inertia stack
        $this->env_values['APP_RENDER_TYPE'] = $starter_kit_type === 'blade' ? 'blade' : 'inertia';

        $env_obj = new EnvValue();
        $env_obj->setEnvironmentValueDatabase($this, $this->env_values, $db_type, $project_name);

        $configClass = new ConfigValue();
        $configClass->handle($this);
    }
}
