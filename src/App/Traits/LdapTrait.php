<?php

namespace Icebearsoft\Krud\App\Traits;

trait LdapTrait
{
    protected function configLdap()
    {
        $this->composerInstall('directorytree/ldaprecord-laravel');
        $this->addLdapEnv('.env');
        $this->addLdapEnv('.env.example');

        $this->replaceInFile('Features::registration()', '// Features::registration()', base_path('config/fortify.php'));
        $this->replaceInFile('Features::resetPasswords()', '// Features::resetPasswords()', base_path('config/fortify.php'));
        $this->replaceInFile('Features::updateProfileInformation()', '// Features::updateProfileInformation()', base_path('config/fortify.php'));
        $this->replaceInFile('Features::updatePasswords()', '// Features::updatePasswords()', base_path('config/fortify.php'));

        unlink(base_path('config/auth.php'));
        copy(__DIR__ . '/../../stubs/Config/ldap.php', base_path('config/auth.php'));

        unlink(base_path('app/Providers/AuthServiceProvider.php'));
        copy(__DIR__ . '/../../stubs/Ldap/AuthServiceProvider.stub', base_path('app/Providers/AuthServiceProvider.php'));

        unlink(base_path('app/Models/User.php'));
        copy(__DIR__ . '/../../stubs/Ldap/User.stub', base_path('app/Models/User.php'));

        copy(__DIR__ . '/../../stubs/Database/2023_08_03_214449_add_ldap_columns_to_users_table.php', base_path('database/migrations/2023_08_03_214449_add_ldap_columns_to_users_table.php'));

        $this->artisanCommand('vendor:publish','--tag=ldap-config');
        $this->artisanCommand('ldap:make:model', 'User');

    }

    protected function addLdapEnv($file)
    {
        $envPath = base_path($file);
        $envContent = file_get_contents($envPath);

        // Verifica si las configuraciones LDAP ya existen para evitar duplicados
        if (!str_contains($envContent, 'LDAP_LOGGING')) {
            $ldapConfig = "\n" .
                "LDAP_LOGGING=true\n" .
                "LDAP_CONNECTION=default\n" .
                "LDAP_HOST=10.10.10.10\n" .
                "LDAP_USERNAME=\"user@domain.com\"\n" .
                "LDAP_PASSWORD=\"PassWorD\"\n" .
                "LDAP_PORT=389\n" .
                "LDAP_BASE_DN=\"DC=replace,DC=replace\"\n" .
                "LDAP_TIMEOUT=5\n" .
                "LDAP_SSL=false\n" .
                "LDAP_TLS=false\n" .
                "LDAP_SASL=false\n";

            // Agrega las configuraciones al final del archivo .env
            file_put_contents($envPath, $envContent . $ldapConfig);

            $this->info('Configuraciones LDAP agregadas al '. $file);
        } else {
            $this->info('Las configuraciones LDAP ya existen en el '.$file);
        }
    }
}