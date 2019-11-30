default: install test
.PHONY: all

install: k8s-apply composer
	cp -a .env.example .env
	kubectl exec sample-php -c php-fpm -- ./artisan key:generate
	kubectl exec sample-php -c php-fpm -- ./artisan migrate
	kubectl exec sample-php -c php-fpm -- ./artisan db:seed
.PHONY: install

k8s-apply:
	sed "s#%HOST_PATH%#${PWD}#" k8s/php.yaml.base > k8s/php.yaml
	kubectl apply -f k8s/
	kubectl wait all -l app=sample --for condition=Ready --timeout=5m

composer:
	docker run --rm -v `pwd`:/opt -w /opt --entrypoint '' composer sh -c 'composer global require hirak/prestissimo && composer install --ignore-platform-reqs'

test:
	kubectl exec sample-php -c php-fpm -- ./vendor/bin/phpunit
.PHONY: test

phpcs:
	kubectl exec sample-php -c php-fpm -- ./vendor/bin/phpcs --standard=/var/www/html/ruleset.xml
.PHONY: phpcs

phpcbf:
	kubectl exec sample-php -c php-fpm -- ./vendor/bin/phpcbf --standard=/var/www/html/ruleset.xml
.PHONY: phpcbf

clean:
	kubectl delete -f k8s/
	rm k8s/php.yaml
.PHONY: clean
