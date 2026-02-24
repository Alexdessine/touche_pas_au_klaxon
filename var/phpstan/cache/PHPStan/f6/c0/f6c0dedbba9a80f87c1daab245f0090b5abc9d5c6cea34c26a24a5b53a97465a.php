<?php declare(strict_types = 1);

// odsl-C:\Users\magic\Desktop\docker-stacks\touche_pas_au_klaxon\src\Controller\TripController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Controller\TripController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.65.0.9-8.3.6-9ba6eb6a777e5160790fa181062f6e463d35483b08abc37e028969b079ec4648',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Controller\\TripController',
        'filename' => 'C:/Users/magic/Desktop/docker-stacks/touche_pas_au_klaxon/src/Controller/TripController.php',
      ),
    ),
    'namespace' => 'App\\Controller',
    'name' => 'App\\Controller\\TripController',
    'shortName' => 'TripController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Contrôleur pour la gestion des trajets.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 18,
    'endLine' => 577,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Core\\BaseController',
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
      'index' => 
      array (
        'name' => 'index',
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
 * Affiche la liste des trajets avec les informations associées (agences, utilisateurs).
 * Le contrôleur prépare des tableaux de correspondance (id -> nom) pour les agences et les utilisateurs afin de faciliter l\'affichage dans la vue.
 * Il gère également les messages d\'alerte (succès/erreur) via la session.
 * @return void
 */',
        'startLine' => 26,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\TripController',
        'implementingClassName' => 'App\\Controller\\TripController',
        'currentClassName' => 'App\\Controller\\TripController',
        'aliasName' => NULL,
      ),
      'logout' => 
      array (
        'name' => 'logout',
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
 * Traite la déconnexion de l\'utilisateur.
 * Il appelle la méthode de déconnexion de la classe Auth, puis redirige l\'utilisateur vers la page d\'accueil.
 * @return void
 */',
        'startLine' => 78,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\TripController',
        'implementingClassName' => 'App\\Controller\\TripController',
        'currentClassName' => 'App\\Controller\\TripController',
        'aliasName' => NULL,
      ),
      'create' => 
      array (
        'name' => 'create',
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
 * Affiche le formulaire de création d\'un trajet.
 * Il vérifie que l\'utilisateur est authentifié, puis récupère la liste des agences et les informations de l\'utilisateur connecté pour les passer à la vue.
 * La vue affichera un formulaire avec des champs pour sélectionner les agences de départ et d
 * arrivée, les dates et heures de départ et d\'arrivée, et le nombre de places disponibles.
 * @return void
 */',
        'startLine' => 92,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\TripController',
        'implementingClassName' => 'App\\Controller\\TripController',
        'currentClassName' => 'App\\Controller\\TripController',
        'aliasName' => NULL,
      ),
      'store' => 
      array (
        'name' => 'store',
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
 * Traite la soumission du formulaire de création d\'un trajet.
 * Il effectue une lecture défensive des données POST, valide les champs selon les règles
 * définies, et enregistre le trajet dans la base de données si toutes les validations passent.
 * En cas d\'erreurs, il ré-affiche le formulaire avec les messages d\'erreur et les données précédemment saisies.
 * En cas de succès, il redirige l\'utilisateur vers la liste des trajets avec un message de succès.
 * @return void
 */',
        'startLine' => 125,
        'endLine' => 293,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\TripController',
        'implementingClassName' => 'App\\Controller\\TripController',
        'currentClassName' => 'App\\Controller\\TripController',
        'aliasName' => NULL,
      ),
      'edit' => 
      array (
        'name' => 'edit',
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
            'startLine' => 302,
            'endLine' => 302,
            'startColumn' => 26,
            'endColumn' => 32,
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
 * Affiche le formulaire de modification d\'un trajet.
 * Il vérifie que l\'utilisateur est authentifié, puis récupère le trajet à modifier, la liste des agences et les informations de l\'utilisateur connecté pour les passer à la vue.
 * La vue affichera un formulaire pré-rempli avec les données du trajet, et permettra de modifier les champs similaires à la création.
 * @param int $id Identifiant du trajet à modifier
 * @return void
 */',
        'startLine' => 302,
        'endLine' => 347,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\TripController',
        'implementingClassName' => 'App\\Controller\\TripController',
        'currentClassName' => 'App\\Controller\\TripController',
        'aliasName' => NULL,
      ),
      'update' => 
      array (
        'name' => 'update',
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
            'startLine' => 357,
            'endLine' => 357,
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
 * Traite la soumission du formulaire de modification d\'un trajet.
 * Il effectue une lecture défensive des données POST, valide les champs selon les règles définies, et met à jour le trajet dans la base de données si toutes les validations passent.
 * En cas d\'erreurs, il ré-affiche le formulaire avec les messages d\'erreur et les données précédemment saisies.
 * En cas de succès, il redirige l\'utilisateur vers la liste des trajets avec un message de succès.
 * @param int $id Identifiant du trajet à modifier
 * @return void
 */',
        'startLine' => 357,
        'endLine' => 552,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\TripController',
        'implementingClassName' => 'App\\Controller\\TripController',
        'currentClassName' => 'App\\Controller\\TripController',
        'aliasName' => NULL,
      ),
      'delete' => 
      array (
        'name' => 'delete',
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
 * Traite la suppression d\'un trajet.
 * Il vérifie que l\'utilisateur est authentifié, puis supprime le trajet de la base de données.
 * En cas de succès, il redirige l\'utilisateur vers la liste des trajets avec un message de succès.
 * @return void
 */',
        'startLine' => 560,
        'endLine' => 575,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\TripController',
        'implementingClassName' => 'App\\Controller\\TripController',
        'currentClassName' => 'App\\Controller\\TripController',
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