<?php
/**
 * Go! OOP&AOP PHP framework
 *
 * @copyright     Copyright 2012, Lissachenko Alexander <lisachenko.it@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

namespace Go\Instrument\Transformer;

use Go\Core\AspectKernel;
use Go\Core\AspectContainer;

/**
 * Take transformed source from the cache
 *
 * @package go
 * @subpackage instrument
 */
class CachingTransformer extends BaseSourceTransformer
{

    /**
     * Root path of application
     *
     * @var string
     */
    protected $rootPath = '';

    /**
     * Cache directory
     *
     * @var string
     */
    protected $cachePath = '';

    /**
     * @var array|SourceTransformer[]
     */
    protected $transformers = array();

    /**
     * Class constructor
     *
     * @param AspectKernel $kernel Instance of aspect kernel
     * @param array $transformers Source transformers
     */
    public function __construct(AspectKernel $kernel, array $transformers)
    {
        parent::__construct($kernel);
        $cacheDir = $this->options['cacheDir'];

        if ($cacheDir) {
            if (!is_dir($cacheDir)) {
                $cacheRootDir = dirname($cacheDir);
                if (!is_writable($cacheRootDir) || !is_dir($cacheRootDir)) {
                    throw new \InvalidArgumentException(
                        "Can not create a directory {$cacheDir} for the cache.
                        Parent directory {$cacheRootDir} is not writable or not exist.");
                }
                mkdir($cacheDir, 0770);
            }
            if (!is_writable($cacheDir)) {
                throw new \InvalidArgumentException("Cache directory {$cacheDir} is not writable");
            }
            $this->cachePath = realpath($cacheDir);
        }

        $this->rootPath     = realpath($this->options['appDir']);
        $this->transformers = $transformers;
    }

    /**
     * This method may transform the supplied source and return a new replacement for it
     *
     * @param StreamMetaData $metadata Metadata for source
     * @return void
     */
    public function transform(StreamMetaData $metadata)
    {
        // Do not create a cache
        if (!$this->cachePath) {
            $this->processTransformers($metadata);
            return;
        }

        $originalUri = $metadata->uri;
        $cacheUri    = str_replace($this->rootPath, $this->cachePath, $originalUri);

        $lastModified  = filemtime($originalUri);
        $cacheModified = file_exists($cacheUri) ? filemtime($cacheUri) : 0;

        // TODO: add more accurate cache invalidation, like in Symfony2
        if ($cacheModified < $lastModified || !$this->container->isFresh($cacheModified)) {
            $parentCacheDir = dirname($cacheUri);
            if (!is_dir($parentCacheDir)) {
                mkdir($parentCacheDir, 0770, true);
            }
            $this->processTransformers($metadata);
            file_put_contents($cacheUri, $metadata->source);
            return;
        }
        $metadata->source = file_get_contents($cacheUri);
    }

    /**
     * Iterates over transformers
     *
     * @param StreamMetaData $metadata Metadata for source code
     * @return void
     */
    private function processTransformers(StreamMetaData $metadata)
    {
        foreach ($this->transformers as $transformer) {
            $transformer->transform($metadata);
        }
    }
}
