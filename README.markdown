A Symfony bundle that adds the following `http-equiv` meta tags to the HTML response.

```html
<meta http-equiv="header" content="value" />
```

Installation
============
 1. Add the bundle to the autoloader:
    
    ```php
    <?php
    // add the extension source to your autoload.php
    $loader->registerNamespaces(array('DeBaasMedia\\Bundle\\HttpEquivalentBundle' => __DIR__ . '/../vendor/bundles/DeBaasMedia/Bundle'
                                     ));
    ```
    
 2. Register your bundle in the kernel:
    
    ```php
    <?php
    // add this to your
    public function registerBundles ()
    {
      $bundles = array();
    
      // add all the framework bundles
    
      $bundles[] = new DeBaasMedia\Bundle\HttpEquivalentBundle\DeBaasMediaHttpEquivalentBundle()
    
      return $bundles;
    }
    ```

Documentation
=============
Enabling the bundle should be sufficient for most default setups. If however you
wish to configure the extension further you should refer to the full (configuration)
[documentation][1] distributed with this bundle.

License
=======
The bundle is released under the MIT license. For more information see the
[license][2] file distibuted with this bundle.

[1]: https://github.com/debaasmedia/DeBaasMediaHttpEquivalentBundle/blob/develop/Resources/doc/index.rst
[2]: https://github.com/debaasmedia/DeBaasMediaHttpEquivalentBundle/blob/develop/Resources/meta/LICENSE