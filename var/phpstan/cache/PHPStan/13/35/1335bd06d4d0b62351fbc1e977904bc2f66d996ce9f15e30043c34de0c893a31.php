<?php declare(strict_types = 1);

// odsl-C:\Users\magic\Desktop\docker-stacks\touche_pas_au_klaxon\src\Core\BaseController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Core\BaseController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.65.0.9-8.3.6-d1fb210629a0fabddbb5a7024e697eb6deb9bbd9f1537dc8d7334dc9f313f0c7',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Core\\BaseController',
        'filename' => 'C:/Users/magic/Desktop/docker-stacks/touche_pas_au_klaxon/src/Core/BaseController.php',
      ),
    ),
    'namespace' => 'App\\Core',
    'name' => 'App\\Core\\BaseController',
    'shortName' => 'BaseController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => '/**
 * Classe de base pour tous les contrôleurs.
 * Fournit des méthodes utilitaires pour la gestion de l\'authentification et des autorisations.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 66,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'requireAuth' => 
      array (
        'name' => 'requireAuth',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Vérifie si un utilisateur est connecté. Si ce n\'est pas le cas, redirige vers la page de connexion.
 *
 * @return void
 */',
        'startLine' => 21,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\BaseController',
        'implementingClassName' => 'App\\Core\\BaseController',
        'currentClassName' => 'App\\Core\\BaseController',
        'aliasName' => NULL,
      ),
      'requireAdmin' => 
      array (
        'name' => 'requireAdmin',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Vérifie si l\'utilisateur connecté est un administrateur. Si ce n\'est pas le cas, affiche une page d\'erreur 403.
 *
 * @return void
 */',
        'startLine' => 34,
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\BaseController',
        'implementingClassName' => 'App\\Core\\BaseController',
        'currentClassName' => 'App\\Core\\BaseController',
        'aliasName' => NULL,
      ),
      'requireUser' => 
      array (
        'name' => 'requireUser',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Vérifie si l\'utilisateur connecté est un utilisateur standard. Si ce n\'est pas le cas, affiche une page d\'erreur 403.
 *
 * @return void
 */',
        'startLine' => 53,
        'endLine' => 65,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\BaseController',
        'implementingClassName' => 'App\\Core\\BaseController',
        'currentClassName' => 'App\\Core\\BaseController',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));