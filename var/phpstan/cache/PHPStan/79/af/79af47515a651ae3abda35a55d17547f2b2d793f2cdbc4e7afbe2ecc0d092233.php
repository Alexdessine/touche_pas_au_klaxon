<?php declare(strict_types = 1);

// odsl-C:\Users\magic\Desktop\docker-stacks\touche_pas_au_klaxon\src\Core\Connection.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Core\Connection
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.65.0.9-8.3.6-964856c397906975ceb3adf690985bbddac885365a0c3caf417b9b9ad202a0cd',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Core\\Connection',
        'filename' => 'C:/Users/magic/Desktop/docker-stacks/touche_pas_au_klaxon/src/Core/Connection.php',
      ),
    ),
    'namespace' => 'App\\Core',
    'name' => 'App\\Core\\Connection',
    'shortName' => 'Connection',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Classe de connexion à la base de données.
 * Fournit une instance unique de PDO pour toute l\'application.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 50,
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
      'pdo' => 
      array (
        'declaringClassName' => 'App\\Core\\Connection',
        'implementingClassName' => 'App\\Core\\Connection',
        'name' => 'pdo',
        'modifiers' => 20,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'PDO',
                  'isIdentifier' => false,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'default' => 
        array (
          'code' => 'null',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 41,
            'startFilePos' => 255,
            'endTokenPos' => 41,
            'endFilePos' => 258,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 36,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'getPdo' => 
      array (
        'name' => 'getPdo',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'PDO',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retourne une instance unique de PDO pour la connexion à la base de données.
 *
 * @return PDO L\'instance de PDO
 * @throws \\RuntimeException Si les variables d\'environnement nécessaires sont manquantes
 */',
        'startLine' => 24,
        'endLine' => 49,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Core',
        'declaringClassName' => 'App\\Core\\Connection',
        'implementingClassName' => 'App\\Core\\Connection',
        'currentClassName' => 'App\\Core\\Connection',
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