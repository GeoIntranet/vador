<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Collective\\Html\\HtmlServiceProvider',
    2 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    3 => 'Illuminate\\Bus\\BusServiceProvider',
    4 => 'Illuminate\\Cache\\CacheServiceProvider',
    5 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    6 => 'Illuminate\\Cookie\\CookieServiceProvider',
    7 => 'Illuminate\\Database\\DatabaseServiceProvider',
    8 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    9 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    10 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
    11 => 'Illuminate\\Hashing\\HashServiceProvider',
    12 => 'Illuminate\\Mail\\MailServiceProvider',
    13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    15 => 'Illuminate\\Queue\\QueueServiceProvider',
    16 => 'Illuminate\\Redis\\RedisServiceProvider',
    17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
    18 => 'Illuminate\\Session\\SessionServiceProvider',
    19 => 'Illuminate\\Translation\\TranslationServiceProvider',
    20 => 'Illuminate\\Validation\\ValidationServiceProvider',
    21 => 'Illuminate\\View\\ViewServiceProvider',
    22 => 'App\\Providers\\AppServiceProvider',
    23 => 'App\\Providers\\AuthServiceProvider',
    24 => 'App\\Providers\\EventServiceProvider',
    25 => 'App\\Providers\\RouteServiceProvider',
    26 => 'App\\Providers\\ViewComposerProvider',
    27 => 'App\\Providers\\NavigationComposerProvider',
    28 => 'Barryvdh\\Debugbar\\ServiceProvider',
    29 => 'App\\Providers\\LocatorRepositoryProvider',
    30 => 'App\\Providers\\LocatorServiceProvider',
    31 => 'Way\\Generators\\GeneratorsServiceProvider',
    32 => 'Xethron\\MigrationsGenerator\\MigrationsGeneratorServiceProvider',
    33 => 'App\\Providers\\LocatorComposerProvider',
    34 => 'App\\Providers\\ForumComposerProvider',
    35 => 'Golonka\\BBCode\\BBCodeParserServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Illuminate\\Cookie\\CookieServiceProvider',
    2 => 'Illuminate\\Database\\DatabaseServiceProvider',
    3 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    4 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    5 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
    6 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    7 => 'Illuminate\\Session\\SessionServiceProvider',
    8 => 'Illuminate\\View\\ViewServiceProvider',
    9 => 'App\\Providers\\AppServiceProvider',
    10 => 'App\\Providers\\AuthServiceProvider',
    11 => 'App\\Providers\\EventServiceProvider',
    12 => 'App\\Providers\\RouteServiceProvider',
    13 => 'App\\Providers\\ViewComposerProvider',
    14 => 'App\\Providers\\NavigationComposerProvider',
    15 => 'Barryvdh\\Debugbar\\ServiceProvider',
    16 => 'App\\Providers\\LocatorRepositoryProvider',
    17 => 'App\\Providers\\LocatorServiceProvider',
    18 => 'Way\\Generators\\GeneratorsServiceProvider',
    19 => 'Xethron\\MigrationsGenerator\\MigrationsGeneratorServiceProvider',
    20 => 'App\\Providers\\LocatorComposerProvider',
    21 => 'App\\Providers\\ForumComposerProvider',
  ),
  'deferred' => 
  array (
    'html' => 'Collective\\Html\\HtmlServiceProvider',
    'form' => 'Collective\\Html\\HtmlServiceProvider',
    'Collective\\Html\\HtmlBuilder' => 'Collective\\Html\\HtmlServiceProvider',
    'Collective\\Html\\FormBuilder' => 'Collective\\Html\\HtmlServiceProvider',
    'Illuminate\\Broadcasting\\BroadcastManager' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Factory' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Broadcaster' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\QueueingDispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider',
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider',
    'command.cache.clear' => 'Illuminate\\Cache\\CacheServiceProvider',
    'command.clear-compiled' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.auth.resets.clear' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.cache' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.clear' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.down' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.environment' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.key.generate' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.optimize' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.cache' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.clear' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.list' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.tinker' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.up' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.view.clear' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.app.name' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.auth.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.cache.table' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.console.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.controller.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.event.generate' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.event.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.job.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.listener.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.middleware.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.model.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.policy.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.provider.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.failed-table' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.table' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.request.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.seeder.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.session.table' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.serve' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.test.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.vendor.publish' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'Illuminate\\Console\\Scheduling\\ScheduleRunCommand' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migrator' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.repository' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.rollback' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.reset' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.refresh' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.install' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.status' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.creator' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.make' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'seeder' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.seed' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'composer' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.failed' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.retry' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.forget' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.flush' => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'hash' => 'Illuminate\\Hashing\\HashServiceProvider',
    'mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.transport' => 'Illuminate\\Mail\\MailServiceProvider',
    'Illuminate\\Contracts\\Pipeline\\Hub' => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    'queue' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.worker' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.listener' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.failer' => 'Illuminate\\Queue\\QueueServiceProvider',
    'command.queue.work' => 'Illuminate\\Queue\\QueueServiceProvider',
    'command.queue.listen' => 'Illuminate\\Queue\\QueueServiceProvider',
    'command.queue.restart' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.connection' => 'Illuminate\\Queue\\QueueServiceProvider',
    'redis' => 'Illuminate\\Redis\\RedisServiceProvider',
    'auth.password' => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
    'auth.password.broker' => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
    'translator' => 'Illuminate\\Translation\\TranslationServiceProvider',
    'translation.loader' => 'Illuminate\\Translation\\TranslationServiceProvider',
    'validator' => 'Illuminate\\Validation\\ValidationServiceProvider',
    'validation.presence' => 'Illuminate\\Validation\\ValidationServiceProvider',
    'bbcode' => 'Golonka\\BBCode\\BBCodeParserServiceProvider',
  ),
  'when' => 
  array (
    'Collective\\Html\\HtmlServiceProvider' => 
    array (
    ),
    'Illuminate\\Broadcasting\\BroadcastServiceProvider' => 
    array (
    ),
    'Illuminate\\Bus\\BusServiceProvider' => 
    array (
    ),
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
    ),
    'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider' => 
    array (
    ),
    'Illuminate\\Hashing\\HashServiceProvider' => 
    array (
    ),
    'Illuminate\\Mail\\MailServiceProvider' => 
    array (
    ),
    'Illuminate\\Pipeline\\PipelineServiceProvider' => 
    array (
    ),
    'Illuminate\\Queue\\QueueServiceProvider' => 
    array (
    ),
    'Illuminate\\Redis\\RedisServiceProvider' => 
    array (
    ),
    'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider' => 
    array (
    ),
    'Illuminate\\Translation\\TranslationServiceProvider' => 
    array (
    ),
    'Illuminate\\Validation\\ValidationServiceProvider' => 
    array (
    ),
    'Golonka\\BBCode\\BBCodeParserServiceProvider' => 
    array (
    ),
  ),
);