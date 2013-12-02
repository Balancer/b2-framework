Заготовка будущего фреймворка B2
================================

Инсталляция
-----------

### Для тестов:

    composer create-project balancer/b2-framework=dev-default --prefer-dist

### Для разработки:

    composer create-project balancer/b2-framework=dev-default

### Запуск тестовой платформы
	php ./run.php

Концепция
---------

Будет осуществляться перенос компонентов фреймворка BORS© с сохранением
обратной legacy-совместимости. Компоненты:
 * b2-core — основное ядро, минимальный набор функций для работы библиотек. Создаётся практически с нуля
 * b2-framework — собственно, фреймворк. Преимущественно старые компоненты bors-core и отчасти bors-ext
 * Старые компоненты bors-third-party, bors-ext и, отчасти, bors-core растаскиваются в независимые библиотеки composer

Каждый хост состоит из следующих компонентов:
 * Центральный репозиторий: b2-core, b2-framework, composer общий.
 * Отдельные репозитории на каждый проект (аналог старого BORS_SITE). Опционально — со своими composer.

Примерная архитектура:

	 /var/www/bors
		b2-local
			composer
				b2-core
				b2-framework
				bors-core
				bors-ext

	/var/www/site.tld
		b2-site (composer и компоненты используются из b2-local)
		bors-site (legacy-код)
		b2-loader.php

	/var/www/site2.tld
		b2-site (composer и компоненты используются локально. Полностью автономный проект)
			composer
				b2-core
				b2-framework
		bors-site (legacy-код)
		b2-loader.php
