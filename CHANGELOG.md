### 3.5.0 (2013-04-28)

* Added an `extras/` folder with a "live view" script.
* Performance improvements - the container is compiled and cached, and Twig
  templates can be cached too. You must add `cache = false` (or a path to the
  cache folder) to `config.ini`
* Back to 100% test coverage

### 3.4.0 (2013-04-26)

* Siteroot listener replaced with pagecontext listener (thanks @inouire)

### 3.3.0 (2013-04-25)

* Add siteroot listener
* Move frontmatter parsing to own listener
* Add data holder to FileCopyEvent
* Listeners now registered with priority

### 3.2.8 (2013-04-18)

* Don't die if sass isn't installed

### 3.2.5 (2013-04-14)

* Minor fixes to Travis automated testing
* Switch to Composer autoloader

### 3.2.2 (2013-04-11)

* Improve test coverage
* The sass transformer now relies on a sass process builder
* Update architecture notes

### 3.2.1 (2013-04-09)

* Removed badly-implemented logging

### 3.2.0 (2013-04-09)

* Transformers are now event listeners instead of being registered with the
  TransformingFilesystem.

### 3.1.0 (2013-04-08)

* Add SassTransformer to compile SCSS files. You need to add `sass_path =` to
  your `config.ini`

### 3.0.0 (2013-04-08 )

* Complete rewrite, built around an extension of the Symfony Filesystem
  component.