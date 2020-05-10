<?php
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');
$DB_PORT = getenv('DB_PORT');
$APP_DOMAIN = getenv('APP_DOMAIN');

$maxTries = 10;
for ($i=0; $i<$maxTries; $i++) {
    echo "Testing MySQL connection..." . PHP_EOL;
    try {
        $dbh = new PDO("mysql:dbname={$DB_NAME};host={$DB_HOST}:{$DB_PORT}", $DB_USER, $DB_PASS);
        echo "Connection successful!" . PHP_EOL;
        return;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        echo "Connection failed: " . $e->getMessage() . PHP_EOL;
        if (preg_match('/Unknown database/', $message)) {
            $dbh = new PDO("mysql:host={$DB_HOST}:{$DB_PORT}", $DB_USER, $DB_PASS);
            $dbh->exec("CREATE DATABASE `{$DB_NAME}`;");
            echo "Running Magento install" . PHP_EOL;
            exec(<<<SHELL
/var/www/bin/magento setup:install \
--base-url http://{$APP_DOMAIN}/ \
--db-host {$DB_HOST} \
--db-name {$DB_NAME} \
--db-user {$DB_USER} \
--db-password {$DB_PASS} \
--admin-firstname admin \
--admin-lastname admin \
--admin-email admin@admin.com \
--admin-user admin \
--admin-password admin123 \
--language en_US \
--currency EUR \
--timezone Europe/Berlin \
--cleanup-database \
--session-save db \
--use-rewrites 1 \
--backend-frontname admin \
--disable-modules Temando_Shipping
SHELL
);
            echo "Installation finished..." . PHP_EOL;
            return;
        }
        sleep(2);
    }
}
