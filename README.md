# Laravel-Aspect
for laravel framework(develop) with Go!Aop Framework  
Aspect Oriented Programming /Laravel Package 

[![Build Status](https://travis-ci.org/ytake/Laravel-Aspect.svg?branch=develop)](https://travis-ci.org/ytake/Laravel-Aspect)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ytake/Laravel-Aspect/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/ytake/Laravel-Aspect/?branch=develop)
[![Coverage Status](https://coveralls.io/repos/ytake/Laravel-Aspect/badge.svg?branch=develop&service=github)](https://coveralls.io/github/ytake/Laravel-Aspect?branch=develop)

[![StyleCI](https://styleci.io/repos/40900709/shield)](https://styleci.io/repos/40900709)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/70dace68-fe04-4039-aeb4-47a64c6acca3/mini.png)](https://insight.sensiolabs.com/projects/70dace68-fe04-4039-aeb4-47a64c6acca3)

## usage

```php
'providers' => [
    // added AspectServiceProvider 
    \Ytake\LaravelAspect\AspectServiceProvider::class,
    // added Artisan Command
    \Ytake\LaravelAspect\ConsoleServiceProvider::class,
    // compile service(for production)
    \Ytake\LaravelAspect\CompileServiceProvider::class,
]
```

## Annotations

### @Transactional(Around Advice)
for database transaction(illuminate/database)

* option

| params | description |
|-----|-------|
| value | database connection |

```php

    /**
     * @Transactional("master")
     */
    public function save(array $params)
    {
        return $this->eloquent->save($params)
    }
```

### @Cacheable(After Advice)
for cache(illuminate/cache)

* option

| params | description |
|-----|-------|
| key | cache key |
| cacheName | cache name(merge cache key) |
| driver | Accessing Cache Driver(store) |
| lifetime | cache lifetime (default: 120min) |
| tags | Storing Tagged Cache Items |

```php

    /**
     * @\Cacheable(cacheName="testing1",key={"#id","#value"})
     * @param $id
     * @param $value
     * @return mixed
     */
    public function namedMultipleKey($id, $value)
    {
        return $id;
    }
```

### @CacheEvict(After Advice)
for cache(illuminate/cache) / remove cache

* option

| params | description |
|-----|-------|
| key | cache key |
| cacheName | cache name(merge cache key) |
| driver | Accessing Cache Driver(store) |
| tags | Storing Tagged Cache Items |
| allEntries | flush(default:false) |

```php

    /**
     * @\CacheEvict(cacheName="testing",tags={"testing1"},allEntries=true)
     * @return null
     */
    public function removeCache()
    {
        return null;
    }
```

### @CachePut(After Advice)
for cache(illuminate/cache) / cache put

* option

| params | description |
|-----|-------|
| key | cache key |
| cacheName | cache name(merge cache key) |
| driver | Accessing Cache Driver(store) |
| lifetime | cache lifetime (default: 120min) |
| tags | Storing Tagged Cache Items |

```php

    /**
     * @\CachePut(cacheName={"testing1"},tags="testing1")
     */
    public function throwExceptionCache()
    {
        return 'testing';
    }
    
```

