<?php declare(strict_types = 1);

// odsl-C:\Users\magic\Desktop\docker-stacks\touche_pas_au_klaxon\src\Repository\TripRepository.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Repository\TripRepository
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.65.0.9-8.3.6-611d254cce718a77d1e373f9d987d3d3c2a67736f8245279a8c1035ace8d4262',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Repository\\TripRepository',
        'filename' => 'C:/Users/magic/Desktop/docker-stacks/touche_pas_au_klaxon/src/Repository/TripRepository.php',
      ),
    ),
    'namespace' => 'App\\Repository',
    'name' => 'App\\Repository\\TripRepository',
    'shortName' => 'TripRepository',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Accès aux données des trajets (table `trips`).
 *
 * Cette classe contient uniquement des opérations SQL (via PDO)
 * et retourne des objets métier {@see Trips}.
 *
 * Responsabilités principales :
 * - Lire les trajets futurs avec places disponibles
 * - Lire un trajet par identifiant
 * - Créer / mettre à jour / supprimer un trajet
 * - Vérifier l\'existence de doublons (création / mise à jour)
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 23,
    'endLine' => 249,
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
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'name' => 'pdo',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'PDO',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 28,
        'endLine' => 28,
        'startColumn' => 33,
        'endColumn' => 48,
        'isPromoted' => true,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'pdo' => 
          array (
            'name' => 'pdo',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PDO',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 33,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param PDO $pdo Connexion PDO configurée (exceptions, charset, etc.)
 */',
        'startLine' => 28,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'findAll' => 
      array (
        'name' => 'findAll',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retourne les trajets futurs ayant encore des places disponibles,
 * triés par date de départ croissante.
 *
 * @return list<Trips> Liste de trajets hydratés
 */',
        'startLine' => 38,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'findById' => 
      array (
        'name' => 'findById',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 62,
            'endLine' => 62,
            'startColumn' => 30,
            'endColumn' => 36,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
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
                  'name' => 'App\\Model\\Trips',
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retourne un trajet par son identifiant.
 *
 * @param int $id Identifiant du trajet
 * @return Trips|null Le trajet trouvé, sinon null
 */',
        'startLine' => 62,
        'endLine' => 79,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'existsDuplicate' => 
      array (
        'name' => 'existsDuplicate',
        'parameters' => 
        array (
          'departureAgencyId' => 
          array (
            'name' => 'departureAgencyId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 91,
            'endLine' => 91,
            'startColumn' => 9,
            'endColumn' => 30,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'arrivalAgencyId' => 
          array (
            'name' => 'arrivalAgencyId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 92,
            'endLine' => 92,
            'startColumn' => 9,
            'endColumn' => 28,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'departureTime' => 
          array (
            'name' => 'departureTime',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeImmutable',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 93,
            'endLine' => 93,
            'startColumn' => 9,
            'endColumn' => 41,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'arrivalTime' => 
          array (
            'name' => 'arrivalTime',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeImmutable',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 94,
            'endLine' => 94,
            'startColumn' => 9,
            'endColumn' => 39,
            'parameterIndex' => 3,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Indique si un trajet identique existe déjà (départ/arrivée/horaires).
 *
 * @param int $departureAgencyId Identifiant de l\'agence de départ
 * @param int $arrivalAgencyId Identifiant de l\'agence d\'arrivée
 * @param DateTimeImmutable $departureTime Date/heure de départ
 * @param DateTimeImmutable $arrivalTime Date/heure d\'arrivée
 * @return bool True si un doublon existe, sinon false
 */',
        'startLine' => 90,
        'endLine' => 111,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'create' => 
      array (
        'name' => 'create',
        'parameters' => 
        array (
          'trip' => 
          array (
            'name' => 'trip',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Model\\Trips',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 119,
            'endLine' => 119,
            'startColumn' => 28,
            'endColumn' => 38,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Crée un nouveau trajet en base de données.
 *
 * @param Trips $trip Objet trajet à persister
 * @return int Identifiant du trajet créé
 */',
        'startLine' => 119,
        'endLine' => 138,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'update' => 
      array (
        'name' => 'update',
        'parameters' => 
        array (
          'trip' => 
          array (
            'name' => 'trip',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Model\\Trips',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 146,
            'endLine' => 146,
            'startColumn' => 28,
            'endColumn' => 38,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
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
 * Met à jour un trajet existant en base de données.
 *
 * @param Trips $trip Trajet à mettre à jour (doit contenir un id)
 * @return void
 */',
        'startLine' => 146,
        'endLine' => 165,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'existsDuplicateExcludingId' => 
      array (
        'name' => 'existsDuplicateExcludingId',
        'parameters' => 
        array (
          'excludeId' => 
          array (
            'name' => 'excludeId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 179,
            'endLine' => 179,
            'startColumn' => 9,
            'endColumn' => 22,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'departureAgencyId' => 
          array (
            'name' => 'departureAgencyId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 180,
            'endLine' => 180,
            'startColumn' => 9,
            'endColumn' => 30,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'arrivalAgencyId' => 
          array (
            'name' => 'arrivalAgencyId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 181,
            'endLine' => 181,
            'startColumn' => 9,
            'endColumn' => 28,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'departureTime' => 
          array (
            'name' => 'departureTime',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeImmutable',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 182,
            'endLine' => 182,
            'startColumn' => 9,
            'endColumn' => 41,
            'parameterIndex' => 3,
            'isOptional' => false,
          ),
          'arrivalTime' => 
          array (
            'name' => 'arrivalTime',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeImmutable',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 183,
            'endLine' => 183,
            'startColumn' => 9,
            'endColumn' => 39,
            'parameterIndex' => 4,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Indique si un trajet identique existe déjà, en excluant un identifiant
 * (utile lors d\'une modification).
 *
 * @param int $excludeId Identifiant du trajet à exclure de la recherche
 * @param int $departureAgencyId Identifiant de l\'agence de départ
 * @param int $arrivalAgencyId Identifiant de l\'agence d\'arrivée
 * @param DateTimeImmutable $departureTime Date/heure de départ
 * @param DateTimeImmutable $arrivalTime Date/heure d\'arrivée
 * @return bool True si un doublon existe, sinon false
 */',
        'startLine' => 178,
        'endLine' => 204,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'hydrateTrip' => 
      array (
        'name' => 'hydrateTrip',
        'parameters' => 
        array (
          'data' => 
          array (
            'name' => 'data',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 212,
            'endLine' => 212,
            'startColumn' => 34,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Model\\Trips',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Hydrate un objet {@see Trips} à partir d\'une ligne SQL.
 *
 * @param array<string, mixed> $data Ligne issue d\'un fetch(PDO::FETCH_ASSOC)
 * @return Trips Trajet hydraté
 */',
        'startLine' => 212,
        'endLine' => 224,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'delete' => 
      array (
        'name' => 'delete',
        'parameters' => 
        array (
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 232,
            'endLine' => 232,
            'startColumn' => 28,
            'endColumn' => 34,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
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
 * Supprime un trajet par identifiant.
 *
 * @param int $id Identifiant du trajet à supprimer
 * @return void
 */',
        'startLine' => 232,
        'endLine' => 237,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
        'aliasName' => NULL,
      ),
      'count' => 
      array (
        'name' => 'count',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retourne le nombre total de trajets en base de données.
 *
 * @return int Nombre total de trajets
 */',
        'startLine' => 244,
        'endLine' => 248,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Repository',
        'declaringClassName' => 'App\\Repository\\TripRepository',
        'implementingClassName' => 'App\\Repository\\TripRepository',
        'currentClassName' => 'App\\Repository\\TripRepository',
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