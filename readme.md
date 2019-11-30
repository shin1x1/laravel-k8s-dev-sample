# A sample Laravel development environments on Kubernetes

[![CircleCI](https://circleci.com/gh/shin1x1/laravel-k8s-dev-sample.svg?style=svg)](https://circleci.com/gh/shin1x1/laravel-k8s-dev-sample)

## Requirements

* Kubenernetes
I tested with Docker Desktop for Mac 2.1.0.5(Kubernetes v1.14.8).

## Instlation

```
* make
```

When you have done the installation, you can see the resources below.

```
* kubectl get all,configmap
NAME                 READY   STATUS    RESTARTS   AGE
pod/sample-db        1/1     Running   0          9m21s
pod/sample-db-test   1/1     Running   0          9m21s
pod/sample-php       2/2     Running   0          9m20s

NAME                     TYPE           CLUSTER-IP      EXTERNAL-IP   PORT(S)          AGE
service/kubernetes       ClusterIP      10.96.0.1       <none>        443/TCP          8d
service/sample-db        ClusterIP      10.96.170.170   <none>        5432/TCP         9m21s
service/sample-db-test   ClusterIP      10.96.232.170   <none>        5432/TCP         9m22s
service/sample-php       LoadBalancer   10.101.30.33    localhost     8000:32243/TCP   9m21s

NAME                       DATA   AGE
configmap/sample-nginx     3      9m22s
configmap/sample-php-fpm   2      9m22s
```

## Sample actions

* show Laravel sample page if you open http://localhost/ .
* show phpinfo() if you open http://localhost/info .
* show a JSON API example that it communicating with DB(PostgreSQL) if you open http://localhost/customers/1 .
* connect to DB with using kubectl.
```
$ kubectl exec -it sample-db -- psql -Uapp app
psql (11.5)
Type "help" for help.

app=#
```
* execute the PHP commands in the php-fpm container.
```
kubectl exec -it sample-php -c php-fpm -- php -v
PHP 7.4.0 (cli) (built: Nov 28 2019 20:41:26) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
    with Zend OPcache v7.4.0, Copyright (c), by Zend Technologies
    with Xdebug v2.8.0, Copyright (c) 2002-2019, by Derick Rethans
```
