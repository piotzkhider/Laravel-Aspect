<?php

class CacheEvictTest extends \TestCase
{
    /** @var \Ytake\LaravelAspect\AspectManager $manager */
    protected $manager;

    protected static $instance;

    protected function setUp()
    {
        parent::setUp();
        $this->manager = new \Ytake\LaravelAspect\AspectManager($this->app);
        $this->resolveManager();
    }

    /**
     * @runInSeparateProcess
     */
    public function testGenerateCacheNameRemoveNullKey()
    {
        $cache = new \__Test\AspectCacheEvict();
        $cache->singleCacheDelete();
        $this->assertNull($this->app['cache']->get('singleCacheDelete'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testCacheableAndRemove()
    {
        $cache = new \__Test\AspectCacheEvict();
        $cache->cached(1, 2);
        $this->assertNotNull($this->app['cache']->tags(['testing1'])->get('testing:1:2'));

        // flush all entries
        $cache->removeCache();
        $this->assertNull($this->app['cache']->tags(['testing1'])->get('testing:1:2'));
    }

    /**
     *
     */
    protected function resolveManager()
    {
        $annotation = new \Ytake\LaravelAspect\Annotation;
        $annotation->registerAspectAnnotations();
        /** @var \Ytake\LaravelAspect\GoAspect $aspect */
        $aspect = $this->manager->driver('go');
        $aspect->register();
    }
}
