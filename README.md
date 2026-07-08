# connect_db_php_js

Acessar dados do banco com JavaScript e PHP.

## Bancos suportados

- MySQL
- MariaDB
- PostgreSQL

## Configuracao

Edite o arquivo `include/con_db.php` com o driver e as credenciais do banco:

```php
return [
    'driver' => 'mysql', // use 'mariadb' ou 'pgsql' quando necessario
    'host' => '127.0.0.1',
    'port' => 3306,
    'database' => 'imobiliariadb',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];
```

Para MariaDB, altere pelo menos:

```php
'driver' => 'mariadb',
'port' => 3306,
```

Para PostgreSQL, altere pelo menos:

```php
'driver' => 'pgsql',
'port' => 5432,
```

## Estrutura do banco

Os dumps de exemplo estao em:

- `database/mysql.sql`
- `database/mariadb.sql`
- `database/postgresql.sql`

## Consulta usada

O endpoint `include/consulta.php` busca registros com destaque e faz `JOIN` com a tabela de imagens para retornar `codigo`, `subtipo`, `destaque` e `link_thumb`.
